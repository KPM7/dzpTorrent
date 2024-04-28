<?php
include "dbConnect.php"; 
session_start();
$id = $_POST["id"];

$result = $connect->query("SELECT resolved FROM help_desk WHERE id = $id");

if ($result) {
    $row = $result->fetch_assoc();
    
    $resolved_value = $row['resolved'];
    if ($resolved_value == 1) {
        $sql_switch_resolved = "UPDATE help_desk SET resolved='0' WHERE id = $id";
    } else {
        $sql_switch_resolved = "UPDATE help_desk SET resolved='1' WHERE id = $id";
    }
    
    $connect->query($sql_switch_resolved);
} else {
    echo "Hiba a lekérdezésben: " . $connect->error;
}
?>