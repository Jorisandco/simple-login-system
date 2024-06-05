<?php
include_once 'classes/database.php';

//$database = database::connect();
if (isset($_POST["username"]) && isset($_POST["password"])) {
    if ($_POST["password"] != $_POST["password_repeat"]) {
        echo "Passwords do not match";
        die();
    }
    $username = HTMLSPECIALCHARS($_POST['username']);
    $password = ($_POST['password']);

    database::adduser($username, $password);

    echo database::$error;
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="setcenter">
        <div class="wrapper">
            <form id="registform" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <label for="password">Confirm Password</label>
                <input type="password" name="password_repeat" id="password_repeat" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>

</html>