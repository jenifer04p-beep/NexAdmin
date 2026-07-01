<?php

require 'config/database.php';

$usersCollection->deleteMany([
    'username' => 'admin'
]);

$password = password_hash("admin123", PASSWORD_DEFAULT);

$usersCollection->insertOne([
    'username' => 'admin',
    'password' => $password,
    'role' => 'Admin'
]);

echo "Admin Reset Successfully!";