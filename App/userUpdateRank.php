<?php
include "dbConnect.php"; 
session_start();
$id = $_POST["id"];

$result = $connect->query("SELECT class_id FROM users WHERE id = $id");

if ($result) {
    $row = $result->fetch_assoc();
    
    $class_id_value = $row['class_id'];
    if ($class_id_value == 1) {
        $sql_switch_class_id = "UPDATE users SET class_id='2' WHERE id = $id";
    } else if ($class_id_value == 2) {
        $sql_switch_class_id = "UPDATE users SET class_id='3' WHERE id = $id";
    } else {
        $sql_switch_class_id = "UPDATE users SET class_id='1' WHERE id = $id";
    }
    
    $connect->query($sql_switch_class_id);
} else {
    echo "Hiba a lekérdezésben: " . $connect->error;
}
?>