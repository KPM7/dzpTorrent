<?php
include "dbConnect.php";
session_start();
$user_id = $_SESSION['user_id'];
$content = $_POST["content"];
$topic = $_POST["topic"];
$email = $_POST["email"];

$helpdesk_insert = "INSERT INTO `help_desk` (`user_id`, `topic`, `email`, `content`, `resolved`, `date`) 
VALUES ('" . $user_id . "','" . $topic . "','" . $email . "','" . $content . "','0', NOW())";

$connect->query($helpdesk_insert);

?>