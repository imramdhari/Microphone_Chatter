<?php
    require_once ("../config/Database.php");
    header('Content-Type: application/json');

    $db = new Database();
	$con = $db->getConnection();
    $query = "SELECT * FROM users";
    $result = $con->query($query);
    $userArray = array();
    while($user = $result->fetch_object()){
        array_push($userArray,$user);
    }
    echo(json_encode($userArray));
?>
