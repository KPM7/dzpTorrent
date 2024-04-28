<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    include "dbConnect.php";
    $sql = "SELECT dot_torrent_file, file_name FROM torrents WHERE id = $id";
    $result = $connect->query($sql);
    $connect->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header('Content-type: application/x-bittorrent');
        header('Content-Disposition: attachment; filename="' . $row["file_name"] . '.torrent"');
        //header("Content-length: $size");
        echo $row["dot_torrent_file"];
    } else {
        die('File does not exist');
    }
} else {
    die('Invalid request');
}
?>