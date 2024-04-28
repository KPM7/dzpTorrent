<?php
session_start();

try {
    include_once "dbConnect.php";
    include_once "pwdHashSalt.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $current_password = trim($_POST["current_password"]);
        $new_password = trim($_POST["new_password"]);
        $confirm_password = trim($_POST["confirm_password"]);

        $username = $_SESSION['username'];
        $sql_check_password = "SELECT password FROM users WHERE username = '$username'";
        $result_check_password = $connect->query($sql_check_password);

        if ($result_check_password->num_rows == 1) {
            $row = $result_check_password->fetch_assoc();
            $stored_password = $row['password'];

            if (hashPasswordWithSalt($current_password, $salt) === $stored_password) {
                if (!empty($new_password) && !empty($confirm_password) && $new_password === $confirm_password) {
                    $uppercase = preg_match('@[A-Z]@', $new_password);
                    $lowercase = preg_match('@[a-z]@', $new_password);
                    $number = preg_match('@[0-9]@', $new_password);
                    $specialChars = preg_match('@[^\w]@', $new_password);

                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8) {
                        $_SESSION['update_error'] = "The new password is not strong enough. It must be at least 8 characters long and include lowercase and uppercase letters, numbers, and special characters.";
                        header("Location: profile.php");
                        exit;
                    }

                    $hashed_new_password = hashPasswordWithSalt($new_password, $salt);

                    $sql_update_password = "UPDATE users SET password = '$hashed_new_password' WHERE username = '$username'";
                    if ($connect->query($sql_update_password) === TRUE) {
                        $_SESSION['update_success'] = "Password updated successfully.";
                        header("Location: profile.php");
                        exit;
                    } else {
                        $_SESSION['update_error'] = "Failed to update password.";
                        header("Location: profile.php");
                        exit;
                    }
                } else {
                    $_SESSION['update_error'] = "New password and confirm password do not match.";
                    header("Location: profile.php");
                    exit;
                }
            } else {
                $_SESSION['update_error'] = "Wrong current password.";
                header("Location: profile.php");
                exit;
            }
        } else {
            $_SESSION['update_error'] = "Failed to check current password.";
            header("Location: profile.php");
            exit;
        }
    }
} catch (Exception $error) {
    $_SESSION['update_error'] = "Something went wrong: " . $error->getMessage();
    header("Location: profile.php");
    exit;
}
