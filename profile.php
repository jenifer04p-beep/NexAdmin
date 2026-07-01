<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

require "config/database.php";

$user = $usersCollection->findOne([
    "username" => $_SESSION['username']
]);

if(!$user){
    $user = $usersCollection->findOne([
        "email" => $_SESSION['username']
    ]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NexAdmin | My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

</head>

<body>

<div class="container py-5">

<div class="card shadow-lg">

<div class="card-header d-flex justify-content-between align-items-center">

<h3 class="mb-0">

<i class="bi bi-person-circle"></i>

My Profile

</h3>

<div>

<a href="dashboard.php" class="btn btn-light">

<i class="bi bi-house-fill"></i>

Dashboard

</a>

</div>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4 text-center">

<div class="mb-3">

<i class="bi bi-person-circle text-primary" style="font-size:120px;"></i>

</div>

<h4>

<?= htmlspecialchars($user['name'] ?? 'User') ?>

</h4>

<?php if(($user['role'] ?? '')=="Admin"): ?>

<span class="badge bg-success fs-6">

Admin

</span>

<?php else: ?>

<span class="badge bg-primary fs-6">

User

</span>

<?php endif; ?>

</div>

<div class="col-md-8">

<table class="table table-hover">

<tr>

<th width="35%">

<i class="bi bi-person-fill"></i>

Full Name

</th>

<td>

<?= htmlspecialchars($user['name'] ?? '-') ?>

</td>

</tr>

<tr>

<th>

<i class="bi bi-person-badge-fill"></i>

Username

</th>

<td>

<?= htmlspecialchars($user['username'] ?? '-') ?>

</td>

</tr>

<tr>

<th>

<i class="bi bi-envelope-fill"></i>

Email

</th>

<td>

<?= htmlspecialchars($user['email'] ?? '-') ?>

</td>

</tr>

<tr>

<th>

<i class="bi bi-telephone-fill"></i>

Phone

</th>

<td>

<?= htmlspecialchars($user['phone'] ?? '-') ?>

</td>

</tr>

<tr>

<th>

<i class="bi bi-shield-check"></i>

Role

</th>

<td>

<?= htmlspecialchars($user['role'] ?? '-') ?>

</td>

</tr>

</table>

<div class="mt-4">

<a href="change_password.php" class="btn btn-warning dashboard-btn">

<i class="bi bi-key-fill"></i>

Change Password

</a>

<a href="dashboard.php" class="btn btn-secondary dashboard-btn">

<i class="bi bi-arrow-left-circle-fill"></i>

Back to Dashboard

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>