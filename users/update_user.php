<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require "../config/auth.php";

requireAdmin();

require "../config/database.php";
$id = $_POST['id'];

$existingUser = $usersCollection->findOne([
    "email" => trim($_POST['email']),
    "_id" => [
        '$ne' => new MongoDB\BSON\ObjectId($id)
    ]
]);

if ($existingUser) {
    echo "<script>
            alert('Email already exists!');
            history.back();
          </script>";
    exit();
}

$usersCollection->updateOne(
    [
        "_id" => new MongoDB\BSON\ObjectId($id)
    ],
    [
        '$set' => [
            "name" => trim($_POST['name']),
            "email" => trim($_POST['email']),
            "phone" => trim($_POST['phone']),
            "role" => $_POST['role']
        ]
    ]
);

echo "<script>
        alert('User Updated Successfully!');
        window.location='list_users.php';
      </script>";