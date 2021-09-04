<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../api/config/Database.php';
include_once '../Class/Microphone.php';

$database = new Database();
$db = $database->getConnection();
  
$microphone = new Microphone($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->username) &&
    !empty($data->text) 
    
){
    // set product property values
    $microphone->name = $data->name;
    $microphone->text = $data->text;
    $microphone->$username =$data->username;
    $microphone->$reply_to=$data->reply_to;
    
  
    // create the post
   if ($microphone->createNewPost()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Post was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create post."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create post. Data is incomplete."));
}
?>