<?php
include "dbConnect.php"; 
session_start();
$user_id = $_SESSION['user_id'];
$title = $_POST["title"];
$content = $_POST["content"];
$date = $_POST["date"];

$sql_news_insert = "INSERT INTO `news` (`date`, `title`, `content`, `actual`, `user_id`) VALUES ('" .$date. "','" .$title. "','" .$content. "', '1','" .$user_id. "')";

$connect->query($sql_news_insert);
?>