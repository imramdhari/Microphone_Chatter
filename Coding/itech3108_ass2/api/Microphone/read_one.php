<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../../objects/microphone.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare microphone object
$microphone = new Microphone($db);
  
// set ID property of record to read
$microphone->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of microphone to be edited
$microphone->readOne();
  
if($microphone->name!=null){
    // create array
    $microphone_arr = array(
        "id" =>  $microphone->id,
        "name" => $microphone->name,
        "title" => $microphone->title,
        "text" => $microphone->text,
        "post_date" => $microphone->post_date,
        "reply_to" => $microphone->reply_to
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($microphone_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user microphone does not exist
    echo json_encode(array("message" => "microphone post does not exist."));
}
?>