<?php
	require_once ("../config/Database.php");
	header('Content-Type: application/json');

	
	$userId = null;
	$microphonepost = null;
	$postsArray = array();
	$query = "SELECT microphonepost.id as id,microphonepost.name as postName,text,post_date,reply_to,users.name as userName
	          FROM `microphonepost` INNER JOIN users ON microphonepost.user_id=users.id ORDER BY post_date DESC";

	$db = new Database();
	$con = $db->getConnection();
	$result = $con->query($query);
	while ($microphonepost = $result->fetch_object()){
		$microphonepost->replies = array();
		$replyQuery = "SELECT reply.reply_text,users.name FROM `reply` JOIN users ON reply.user_id = users.id WHERE post_id = '$microphonepost->id'";
		$likesQuery = "SELECT COUNT(post_id) AS numLikes FROM likes WHERE post_id = '$microphonepost->id'";
		$replies = $con->query($replyQuery);
		$likes = $con->query($likesQuery);
		while($like = $likes->fetch_object()){
			$microphonepost->numLikes = $like->numLikes;
		}
		while($reply = $replies->fetch_object()){
			array_push($microphonepost->replies,$reply);
		}
		array_push($postsArray,$microphonepost);
	}
	echo(json_encode($postsArray));

?>
