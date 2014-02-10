<?php


if($_SERVER['REQUEST_METHOD']!=='POST'){
	die('Fuck off');
}

include('../lib/whatsprot.class.php');
require_once('../lib/user/profile.php');

$user=new User();
$user->connectDB();
$user_id=$_POST['user_id'];

$userPhone=$user->getUserPhone($user_id);
while($userPhoneRow=$userPhone->fetch()){
$username=$userPhoneRow->phone;
$password=$userPhoneRow->password;
}


$phone=$_POST['phone'];
$login=$_POST['username'];



function onGetProfilePicture($from, $target, $type, $data) {

    $pictureof = explode("@", $target);
    $pictureof = $pictureof[0];
    $time = time();
    $filename = $pictureof . "_@_" . $time . ".jpg";
 $filename = WhatsProt::PICTURES_FOLDER."/" . $filename;

    $fp = @fopen($filename, "w");
    if ($fp) {
        fwrite($fp, $data);
        fclose($fp);
	$user=new User();
$user->connectDB();
	if(empty($filename)){$filename='pictures/unknown.jpg';}
	try{
	$user->newUser($_POST['user_id'],$_POST['phone'],$_POST['username'],$filename);
	header("Location:index.php");
	}catch(Exception $e){
echo $e->getMessage();
}

    }
}


$identity = strtolower(urlencode(sha1($username, true)));

$w = new WhatsProt($username, $identity, $username, false);
$w->Connect();
$w->LoginWithPassword($password);
try{
$w->eventManager()->bind("onGetProfilePicture", "onGetProfilePicture");
$w->sendGetProfilePicture($phone);
}
catch(Exception $e){
echo $e->getMessage();
}




$w->disconnect();

