<?php

session_start();

require 'config/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$user = $usersCollection->findOne([
    'username' => $username
]);

if($user && password_verify($password, $user['password'])){

    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    header("Location: dashboard.php");

}else{

    echo "Invalid Username or Password";

}