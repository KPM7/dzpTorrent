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
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/howler@2.2.3/dist/howler.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/scanline.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/upload.css">
        <link rel="stylesheet" href="css/footer.css">
        <title>Upload</title>
    </head>


    <body>
        <?php
        session_start();
        include "htmlFunctions.php";
        Html::header();
        ?>
        <div class="under-header"></div>
        <div class="upload-container">
            <h2 class="uploadh2">Upload:</h2>
            <?php
            if (isset($_SESSION['torrent_error'])) {
                echo '<span class="upload-span"><h2 class="upload-text">' . $_SESSION['torrent_error'] . '</h2></span>';
                unset($_SESSION['torrent_error']);
            } elseif (isset($_SESSION['torrent_success'])) {
                echo '<span class="upload-span"><h2 class="upload-text">' . $_SESSION['torrent_success'] . '</h2></span>';
                unset($_SESSION['torrent_success']);
            }
            ?>
            <div class="upload">
                <div class="form-upload">
                    <form action="torrentUpload.php" method="post" enctype="multipart/form-data">
                        <label for="label">
                            <p>Select a <span>.torrent</span> file to upload:</p>
                        </label>
                        <input accept=".torrent" required type="file" class="input-torrent" name="torrentUpload">
                        <br>
                        <label for="torrent-name">
                            <p>Display name (optional):</p>
                        </label>
                        <input class="torrent-dname" name="torrent-dname" placeholder="Display name" type="text">
                        <br>
                        <label for="torrent-dname">
                            <p>Category:</p>
                        </label>
                        <select class="torrent-category" name="torrent-category">
                            <option value="">Select a category</option>
                            <option value="1">Movie</option>
                            <option value="2">Series</option>
                            <option value="3">Lossy Audio</option>
                            <option value="4">Lossless Audio</option>
                            <option value="5">Software - Application</option>
                            <option value="6">Software - Game</option>
                            <option value="7">Pictures</option>
                            <option value="8">Literature</option>
                        </select>
                        <label for="torrent-description">
                            <p>Description:</p>
                        </label>
                        <textarea rows="10" cols="100" class="torrent-description" name="torrent-description"></textarea>
                        <br><br>
                        <label for="anonymous">
                            <p>Upload as Anonymous?</p>
                            <input class="checkbox" type="checkbox" id="anonymous" name="anonymous">
                        </label>
                        <input type="submit" class="upload-btn" value="Upload" name="submit">
                    </form>
                </div>
            </div>
        </div>
        <?php
        Html::footer();
        ?>
    </body>

    </html>
<?php
}
?>