<?php
    require_once ("../config/Database.php");
    header('Content-Type: application/json');

    $microId = $_POST['microId'];
    $userName = $_POST['username'];
    $text=$_POST['text']

    $query = "INSERT INTO likes(post_id,user_id,text) VALUES 
    ($microId,
    (SELECT id FROM users WHERE name = '$userName'),
    (SELECT text from microphonepost WHERE id= $microId)
    )";
    $db = new Database();
    $con = $db->getConnection();
    $con->query($query);
    header("Location: ../../index.php");
?>
