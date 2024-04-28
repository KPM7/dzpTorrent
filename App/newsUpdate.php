<?php
include "dbConnect.php"; 
session_start();
$title = $_POST["title"];
$content = $_POST["content"];
$id = $_POST["id"];

$sql_news_insert = "UPDATE news SET title='$title', content='$content' WHERE id = $id";


$connect->query($sql_news_insert);
?>