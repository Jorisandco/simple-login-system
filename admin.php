<?php
session_start();

include_once 'classes/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
} else {
    echo "Hello admin: $_SESSION[username]";
}

if (isset($_GET['search'])) {
    $acounts = database::searchacounts($_GET['search']);
} else {
    $acounts = database::getallacounts();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminpannel</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="setcenter">
        <div class="wrapperAD">

            <form type="get">
                <input type="text" name="search">
                <input type="submit" value="search">
                <a href="admin.php">clear search</a>
            </form>

            <?= $acounts; ?>
        </div>
    </div>
    <a href="functiononly_pages/logout.php">Logout admin(self)</a>
    <a href="index.php">leave admin pannel</a>
</body>

</html>