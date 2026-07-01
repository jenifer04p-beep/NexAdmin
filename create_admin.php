<?php

require 'config/database.php';

$existingAdmin = $usersCollection->findOne([
    'username' => 'admin'
]);

if ($existingAdmin) {
    exit("Admin already exists.");
}

$password = password_hash("admin123", PASSWORD_DEFAULT);

$usersCollection->insertOne([
    'username' => 'admin',
    'password' => $password,
    'role' => 'Admin'
]);

echo "Admin Created Successfully";