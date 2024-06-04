<?php
session_start();
include_once '../classes/database.php';

database::deleteacount($_GET['username']);
if ($_SESSION["admin"] == 1) {
    header("Location: ../admin.php");
} else {
    header("Location: ../index.php");
}