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

$acounts = database::getallacounts();
$acountdump = null;

if (isset($_GET['search'])) {
    $acounts = database::searchacounts($_GET['search']);
}
foreach ($acounts as $acount) {
    $acountdump .= "<p>$acount[username]</p>";
    $acountdump .= "<a href='functiononly_pages/delete.php?username=$acount[username]'>Delete</a> <br> <br>";
    if ($acount['admin'] == 0) {
        $acountdump .= "<a href='functiononly_pages/promote.php?username=$acount[username]'>Promote</a> <br> <br>";
    }
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

            <?= $acountdump; ?>
        </div>
    </div>
    <a href="functiononly_pages/logout.php">Logout admin(self)</a>
    <a href="index.php">leave admin pannel</a>
</body>

</html>