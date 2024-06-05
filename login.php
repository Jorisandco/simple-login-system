<?php
session_start();
$data2 = "<h1>login</h1>";

include_once 'classes/database.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $login = database::login($username, $password);

    if ($login) {
        var_dump($login);
        $_SESSION['username'] = $username;
        $_SESSION["session_id"] = session_id();
        header("Location: index.php");
    } else {
        $data2 = "<h1 style='color: red'>Invalid username and/or password</h1>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="setcenter">
            <div class="wrapper">
                <?=$data2?>
                <form id="registform" action="login.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <input type="submit" value="Login">
                </form>
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>
</body>

</html>