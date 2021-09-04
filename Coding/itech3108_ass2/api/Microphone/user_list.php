<?php

// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
      
 
// files needed to connect to database
include_once '../config/Database.php';
include_once '../../objects/Microphone.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

  
    $query = "SELECT * FROM users";
    $result = $db->query($query);
    $userlistArray = array();
    while($users = $result->fetch_object()){
        array_push($userArray,$users);
    }
    echo(json_encode($userlistArray));
?>
