<?php
session_start();

include "dbConnect.php";
include "pwdHashSalt.php";
include "htmlFunctions.php";

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["pwd"]);
    $email = trim($_POST["email"]);
    $date = date("Y/m/d");

    if (empty($username) && empty($password) && empty($email)) {
        $error_message = "<span>!ERROR: Input_(data) fields null!</span>";
    } else {
        if (empty($username)) {
            $error_message = "<span>!ERROR: userdata_(name) required!</span>";
        } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $error_message = "<span>!ERROR: data_(name) can only accept [letters;numbers;underscore]!</span>";
        } else {
            $stmt = $connect->prepare("SELECT username FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error_messages = "<span>!ERROR: data_(name) is already taken!</span>";
            }
            $stmt->close();
        }

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (empty($password)) {
            $error_message = "<span>!ERROR: data_(password) null!</span>";
        } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) && $password < 8) {
            $error_message = "<span>!ERROR: data_(password) <8 characters or missing special!</span>";
        } else {
            $hashedPassword = hashPasswordWithSalt($password, $salt);
        }

        if (empty($email)) {
            $error_message = "<span>!ERROR: data_(email) null!</span>";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "<span>!ERROR: data_(email) format invalid!</span>";
        } else {
            $stmt = $connect->prepare("SELECT email FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error_messages = "<span>!ERROR: data_(email) is already taken!</span>";
            }
            $stmt->close();
        }


        if (empty($error_message)) {
            $stmt = $connect->prepare("INSERT INTO `users` (`username`, `password`, `email`, `reg_time`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $hashedPassword, $email, $date);
            if ($stmt->execute()) {
                header('Location: terminal.php');
                exit;
            } else {
                $error_messages = "<span>ERROR!: An error occurred during registration!</span>";
            }
            $stmt->close();
        }
    }
}

Html::registerForm();