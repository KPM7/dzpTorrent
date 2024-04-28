<?php
include "dbConnect.php";

$category_names = array(
    1 => "Movie",
    2 => "Series",
    3 => "Lossy Audio",
    4 => "Lossless Audio",
    5 => "Software - Application",
    6 => "Software - Game",
    7 => "Pictures",
    8 => "Literature"
);

$sql = "SELECT t.id, t.category_id, t.file_name, t.torrent_size, t.upload_time, t.user_id, t.seeders, t.leechers, t.completed, t.is_anonymous, u.username
FROM torrents AS t
INNER JOIN users AS u ON u.id = t.user_id";


$result = $connect->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table-list'>
            <tr>
                <th class='table-category'>Category</th>
                <th>Name</th>
                <th>Link</th>
                <th class='table-size'>Size</th>
                <th class='table-date'>Date</th>
                <th>Uploader</th>
                <th title='Seeders'>⬆</th>
                <th title='Leechers'>⦾</th>
                <th title='Completed downloads'>✔</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        if (isset($category_names[$row["category_id"]])) {
            $category_name = $category_names[$row["category_id"]];
            $uploader = ($row["is_anonymous"] == 1) ? "Anonymous" : $row["username"];
            $size = $row["torrent_size"];
            $formatted_size = ($size >= 1024 * 1024 * 1024) ? number_format($size / (1024 * 1024 * 1024), 2) . " GiB" : number_format($size / (1024 * 1024), 2) . " MiB"; // torrent méret formázása
            echo "<tr>
                    <td>" . $category_name . "</td>
                    <td class='table-name'>" . $row["file_name"] . "</td>
                    <td><a href='torrent_download.php?id=" . $row["id"] . "' target='_blank'>⇓</a></td>
                    <td>" . $formatted_size . "</td>
                    <td>" . $row["upload_time"] . "</td>
                    <td>" . $uploader . "</td>
                    <td>" . $row["seeders"] . "</td>
                    <td>" . $row["leechers"] . "</td>
                    <td>" . $row["completed"] . "</td>
                </tr>";
        }
    }

    echo "</table>";
} else {
    echo "0 results";
}

$connect->close();
?>
