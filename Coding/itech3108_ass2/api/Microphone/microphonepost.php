

<?php
	require_once ("../config/Database.php");
	header('Content-Type: application/json');
	$id = $_GET['id'];
	$userId = null;
	$microphonepost = null;
	$query = "SELECT microphonepost.id as id,
	                microphonepost.name as postName,
	                text,post_date,
	              (SELECT post_id FROM reply WHERE user_id=$userId),
	              users.name as userName,
	              COUNT(likes.post_id) as numLikes
	           FROM `microphonepost` INNER JOIN users ON microphonepost.user_id=users.id
			    AND microphonepost.id = '$id' INNER JOIN likes ON microphonepost.id = likes.post_id  INNER JOIN reply ON reply.user_id= microphonepost.user_id";

	$db = new Database();
	$con = $db->getConnection();
	$result = $con->query($query);
	while ($microphonepost = $result->fetch_object()){
		$microphonepost->replies = array();
		$replyQuery = "SELECT * FROM `reply` WHERE post_id = '$microphonepost->id'";
		$replies = $con->query($replyQuery);
		while($reply = $replies->fetch_object()){
			array_push($microphonepost->replies,$reply);
		}
		echo(json_encode($microphonepost));
	}

?>
