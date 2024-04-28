<?php
session_start();
include "dbConnect.php";
include "pwdHashSalt.php";
include "htmlFunctions.php";

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = hashPasswordWithSalt(trim($_POST["pwd"]), $salt);

    if (empty($email) || empty($password)) {
        $error_message = "<span>!ERROR: Input_(data) fields null!</span>";
    } else {
        $stmt = $connect->prepare("SELECT id, username, password, class_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $username, $registeredPassword, $class_id);
            $stmt->fetch();

            if ($password == $registeredPassword) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['class_id'] = $class_id;
                echo "<script>
                var shutdownAreaTerminal = document.querySelector('#shutdown-area-terminal');
                shutdownAreaTerminal.classList.add('shutdown');
                setTimeout(function () {
                    window.location.href = 'index.php';
                    }, 1250);
                </script>";
                exit;
            } else {
                $error_message = '<span>!ERROR: password_Input = INCORRECT;!</span>';
            }
        } else {
            $error_message = '<span>!ERROR: data_(user) not found!</span>';
        }
        $stmt->close();
    }
}

Html::loginForm();