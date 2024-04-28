<?php
include "dbConnect.php";
session_start();
$user_id = $_SESSION['user_id'];
$date = $_POST["date"];
$message = $_POST["message"];

if (!empty($message)) {
    $sql_message_insert = "INSERT INTO `chat` (`user_id`, `date`, `content`) VALUES ('" . $user_id . "','" . $date . "','" . $message . "')";
    $connect->query($sql_message_insert);
}

?>