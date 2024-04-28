<?php
include "dbConnect.php"; 
session_start();
$id = $_POST["id"];

$result = $connect->query("SELECT silenced FROM users WHERE id = $id");

if ($result) {
    $row = $result->fetch_assoc();
    
    $silenced_value = $row['silenced'];
    if ($silenced_value == 1) {
        $sql_switch_silenced = "UPDATE users SET silenced='0' WHERE id = $id";
    } else {
        $sql_switch_silenced = "UPDATE users SET silenced='1' WHERE id = $id";
    }
    
    $connect->query($sql_switch_silenced);
} else {
    echo "Hiba a lekérdezésben: " . $connect->error;
}
?>