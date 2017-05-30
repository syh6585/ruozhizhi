<?php
class Mysql{
	private $conn;
	function __construct(){
		$servername = "localhost";
		$username = "root";
		$password = "wujundidao";
		$dbname = "mlDB";
		$this->conn = new mysqli($servername, $username, $password,$dbname);
		if ($this->conn->connect_error) {
			die("connect_error!" . $this->conn->connect_error);
		} 
	}		
	
	function __destruct(){
		$this->conn->close();
	}

	public function select($tablename,$where){
		$sql="SELECT * FROM ".$tablename." WHERE ".$where;
		return $this->conn->query($sql);
	}
	public function update($tablename,$set,$where){
		$sql="UPDATE ".$tablename." SET ".$set." WHERE ".$where;
		return $this->conn->query($sql);
	}

	public function insert($tablename,$cols,$vals){
		$sql="INSERT INTO ".$tablename." ".$cols." VALUES ".$vals;
		return $this->conn->query($sql);
	}
	
	public function lastid(){
		return mysqli_insert_id($this->conn);
	}
	
	public function delete($tablename,$where){
		$sql="DELETE FROM ".$tablename." WHERE ".$where;
		return $this->conn->query($sql);
	}

}
?>

