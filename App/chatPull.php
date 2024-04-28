<?php
include "dbConnect.php";

$start = $_POST["start"];
$count = $_POST["count"];

$messages = "SELECT c.date, c.content, u.username
FROM chat AS c
INNER JOIN users AS u ON u.id = c.user_id
ORDER BY date DESC
LIMIT $start, $count";


$rows = $connect->query($messages);
$data = [];
while ($row = $rows->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);

?>