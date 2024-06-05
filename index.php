<?php
session_start();



if (!isset($_SESSION["session_id"]) && $_SESSION["session_id"] != session_id()) {
    header("Location: login.php");
} else {

    echo "hello $_SESSION[username] ";

    $data = null;

    if ($_SESSION['admin'] == 1) {
        echo "You are an admin";
        $data .= "<a href='admin.php'>Admin</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>helloworld</title>
</head>

<body>
    <a href="functiononly_pages/logout.php">Logout</a>

    <?= $data; ?>
</body>

</html>