<?php
class php74{
	private $conn;

	
	public function __construct($host,$user,$pass,$db){
		
	$this->conn=new MySQLi($host,$user,$pass,$db);
	
	if($this->conn->errno){
		die("Connection Fail ".$this->conn->error);
	}
	/*else{
		echo "Connection Success";	
	}*/
		//echo "Hello";	
	}
	
	public function getAll($table,$cols){
		$sql="SELECT $cols FROM $table";
		$result=$this->conn->query($sql);
		
		if($result->num_rows>0){
			
			return $result->fetch_all(MYSQLI_ASSOC);
			
		}
		else{
			return false;	
		}
	}

	public function getById($table,$cols,$condition){

		$sql="SELECT $cols FROM $table WHERE $condition";
		//echo $sql;
		$result=$this->conn->query($sql);
		if($result->num_rows>0){
			return $result->fetch_assoc();
		}
		else{
			return false;	
		}
	}
	public function login($table,$cols,$condition){

		$sql="SELECT $cols FROM $table WHERE $condition";
		//echo $sql;
		$result=$this->conn->query($sql);
		if($result->num_rows>0){
			return $result->fetch_assoc();
		}
		else{
			return false;	
		}
	}

	public function Insert($table,$cols){
		$sql="INSERT INTO $table SET $cols";
		$result=$this->conn->query($sql);
		if($this->conn->affected_rows>0){
			return true;
		}
		else{
			return false;
		}
	}

		public function Update($table,$cols,$condition){
		$sql="UPDATE $table SET $cols WHERE $condition";
		$result=$this->conn->query($sql);
		if($this->conn->affected_rows>0){
			return true;
		}
		else{
			return false;
		}
	}


	public function Delete($table,$condition){
		$sql="DELETE FROM $table WHERE $condition";
		$result=$this->conn->query($sql);
		if($this->conn->affected_rows>0){
			return true;
		}
		else{
			return false;
		}
	}
	public function current_url_2(){

		$url = $_SERVER['REQUEST_URI']; //returns the current URL
		echo $url;
		$parts = explode('/',$url);
		echo "<pre>";
		print_r($parts);
		echo "</pre>";
		$dir = $_SERVER['SERVER_NAME'];
	//cho "<br>".$dir;
		for ($i = 0; $i < count($parts) - 1; $i++) {
			echo $parts[$i];
 			$dir .= $parts[$i] . "/";
		}
		echo "<br>".$dir."<br>";
		//return "http://".$dir;
	}

	public function current_url(){

		$url = $_SERVER['REQUEST_URI']; //returns the current URL
		$parts = explode('/',$url);
		$dir = $_SERVER['SERVER_NAME'];
		for ($i = 0; $i < count($parts) - 1; $i++) {
 			$dir .= $parts[$i] . "/";
		}
		return "http://".$dir;
	}

	public function encryptPassword($pass){
		$result = password_hash("$pass",PASSWORD_DEFAULT);

		return $result;
	}
}

$obj=new php74("localhost","root","","php74");
//echo "<pre>";
//$students=$obj->getAll("students","name,mobile");

//print_r($obj->getById("students","*","id=1"));

//echo $obj->Insert("students","name='Hasan',mobile='017884488',address='Pabna,Bangladesh'")?"Insert Success":"Insert Fail";