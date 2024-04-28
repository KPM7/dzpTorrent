<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "dzp_torrent";

$connect = mysqli_connect($servername, $username, $password, $db);

if ($connect->error) {
    die ("Connection failed: " . $connect->error);
}