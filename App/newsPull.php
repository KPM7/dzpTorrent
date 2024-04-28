<?php
include "dbConnect.php";

$actual = $_POST["actual"];

$news = "SELECT n.date, n.title, n.content FROM news AS n WHERE actual = $actual";

$rows = $connect->query($news);
$data = [];
while ($row = $rows -> fetch_assoc()){
    $data[] = $row;
}
echo json_encode($data);

?>