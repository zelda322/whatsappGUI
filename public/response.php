<?php
error_reporting(0);

include('../lib/whatsprot.class.php');
require_once('../lib/user/profile.php');
$user=new User();
$user->connectDB();

$user_id=intval($_POST['user_id']);
$contact_id=intval($_POST['contact_id']);

$userPhone=$user->getUserPhone($user_id);
while($userPhoneRow=$userPhone->fetch()){
$username=$userPhoneRow->phone;
$password=$userPhoneRow->password;
}


$contactPhone=$user->getContactPhone($contact_id);
while($contactPhoneRow=$contactPhone->fetch()){
$dst=$contactPhoneRow->phone;
}


$identity = strtolower(urlencode(sha1($username, true)));
$w = new WhatsProt($username, $identity, "park23", false);
$w->Connect();
$w->LoginWithPassword($password);
$w->pollMessages();
$messages=$w->getMessages();
if(!empty($messages)){
foreach($messages as $message){
 $from = $message->getAttribute("from");
      preg_match('/(.*)@s\.whatsapp\.net/',$from,$numbercontact);
	
  	if($message->getChild("body"))
    	{
 		$messagebody = $message->getChild("body")->getData();
    	}
	if($numbercontact[1]!=$dst){
	  echo $from= $numbercontact[1];
	  echo "</br>";
	  echo htmlspecialchars($messagebody);
	
	 $id=$user->getId($from,$user_id);
	if($row=$id->fetch()){
		$id=$row->id;
	}else{
	$id=0;
	}
	
	 $user->newMsg($user_id,$id,$messagebody,$from);

	}else{	
	$from=$dst;		
		$user->newMsg($user_id,$contact_id,$messagebody,$from);
	}
}	
}
?>
																									<div class="itemdiv dialogdiv">
<?php
$message=$user->getMsg($user_id,$contact_id);
while($messageRow = $message->fetch()) {
?>
<div class="itemdiv dialogdiv">
<div class="body">
<div class="time">
<i class="icon-time"></i>
<span class="green"><?=$messageRow->msgtime;?></span>
</div>
<div class="name">
<a href="#"><?=$messageRow->login;?></a>
</div>
<div class="text"><?=$messageRow->msg;?></div>
</div>
</div>
<?php } ?>

