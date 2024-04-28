<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "dbConnect.php";

    $email = trim($_POST["email"]);

    if (empty($email)) {
        $_SESSION['update_error'] = "Missing email field.";
        header("Location: profile.php");
        exit;
    }

    $username = $_SESSION['username'];
    $sql_check_email = "SELECT email FROM users WHERE email = '$email' AND username != '$username'";
    $result_check_email = $connect->query($sql_check_email);

    if ($result_check_email->num_rows > 0) {
        $_SESSION['update_error'] = "The new email is already in use by another user.";
        header("Location: profile.php");
        exit;
    }

    $sql_update_email = "UPDATE users SET email = '$email' WHERE username = '$username'";
    if ($connect->query($sql_update_email) === TRUE) {
        $_SESSION['update_success'] = "Email updated successfully.";
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION['update_error'] = "Failed to update email.";
        header("Location: profile.php");
        exit;
    }
}
?>
