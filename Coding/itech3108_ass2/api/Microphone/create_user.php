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
 
// instantiate product object
$createUser = new Microphone($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$microphone->id= $data->id;
$microphone->name = $data->name;
$microphone->password = $data->password;

 
// create the user
if(
    !empty($user->id) &&
    !empty($user->name) &&
    !empty($user->password) &&
    $createUser->createNewUser()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "User was created."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create user."));
}
?>