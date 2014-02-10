<?php require_once('../lib/user/profile.php');
$user=new User();
$user->checkSession();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>WhatsApp WEB</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
	

		<!--page specific plugin styles-->

		<!--fonts-->

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
<div class="navbar">
			
				
					<a href="#" class="brand">
			
					</a><!--/.brand--><?php
$user->connectDB();
$userData=$user->getUser($_SESSION['user']);
$user_id=$_SESSION['user'];
										
 ?>

					<ul class="nav ace-nav pull-right">
														
							
					
						<li class="light-blue">


						

							
						</li>
					</ul><!--/.ace-nav-->
				
			
		</div>
	
		<div class="main-container container-fluid">

			
			<div class="main-content">
				

				<div class="page-content">
									
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

						
							
							

								<div class="span11">
									<div class="widget-box ">
 										
                                                                                         
										<div class="widget-body">

											

																							
											<form class="form-horizontal" action='./newcontact.php' method='POST' />
								<div class="control-group">
									<label class="control-label" for="form-field-1">username</label>

									<div class="controls">
										<input type="text" name='username' id="form-field-1" placeholder="Anna" required/>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-2">phone</label>

									<div class="controls">
										<input type="phone" name='phone' id="form-field-2" placeholder="ex996555xxxxxx" required/>
										
									</div>
								</div>
											<input type="hidden" name='user_id' value='<?=$_SESSION['user'];?>'  />
								
									<button class='btn'>ADD</button>
							</form>															





												
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
		</script>
		<!--page specific plugin scripts-->

			<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

	</body>
</html>
