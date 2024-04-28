<?php
include "dbConnect.php"; 

$filter = $_POST["filter"];

if($filter === "all"){
    $sql_helpdesk = "SELECT h.id, u.username, h.topic, h.email, h.content, h.resolved, h.date 
    FROM help_desk AS h
    INNER JOIN users AS u ON u.id = h.user_id ORDER BY date DESC;";
}
else{
    $sql_helpdesk = "SELECT h.id, u.username, h.topic, h.email, h.content, h.resolved, h.date 
    FROM help_desk AS h
    INNER JOIN users AS u ON u.id = h.user_id WHERE resolved = 0 ORDER BY date DESC;";
}


$rows = $connect->query($sql_helpdesk);
$data = [];
while ($row = $rows -> fetch_assoc()){
    $data[] = $row;
}
echo json_encode($data);

?>