<?php

include('../lib/whatsprot.class.php');
require_once('../lib/user/profile.php');
$user=new User();
$user->connectDB();

if($_SERVER['REQUEST_METHOD']!=='POST')
	die('Wrong way asshole');

if(!isset($_POST['login']) or !isset($_POST['user_id']) or !isset($_POST['contact_id']) or !isset($_POST['msg'])){
	header("Location: 404.html");exit;
}

if(empty($_POST['login']) or empty($_POST['user_id']) or empty($_POST['contact_id'])){
	header("Location: 404.html");exit;
}
	

$login=mysql_real_escape_string($_POST['login']);
$user_id=intval($_POST['user_id']);
$contact_id=intval($_POST['contact_id']);
$msg = mysql_real_escape_string($_POST['msg']);


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
$w = new WhatsProt($username, $identity, $login, false);
$w->Connect();
$w->LoginWithPassword($password);
if($w->sendMessage($dst , $msg)){

$user->newMsg($user_id,$contact_id,$msg,$login);

}

$w->pollMessages();
$w->disconnect();

