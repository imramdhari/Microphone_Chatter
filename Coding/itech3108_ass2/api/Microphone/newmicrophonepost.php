<?php
	require_once ("../config/Database.php");


	//assigning post variables
	$name = $_POST['name'];
	$text = $_POST['text'];
	$username = $_POST['username'];
	$replyTo = $_POST['replyto'];

	//check whether reply_to is set
	if($replyTo!=null){
		$query = "INSERT INTO microphonepost(name,text,user_id,reply_to) VALUES('$name','$text',(SELECT id FROM users WHERE name = '$username'),'$replyTo')";
	}else{
		$query = "INSERT INTO microphonepost(name,text,user_id) VALUES('$name','$text',(SELECT id FROM users WHERE name = '$username'))";
	}

	//defining queries
	$getMaxQuery = "SELECT MAX(id) as id FROM microphonepost";
	$checkQuery = "SELECT id FROM microphonepost ORDER BY post_date DESC LIMIT 1";

	//creating datbase instance
	$db = new Database();
	$con = $db->getConnection();

	//getting the max Id from the database
	$maxIdResult = $con->query($getMaxQuery);
	$maxId = $maxIdResult->fetch_assoc();
	$maxId = $maxId['id'];

	//setting the max Id as auto increment value
	$setIdQuery = "ALTER TABLE microphonepost AUTO_INCREMENT = $maxId";
	$con->query($setIdQuery);

	if ($con->query($query)){
		$checkResult = $con->query($checkQuery);
		$post = $checkResult->fetch_assoc();
		$postId = $music['id'];
		header("Location: ../../index.php");
	}

?>
