<?php
include "dbConnect.php"; 

$search = $_POST["search"];

$sql = "SELECT u.id, u.username, u.email, r.name, u.reg_time, u.silenced 
        FROM users AS u 
        INNER JOIN rank AS r ON r.id = u.class_id 
        WHERE username LIKE '%$search%' ORDER BY id DESC;";

$rows = $connect->query($sql);
$data = [];
while ($row = $rows -> fetch_assoc()){
    $data[] = $row;
}
echo json_encode($data);

?>