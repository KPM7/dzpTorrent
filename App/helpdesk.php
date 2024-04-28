<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/helpdesk.css">
    <title>Helpdesk</title>
</head>

<body>
    <canvas id="binary">
        <script src="js/helpdesk.js"></script>
    </canvas>
    <div id="helpdeskDiv">
        <br>
        <label for="">Email</label><br>
        <input type="email" name="" class="helpdeskInput" id="helpdeskEmail" maxlength="50"><br>
        <label for="">Topic</label><br>
        <input type="text" name="" class="helpdeskInput" id="topic" maxlength="100"><br>
        <label for="">Problem</label><br>
        <textarea name="" id="problem" cols="30" rows="10" placeholder="Write your problems here"></textarea><br>
        <input type="button" value="Send" id="helpdeskSubmit" onclick="sendContent()"><br>
        <a href="index.php">Back to the main page</a>
    </div>
</body>

</html>