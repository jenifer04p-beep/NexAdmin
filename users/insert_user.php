<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require "../config/auth.php";

requireAdmin();

require "../config/database.php";
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

// Check if email already exists
$existingUser = $usersCollection->findOne([
    "email" => $email
]);

if ($existingUser) {
    echo "<script>
            alert('Email already exists!');
            window.location='add_user.php';
          </script>";
    exit();
}

$usersCollection->insertOne([
    "name" => $name,
    "email" => $email,
    "phone" => $phone,
    "password" => $password,
    "role" => $role,
    "created_at" => new MongoDB\BSON\UTCDateTime()
]);

echo "<script>
        alert('User Added Successfully!');
        window.location='list_users.php';
      </script>";