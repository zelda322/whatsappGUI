<?php

class User{

	private $config='config.php';
	public $notFound = "404.html";	
	public $dbLink;

	function __construct(){
		session_start();
	}
	public function connectDB(){
		try {  
  
	  $host='localhost';
	  $dbname='whatsapp';
	  $user='root';
	  $pass='';
	  $driver = array(PDO :: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES `utf8`');
  	
  	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass,$driver);  
   
		}  
		catch(PDOException $e) {  
    			echo $e->getMessage('test');  
			}

		$this->dbLink=$DBH;
		$this->dbLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}


	public function newRealUser($phone,$password,$login){

        	if(!$this->dbLink)
			die('no link for db newUser');

			$data=array($phone,$login,$password);
			$query=$this->dbLink->prepare("INSERT INTO users( phone, login,password, image) values ( ?, ?, ?,'pictures/user.jpg')");
			$query->execute($data);



	}
		
	
	public function newUser($id,$phone,$login,$image){
		if(!$this->dbLink)
			die('no link for db newUser');

			$data=array($id,$phone,$login,$image);
			$query=$this->dbLink->prepare("INSERT INTO contacts(user_id, phone, login, image) values ( ?, ?, ?, ?)");
			$query->execute($data);


	}

	public function newMsg($id,$contact_id,$msg,$login){
			$data=array($id,$contact_id,$login,$msg);
                	$query=$this->dbLink->prepare("INSERT INTO messages(user_id,contact_id,login,msg,msgtime) values ( ?, ?, ?, ?,NOW())");
			$query->execute($data);



	}

	private	function checkEmail($email,$login){
		if(!$this->dbLink)
			die('no link for db checkEmail');
				
		$exists = $this->dbLink->prepare("SELECT COUNT(*) as count FROM users WHERE email=? or login=?");
		$exists->execute(array($email,$login));
		while($row=$exists->fetch()){
		if($row['count']==0){
			return true;
		}else{
		        return false;
			}}
			

		
	}

	public function login($phone,$password){
		if(!$this->dbLink)
			die('no link for db checkEmail');
		

                $login=$this->dbLink->prepare("SELECT id FROM users WHERE phone='$phone' AND password='$password'");
                	$login->setFetchMode(PDO::FETCH_OBJ);
			if($login->execute()){
				$row=$login->fetch();
				if($row === false){
	        			die('password  or login incorrect');
 				}else{
        				$_SESSION['logged']=true;
        				$_SESSION['user']=$row->id;
        				header("Location: index.php ");
        			}

	
	}
        
	}

		public function getUser($id){
		if(!$this->dbLink)
			die('no link for db getPost');

		$query =$this->dbLink->query("SELECT id,phone,login,image from users WHERE id=$id");  
		$query->setFetchMode(PDO::FETCH_OBJ);
		return $query;

		}

		public function getId($phone,$id){
		if(!$this->dbLink)
			die('no link for db getPost');
	
		$query =$this->dbLink->query("SELECT id from contacts WHERE phone=$phone AND user_id=$id");  
		$query->setFetchMode(PDO::FETCH_OBJ);
		return $query;

		}


		public function getContacts($id){
                   		if(!$this->dbLink)
			die('no link for db getPost');

		$query =$this->dbLink->query("SELECT id,phone,login from contacts WHERE user_id=$id");  
		$query->setFetchMode(PDO::FETCH_OBJ);
		return $query;


			}

		public function checkContact($id,$contact_id){
                        if(!$this->dbLink)
				die('no link for db getPost');

		$query =$this->dbLink->query("SELECT id from contacts WHERE user_id=$id AND id=$contact_id");  
		$query->setFetchMode(PDO::FETCH_OBJ);
		if($query->execute()){
			$row=$query->fetch();
				if($row === false){
	        			return false;
 				}else{
        				return true;
        			}

	



			}}

				public function getContactImage($id){
                   		if(!$this->dbLink)
					die('no link for db getPost');

			$query =$this->dbLink->query("SELECT image FROM contacts WHERE id=$id");  
			$query->setFetchMode(PDO::FETCH_OBJ);
			return $query;
		        
			

			}


		public function getUserPhone($id){
                        	if(!$this->dbLink)
					die('no link for db getPost');

		$query =$this->dbLink->query("SELECT phone,password FROM users WHERE id=$id");  
		$query->setFetchMode(PDO::FETCH_OBJ);
		return $query;

		}
		public function getContactPhone($id){
                        	if(!$this->dbLink)
					die('no link for db getPost');

		$query =$this->dbLink->query("SELECT phone FROM contacts WHERE id=$id");  
		$query->setFetchMode(PDO::FETCH_OBJ);
		return $query;
			


			}

		public function getMsg($id,$contactId){
			if(!$this->dbLink)
				die('no link for db getPost');

		$query =$this->dbLink->query("SELECT id,user_id,login,msg,msgtime from messages WHERE user_id=$id AND contact_id=$contactId ORDER BY id DESC LIMIT 10");  
		$query->setFetchMode(PDO::FETCH_OBJ);
		return $query;



			}

		public function checkSession(){

			if(!isset($_SESSION['logged']) AND !isset($_SESSION['user'])){
				header("Location: login.php");
				exit;
		}
		}

		


}
