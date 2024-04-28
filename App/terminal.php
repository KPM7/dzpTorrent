<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/scanline.css">
    <link rel="stylesheet" href="css/terminal.css">
    <link rel="stylesheet" href="css/transition.css">
    <link rel="stylesheet" href="css/glitch.css">
    <title>Terminal</title>
</head>
<body>
    <div id="shutdown-area-terminal" class="">
        <div id="screen" class="screen">
            <div class="content">
                <div class="bezer" onclick="$('texter').focus();">
                    <div class="container">
                        <?php
                        if (isset($_GET["mode"]) && $_GET["mode"] == "reg") {
                            include "register.php";
                        } else {
                            include "login.php";
                        }
                        ?>
                    </div>
                    <div class="error"><?php echo $error_message; ?></div>
                </div>
            </div>
        </div>
    </div>
    <!--<script src="js/terminal_scripts.js"></script>-->
    <script src="js/transition.js"></script>
</body>

</html>