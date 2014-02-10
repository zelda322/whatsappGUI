<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
if(!isset($_POST['loginname']) or !isset($_POST['passwordname']))
	die('problem!');

require_once('../lib/user/profile.php');


$user=new User();
$user->connectDB();


$user->login($_POST['loginname'],$_POST['passwordname']);

}   else{

header("Location: login.php");
}