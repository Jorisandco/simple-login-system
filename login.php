<?php
session_start();

include_once 'classes/database.php';

if(isset($_POST["username"]) && isset($_POST["password"])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $login = database::login($username, $password);

    if ($login){
        var_dump($login);
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Login failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <div class="container">
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Login">
        </form>
    </div>
    <a href="register.php">Register</a>
</body>

</html>