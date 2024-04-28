<?php
include "dbConnect.php";
require 'vendor/autoload.php';
// https://github.com/arokettu/bencode = composer require 'arokettu/bencode' --- ezt kell leszedni.
// https://en.wikipedia.org/wiki/Torrent_file
// https://chocobo1.github.io/bencode_online/ --- teszteléshez.
// https://wiki.theory.org/BitTorrentSpecification#Tracker_Request_Parameters --- doksi
use Arokettu\Bencode\Bencode;

$max_file_size = 1048576; // byte - ez egy 1MB
if (isset($_POST["submit"])) {
    if ($_FILES["torrentUpload"]["error"] == UPLOAD_ERR_OK) {
        $allowed_file_types = array("application/x-bittorrent", "application/octet-stream");
        if (!in_array($_FILES["torrentUpload"]["type"], $allowed_file_types)) {
            $_SESSION['torrent_error'] = "Only .torrent files are allowed.";
            header("Location: upload.php");
            exit;
        } elseif ($_FILES["torrentUpload"]["size"] > $max_file_size) {
            $_SESSION['torrent_error'] = "The .torrent file exceeds 1MB.";
            header("Location: upload.php");
            exit;
        } else {
            $category_id = $_POST["torrent-category"];
            $torrent_display_name = $_POST["torrent-dname"];
            $torrent_description = $_POST["torrent-description"];
            $verified = 1;
            $rating_avg = 0;
            $seeders = 0;
            $leechers = 0;
            $completed = 0;
            $anonim = 0;
            $torrent_blob = file_get_contents($_FILES["torrentUpload"]["tmp_name"]);
            session_start();
            if (isset($_SESSION['username'])) {
                $user_id = $_SESSION['user_id'];
            }
            if (isset($_POST['anonymous']) && $_POST['anonymous'] === 'on') {
                $anonim = 1;
            }
            try {
                //dekódolás
                $data = Bencode::decode($torrent_blob);
                $tracker = $data['announce'];
                $tracker_list = $data['announce-list'];
                $create_date = $data['creation date']; //unix időbélyeg, $formatted_date = date('Y-m-d H:i:s', $create_date);
                $upload_time = date("Y-m-d H:i:s");
                $total_torrent_size = 0;
                $file_names = array();
                if (isset($data['info']['files'])) { // többfájlos torrent esetén
                    $number_of_files = count($data['info']['files']);
                    foreach ($data['info']['files'] as $file) {
                        $total_torrent_size += $file['length']; //byte-ban adja meg.
                    }
                    foreach ($data['info']['files'] as $file) {
                        $file_names[] = $file['path']; //ezek lényegében mappa tartalmai.
                    }
                } else { // egyfájlos torrent esetén
                    $number_of_files = 1;
                    $total_torrent_size = $data['info']['length'];
                    $file_names[] = $data['info']['name'];
                }
                $torrent_name = $data['info']['name'];
                $infohash = sha1(Bencode::encode($data['info'])); // ("A torrent is uniquely identified by an infohash, a SHA-1 hash calculated over the contents of the info dictionary in bencode form.")  

                // curl
                function processHash($infohash)
                {
                    $chunks = str_split($infohash, 2);
                    $uppercaseChunks = array_map('strtoupper', $chunks);
                    $result = implode('%', $uppercaseChunks);
                    return '%' . $result;
                }
                function portSplit($tracker)
                {
                    preg_match('/:(\d+)\//', $tracker, $matches);
                    return $matches[1];
                }

                $port = portSplit($tracker);
                $encoded_hash = processHash($infohash);
                $peer_id = str_split(uniqid('', true), 20)[0];
                $api_url = "{$tracker}?info_hash={$encoded_hash}&compact=1&peer_id={$peer_id}&port={$port}";
                $api_req = curl_init($api_url);
                curl_setopt($api_req, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($api_req);
                if ($response === false) {
                    $seeders = 0;
                    $leechers = 0;
                    $completed = 0;
                } else {
                    $decoded_response = Bencode::decode($response);
                    $seeders = isset($decoded_response['complete']) ? $decoded_response['complete'] : 0;
                    $leechers = isset($decoded_response['incomplete']) ? $decoded_response['incomplete'] : 0;
                    $completed = isset($decoded_response['downloaded']) ? $decoded_response['downloaded'] : 0;
                }
                curl_close($api_req);

                //SQL adatbázis cuccli 
                $insert_query = "INSERT INTO torrents (user_id, file_name, upload_time, category_id, torrent_size, file_number, rating_avg, torrent_description, dot_torrent_file, info_hash, verified, tdisplay_name, seeders, leechers, completed, is_anonymous) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?)";
                $stmt = $connect->prepare($insert_query);
                $stmt->bind_param("isssiiidssisiiii", $user_id, $torrent_name, $upload_time, $category_id, $total_torrent_size, $number_of_files, $rating_avg, $torrent_description, $torrent_blob, $infohash, $verified, $torrent_display_name, $seeders, $leechers, $completed, $anonim);
                $stmt->execute();
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $_SESSION['torrent_success'] = "Torrent uploaded successfully.";
                    header("Location: upload.php");
                    exit;
                } else {
                    $_SESSION['torrent_error'] = "Torrent was not uploaded due to some error.";
                    header("Location: upload.php");
                    exit;
                }
                $stmt->close();

                /*
                echo '<pre>';
                echo $decoded_response->complete . "\n";
                foreach ($decoded_response as $key => $value) {
                    echo "$key - $value\n";
                }
                echo gettype($decoded_response);
                echo "\n\n";
                var_dump($decoded_response);
                echo "\n\n";
                print_r($decoded_response);
                echo $api_url, "\n\n\n";
                echo "--- Trackerssss lista: ---\n";
                print_r($tracker_list);
                echo "\n--- Tracker lista: ---\n";
                print_r($tracker);
                echo "\n--- Mikor lett csinálva a torrent: ---\n";
                echo date('Y-m-d H:i:s', $create_date), "\n\n";
                echo "--- Mikor lenne feltöltve az adatbázisba: ---\n";
                echo $upload_time, "\n\n";
                echo "--- Fájlok mennyisége: ---\n";
                echo $number_of_files, "\n\n";
                echo "--- Fájlok egységes mérete: ---\n";
                echo $total_torrent_size, "\n\n";
                echo "--- Torrent neve: ---\n";
                echo $torrent_name, "\n\n";
                echo "--- Fájlok: ---\n";
                print_r($file_names);
                echo "--- Infohash: ---\n";
                echo $infohash, "\n\n";
                //echo "--- Teljes dekódolt adatok: ---\n";
                //print_r($data);
                echo '</pre>'; */
            } catch (Exception $e) {
                echo "Hiba a dekódolás során: " . $e->getMessage();
            } finally {
                mysqli_close($connect);
            }
        }
    } else {
        echo "An error occured: " . $_FILES["torrentUpload"]["error"];
    }
}
