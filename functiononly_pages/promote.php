<?php
include_once '../classes/database.php';

database::promoteacount($_GET['username']);

header("Location: ../admin.php");