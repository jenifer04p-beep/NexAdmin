<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

require "config/database.php";

$message = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $user = $usersCollection->findOne([
        "username" => $_SESSION['username']
    ]);

    if(!$user){
        die("User not found.");
    }

    if(!password_verify($currentPassword,$user['password'])){

        $message = '<div class="alert alert-danger">
        <i class="bi bi-x-circle-fill"></i>
        Current password is incorrect.
        </div>';

    }
    elseif($newPassword != $confirmPassword){

        $message = '<div class="alert alert-warning">
        <i class="bi bi-exclamation-circle-fill"></i>
        New passwords do not match.
        </div>';

    }
    else{

        $usersCollection->updateOne(
            ["_id"=>$user["_id"]],
            [
                '$set'=>[
                    "password"=>password_hash($newPassword,PASSWORD_DEFAULT)
                ]
            ]
        );

        $message = '<div class="alert alert-success">
        <i class="bi bi-check-circle-fill"></i>
        Password changed successfully.
        </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NexAdmin | Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

</head>

<body>

<div class="container py-5">

<div class="card shadow-lg">

<div class="card-header d-flex justify-content-between align-items-center">

<h3 class="mb-0">

<i class="bi bi-key-fill"></i>

Change Password

</h3>

<div>

<a href="dashboard.php" class="btn btn-light">

<i class="bi bi-house-fill"></i>

Dashboard

</a>

<a href="profile.php" class="btn btn-info">

<i class="bi bi-person-circle"></i>

Profile

</a>

</div>

</div>

<div class="card-body">

<?= $message ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

<i class="bi bi-lock-fill"></i>

Current Password

</label>

<div class="input-group">

<input
type="password"
class="form-control"
name="current_password"
id="currentPassword"
required>

<button
type="button"
class="btn btn-outline-secondary"
onclick="togglePassword('currentPassword',this)">

<i class="bi bi-eye-fill"></i>

</button>

</div>

</div>

<div class="mb-3">

<label class="form-label">

<i class="bi bi-shield-lock-fill"></i>

New Password

</label>

<div class="input-group">

<input
type="password"
class="form-control"
name="new_password"
id="newPassword"
required>

<button
type="button"
class="btn btn-outline-secondary"
onclick="togglePassword('newPassword',this)">

<i class="bi bi-eye-fill"></i>

</button>

</div>

</div>

<div class="mb-4">

<label class="form-label">

<i class="bi bi-check-circle-fill"></i>

Confirm Password

</label>

<div class="input-group">

<input
type="password"
class="form-control"
name="confirm_password"
id="confirmPassword"
required>

<button
type="button"
class="btn btn-outline-secondary"
onclick="togglePassword('confirmPassword',this)">

<i class="bi bi-eye-fill"></i>

</button>

</div>

</div>

<div class="text-center">

<button
type="submit"
class="btn btn-warning dashboard-btn">

<i class="bi bi-key-fill"></i>

Update Password

</button>

<button
type="reset"
class="btn btn-secondary dashboard-btn">

<i class="bi bi-arrow-clockwise"></i>

Reset

</button>

<a
href="dashboard.php"
class="btn btn-primary dashboard-btn">

<i class="bi bi-arrow-left-circle-fill"></i>

Back

</a>

</div>

</form>

</div>

</div>

</div>

<script>

function togglePassword(id,button){

const input=document.getElementById(id);

const icon=button.querySelector("i");

if(input.type==="password"){

input.type="text";

icon.classList.remove("bi-eye-fill");

icon.classList.add("bi-eye-slash-fill");

}else{

input.type="password";

icon.classList.remove("bi-eye-slash-fill");

icon.classList.add("bi-eye-fill");

}

}

</script>

</body>

</html>