<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../api/config/Database.php';
include_once '../Class/Microphone.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$microphone = new Microphone($db);
  
// query posts
$stmt = $microphone->read();
$num = $stmt->rowCount();
// query users
$stmt1 = $microphone->readUser();
$num1 = $stmt1->rowCount();

// query likes
$stmt2 = $microphone->readLikes();
$num2 = $stmt2->rowCount();

// query checking reply
$stmt3 = $microphone->checkReply();
$num3 = $stmt3->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $microphone_arr=array();
    $microphone_arr["Microphone Posts"]=array();
  
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $microphone_posts=array(
            "id" => $id,
            "name" => $name,
			"user_id" => $user_id,
			"post_date" =>$post_date,
            "text" => html_entity_decode($text),
            "likes" => $likes,
            "reply_to" => $reply_to
           
        );
  
        array_push($microphone_arr["Microphone Posts"], $microphone_posts);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($microphone_arr);
}
  
// no posts  found will be here

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No posts found.")
    );
}

// check if more than 0 user found
if($num1>0){
  
    // products array
    $users_arr=array();
    $users_arr["Users"]=array();
  
    
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row1);
  
        $users_lists=array(
            "id" => $id,
            "name" => $name,
			"password" => $password
			
          );
  
        array_push($users_arr["Users"], $users_lists);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show users data in json format
    echo json_encode($users_arr);
}
  
// no user  found will be here

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No user found.")
    );
}

// check if more than 0 likes found
if($num2>0){
  
    // products array
    $likes_arr=array();
    $likes_arr["Likes"]=array();
  
    
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row2);
  
        $likes_lists=array(
            "post_id" => $id,
            "user_id" => $user_id
		
			
          );
  
        array_push($likes_arr["Likes"], $likes_lists);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show users data in json format
    echo json_encode($likes_arr);
}
  
// no user  found will be here

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No post likes found.")
    );
}

// check if more than 0 record found
if($num3>0){
  
    // products array
    $reply_arr=array();
    $reply_arr["Microphone Posts Reply"]=array();
  
    
    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row3);
  
        $posts_reply=array(
            "post_id" => $post_id,
            "text" => $text,
			"user_id" => $user_id,
			"post_date" =>$post_date
        
           
        );
  
        array_push($reply_arr["Microphone Posts Reply"], $posts_reply);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($reply_arr);
}
  
// no posts  found will be here

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No posts found.")
    );
}

