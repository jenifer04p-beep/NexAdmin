<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require "../config/auth.php";

requireAdmin();

require "../config/database.php";
$id = $_GET['id'];

$usersCollection->deleteOne([
    '_id' => new MongoDB\BSON\ObjectId($id)
]);

header("Location: list_users.php");
exit();