<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: welcome.php');
    exit;
}

include_once "htmlFunctions.php";
include_once "dbConnect.php";

$username = $_SESSION['username'];
$sql = "SELECT username, email, reg_time, avatar_path FROM users WHERE username = '$username'";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $email = $row["email"];
    $reg_time = $row["reg_time"];
    $avatar = $row["avatar_path"];
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/scanline.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/glitch.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <?php
    Html::header();
    ?>

    <div class="content">
        <h1>Profile:</h1>
        <?php
        if (isset($_SESSION['update_error'])) {
            echo '<span><h2>' . $_SESSION['update_error'] . '</h2></span>';
            unset($_SESSION['update_error']);
        } elseif (isset($_SESSION['update_success'])) {
            echo '<span><h2>' . $_SESSION['update_success'] . '</h2></span>';
            unset($_SESSION['update_success']);
        }
        ?>
        <div class="content-inside">
            <form action="update_avatar.php" method="post" enctype="multipart/form-data">
                <div class="avatar-div">
                    <label for="avatar">
                        <img class="avatar_kep" src="<?php echo $avatar; ?>" alt="User Avatar">
                        <p>Profile Picture (Click to change)</p>
                    </label>
                    <input type="file" id="avatar" name="avatar" style="display: none;" onchange="this.form.submit()">
                </div>
            </form>

            <h2>Data:</h2>
            <p>Username: <?php echo $username; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Registration Date: <?php echo $reg_time; ?></p>

            <h2>Change Email:</h2>
            <form action="update_email.php" method="post">
                <label for="email"><p>New E-mail:</p></label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>
                <input type="submit" value="Update Email">
            </form>

            <h2>Change Password:</h2>
            <form action="update_password.php" method="post">
                <label for="current_password"><p>Current Password:</p></label>
                <input type="password" id="current_password" name="current_password"><br><br>

                <label for="new_password"><p>New Password:</p></label>
                <input type="password" id="new_password" name="new_password"><br><br>

                <label for="confirm_password"><p>New Password again:</p></label>
                <input type="password" id="confirm_password" name="confirm_password"><br><br>

                <input type="submit" value="Update Password">
            </form>
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
