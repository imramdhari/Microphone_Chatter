<?php
	class Database{
		private $host = 'localhost';
		private $user = 'root';
		private $password = '';
		private $dbName = 'assignment2';
	
	
		public function getConnection(){
			$con = mysqli_connect($this->host,$this->user,$this->password,$this->dbName);
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			return $con;
		}
	
	}
	
?>