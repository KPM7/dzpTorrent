<?php
session_start();

include_once "dbConnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $targetDir = "avatar_uploads/";
    $targetFile = $targetDir . basename($_FILES["avatar"]["name"]);
    $upload = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if ($check !== false) {
        $upload = 1;
    } else {
        echo "The file is not an image.";
        $upload = 0;
    }

    if ($_FILES["avatar"]["size"] > 500000) {
        echo "The file is too big.";
        $upload = 0;
    }

    if ($upload == 1) {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
            $avatarPath = $targetFile;
            $stmt = $connect->prepare("UPDATE users SET avatar_path = ? WHERE username = ?");
            $stmt->bind_param("ss", $avatarPath, $username);
            $stmt->execute();
            $stmt->close();
            $_SESSION['update_success'] = "Avatar successfully updated.";
        } else {
            $_SESSION['update_error'] = "There was an error.";
        }
    }
    header('Location: profile.php');
    exit;
}
?>
