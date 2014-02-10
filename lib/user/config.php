<?php
try {  
  
  $host='localhost';
  $dbname='whatsapp';
  $user='root';
  $pass='';
  $driver = array(PDO :: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES `utf8`');
  # MySQL через PDO_MYSQL  
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass,$driver);  
   
}  
catch(PDOException $e) {  
    echo $e->getMessage('test');  
}

?>