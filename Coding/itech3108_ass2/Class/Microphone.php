<?php



class Microphone{
  
    // database connection and table name
    private $conn;
    private $table_name = "microphonepost";
  
    // object properties
    public $id;
    public $name;
    public $title;
    public $text;
    public $date;
    public $likes;
    public $reply_to;
	public $password;
	public $user_id;
	public $post_id;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read posts
function read(){
  
    // select all query
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
               
            ORDER BY
                post_date DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
function readUser(){
  
    // select all query
    $query = "SELECT
                *
            FROM
                users
               
            ORDER BY
                id DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
function readLikes(){
  
    // select all query
    $query = "SELECT
                *
            FROM
                likes
				ORDER BY 
               
            post_id DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
function createNewUser(){
	$query= "INSERT INTO users (id,name, password)
VALUES ($id,$name,$password)";
	$stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
   return stmt;
	
}

function checkReply(){
  
    // select all query
    $query = "SELECT
                *
            FROM
                reply
				ORDER BY 
               
            post_id ";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
}
?>