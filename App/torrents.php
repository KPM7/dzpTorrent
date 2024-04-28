<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location:welcome.php');
    exit;
}
else
{
    ?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/scanline.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/torrents.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/glitch.css">
    <title>Torrents</title>
</head>
<?php
include "htmlFunctions.php";
Html::header();
?>
<div class='torrent-head'>
<img class="banner" src="imgs/bannner2.png">
<h3>╟ T o r r e n t s ╢</h3>
</div>
<div class="torrent-list">
    <?php
    include_once "dbConnect.php";
    include "torrent_listing.php";
    ?>
</div>
<?php
Html::footer();
?>
</body>

</html>
<?php
}
?>