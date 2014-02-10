<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
include('../lib/whatsprot.class.php');

$login=mysql_real_escape_string($_POST['newUser']);
$phone=mysql_real_escape_string($_POST['newPhone']);
if(isset($_POST['smscode']) and strlen($_POST['smscode'])==6){

$smscode=$_POST['smscode'];
require_once('../lib/user/profile.php');


$identity = strtolower(urlencode(sha1($phone, true)));
$w = new WhatsProt($phone, $identity, $login, false);
try{
$result = $w->codeRegister($smscode);
$password = $result->pw;
$user=new User();
$user->connectDB();
$user->newRealUser($phone,$password,$login);
echo "Success!</br>Your Password is $password </br> Запомните или запишите!";


} catch(Exception $e){
echo $e->getMessage();
}
}else{
$identity = strtolower(urlencode(sha1($phone, true)));
$w = new WhatsProt($phone, $identity, $login, false);
try{
$w->codeRequest();
echo "<label>";
echo '<span class="block input-icon input-icon-right">';
echo '<input type="text" id="code" class="span12" placeholder="enter sms code without lines" />';
echo "<i class=\"icon-lock\"></i>";
echo "</span>";
echo "</label>";
}
catch(Exception $e){
echo $e->getMessage();
}
} }



