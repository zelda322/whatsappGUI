<?php 
require_once('../lib/user/profile.php');
$user=new User();
$user->checkSession();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>WhatsApp WEB</title>
                 <link rel="shortcut icon" href="./favicon.ico">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
			<!--[if IE 7]>
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
						
			<img src='../images/logo.png'/ width='120px' height='70px'>
										 <span>Web</span></small>
					</a><!--/.brand-->
<?php
$user->connectDB();
$userData=$user->getUser($_SESSION['user']);
$user_id=$_SESSION['user'];
@$contact_id=intval($_GET['contact']);
if(isset($contact_id) and !empty($contact_id)){
$user->checkContact($user_id,$contact_id)==true?'':die("<h1 style='color:white;'>Contact not exist! <a href='index.php'><= back</a></h1>");
}
while($userRow = $userData->fetch()) {
$user_id=$userRow->id;											
 ?>

					<ul class="nav ace-nav pull-right">
														
							
					
						<li class="light-blue">


							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="./pictures/<?=$userRow->image;?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
                                                                         <?=$userRow->login;}?>            
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
															<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar">
							<ul class="nav nav-list">
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-file-alt"></i>

							<span class="menu-text">
								Contacts
								<span class="badge badge-primary ">4</span>
							</span>

							<b class="arrow icon-angle-down"></b>
						</a>
					
						<ul class="submenu">
		<?php
					  $contacts=$user->getContacts($_SESSION['user']);
					while($contactsRow = $contacts->fetch()) {
					          
					?>
							<li>
								<a href="?contact=<?=$contactsRow->id;?>">
									<i class="icon-double-angle-right"></i>
									<?=$contactsRow->login;?>
								</a>
							</li>
							  <?php }?>
						</ul>
						
					</li>
					<li>
												<a href="./new.php">
													<i class="icon-plus"></i>
													Add Contact
												</a>
											</li>
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li class="active">Dashboard</li>
					</ul><!--.breadcrumb-->

				
				</div>

				<div class="page-content">
									<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

						
							
							

								<div class="span11">
		<?php 
		                                                                        if(isset($contact_id) and !empty($contact_id)){
											$imageCont=$user->getContactImage($contact_id);
											while($contImage = $imageCont->fetch()) {
												 $contactpict=$contImage->image;											
											         }}else{      
												 $contact_id=0;
                                                                                                 $contactpict='pictures/unknown.jpg';
												}
											          
												 ?>	
													<span class="profile-picture">
											    <img id='avatar' width='100px' height='100px' src="<?=$contactpict ;?>">
														</span>   
										
									<div class="widget-box ">
 <div class="form-actions input-append">
														<input placeholder="Type your message here ..." type="text" class="width-75" name="message" id='messagetext' />
														
															<button class="btn" id='addmsg' onclick='sendMsg();'>Send</button>
														
													</div> 
										<div class="widget-header">
											<h4 class="lighter smaller">
												<i class="icon-comment blue"></i>
												Conversation
											</h4>
										</div>
                                                                                         
										<div class="widget-body">

											<div class="widget-main no-padding">

												<div class="dialogs">
 <div id='response'></div>
												</div>

												
																										





												
											</div><!--/widget-main-->
										</div><!--/widget-body-->
									</div><!--/widget-box-->
								</div><!--/span-->
							</div><!--/row-->

							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

			
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->




	
		<script src="assets/js/bootstrap.min.js"></script>
		<script>
         function sendMsg(){

    $.post("./send.php",
    {
     user_id:<?=$user_id;?>,
     contact_id:<?=$contact_id;?>,
     login:'testlogin',
     msg:$('#messagetext').val()	
    },
    function(data,status){
      //alert("Status: " + status);
 
      
    });
}

</script>
		<script>

var sec=3;
$(document).ready(function(){
  secId = setInterval(function(){
    	
  $.post("./response.php?cache="+(Math.random()*1000000),
    {
        user_id:<?=$user_id;?>,
	contact_id:<?=$contact_id;?>
    },
    function(data,status){
      $("#response").html(data);
    });
  },sec*1000);
});

		</script>

		</script>
		<!--page specific plugin scripts-->

			<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

	</body>
</html>
