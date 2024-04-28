<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adminInterface.css">
    <link rel="stylesheet" href="css/scanline.css">
    <link rel="stylesheet" href="css/news.css">
    <title>Admin Interface</title>
</head>

<body>
    <div class='header'>
        <img class='p_logo' src='imgs/headerlogo.png' alt=''>
        <div class='header-buttons'>
            <a href="adminInterface.php?mod=torrent">Torrents</a>
            <a href="adminInterface.php?mod=user">Users</a>
            <a href="adminInterface.php?mod=helpdesk">Helpdesk</a>
            <a href="adminInterface.php?mod=chat">Chat</a>
            <a href="adminInterface.php?mod=news">News</a>
            <a id="back" href="index.php">Back to the main page</a>
        </div>
    </div>
    <div id="content">
        <?php
        session_start();
        include "adminFunctions.php";
        if (isset($_GET["mod"]) && $_GET["mod"] == "torrent") {
            Admin::torrents();
        } else if (isset($_GET["mod"]) && $_GET["mod"] == "user") {
            Admin::users();
        } else if (isset($_GET["mod"]) && $_GET["mod"] == "helpdesk") {
            Admin::helpdesk();
        } else if (isset($_GET["mod"]) && $_GET["mod"] == "chat") {
            Admin::chat();
        } else if (isset($_GET["mod"]) && $_GET["mod"] == "news") {
            Admin::news();
        } else {
            Admin::base();
        }
        ?>
    </div>
</body>

</html>