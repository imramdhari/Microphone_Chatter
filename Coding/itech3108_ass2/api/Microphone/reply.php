<?php
    require_once ("../config/Database.php");
    header('Content-Type: application/json');

    $text = $_POST['text'];
    $user = $_POST['user'];
    $id = $_POST['id'];

    $query = "INSERT INTO reply(reply_text,post_id,user_id) VALUES ('$text','$id',(SELECT id FROM users WHERE name = '$user'))";

    $db = new Database();
    $con = $db->getConnection();

    if($con->query($query)){
        echo(json_encode('true'));
        header("Location: ../../index.php");
    }

?>
