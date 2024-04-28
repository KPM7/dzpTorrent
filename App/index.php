<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:welcome.php');
    exit;
} else {
    
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/howler@2.2.3/dist/howler.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/scanline.css">
    <link rel="stylesheet" href="css/index_style.css">
    <link rel="stylesheet" href="css/glitch.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/transition.css">
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Torrent</title>
</head>

<body>
    <?php
    include "htmlFunctions.php";
    Html::header();
    ?>

        <div class="" id="transition"></div>
        <div class="under-header">
            <img class="hand" src="imgs/hand.png" alt="hand">
            <img class="skull" src="imgs/skull.png" alt="skull">
            <h1 class="welcome-text">Unlock the <span class="header-span">WIRED</span><br>Torrent the <span>REST</span></h1>
        </div>
        <div class="main">
            <h1 class="title-text">welcome to the<br>project site</h1>
            <div class="main-inside">
                <h2>home:</h2>
                <p class="paragraph">This webpage has been made to share and freely browse <span>torrents</span> and to allow interaction between all registrants. More can be learned about torrents at the <span>FAQ</span> section or if you have any questions head over to the <span>HELPDESK</span>. News about the site can be found below. We hope you enjoy our site. Some features may be still under <span>construction.</span>
                    <br><br>The dzpTorrent Team
                </p>
            </div>
            <div id="news">
                <script src="js/news.js"></script>
            </div>
        </div>
        <?php
        Html::footer();
        ?>
    </body>
    <script src="js/transition.js"></script>
    <script>
        window.addEventListener('load', function(event) {
            var transitionElement = document.getElementById('transition');

        transitionElement.classList.add('ready');

        setTimeout(function() {
            window.scrollTo(0, 0);
        }, 10);

        setTimeout(function() {
            transitionElement.classList.add('over');
        }, 1000);
    });
</script>

</html>
<?php
}
?>