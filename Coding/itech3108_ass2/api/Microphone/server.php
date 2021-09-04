<?php


// initializing variables
$userid = "";
$username= "";


$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'assignment2');

if (isset($_POST['reg_user'])) {
	// receive all input values from the form
	$userid = mysqli_real_escape_string($db, $_POST['userid']);
	$username = mysqli_real_escape_string($db, $_POST['username']);
	
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	
  
	// form validation: ensure that the form is correctly filled ...
	// by adding (array_push()) corresponding error unto $errors array
	if (empty($userid)) { array_push($errors, "UserId is required"); }
	if (empty($username)) { array_push($errors, "Username is required"); }
	
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if ($password_1 != $password_2) {
	  array_push($errors, "The two passwords do not match");
	}
  
	// first check the database to make sure 
	// a user does not already exist with the same username and/or email
	$user_check_query = "SELECT * FROM users WHERE id='$userid' and name='$username' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	
	if ($user) { // if user exists
	  if ($user['id'] === $userid) {
		array_push($errors, "User ID already exists");
	  }
  
	  if ($user['name'] === $username) {
		array_push($errors, "Name already exists");
	  }
	}
  
	// Finally, register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = get_hash($password_1);//encrypt the password before saving in the database
	  
		$query = "INSERT INTO users (id,name, password) 
				  VALUES('$userid','$username', '$password')";
		mysqli_query($db, $query);
		
		header('location: ../../index.php');
	}
  }
  // LOGIN USER
  if (isset($_POST['login_user'])) {
  
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	
  
	if (empty($username)) {
		array_push($errors, "User Name is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	
	if (count($errors) == 0) {
		$password = get_hash($password);
	  
		$query = "SELECT * FROM users WHERE name='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);
	  $row = mysqli_fetch_array($results,MYSQLI_ASSOC);
		$active = $row['active'];
		
		$count = mysqli_num_rows($results);
		  if($count == 1) {
		   
		
		   
		   header("location: ../../index.php");
		}
		else {
		   $error = "Your Login Name or Password is invalid";
		}
	 }
  }
  
		


function checkUserExist( $username ) {
	$query = "SELECT * FROM users WHERE username = '" . $username . "'";
	global $db;
	$results = mysqli_query( $db, $query );
	$row = mysqli_fetch_assoc( $results );
	if ( $row ) {
		return true;
	} else {
		return false;
	}
}
function get_hash($pass) {
    $bytes = openssl_random_pseudo_bytes(30);
    $random_data = substr(base64_encode($bytes), 0, 22);
    $random_data = strtr($random_data, '+', '.');

    $local_salt = "$2y$12$" . $random_data;
return crypt($pass, $local_salt);    

	for($i = 0; $i < 10; $i++)
		{
    $hash = get_hash($password);
	

   // echo $hash;
   // echo '<br>';
		}
		}



?>