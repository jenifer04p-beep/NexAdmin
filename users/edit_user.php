<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require "../config/auth.php";

requireAdmin();

require "../config/database.php";
$id=$_GET['id'];

$user=$usersCollection->findOne([
    '_id'=>new MongoDB\BSON\ObjectId($id)
]);

?>

<!DOCTYPE html>

<html>

<head>

<title>Edit User</title>
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit User</h3>

</div>

<div class="card-body">

<form action="update_user.php" method="POST">

<input type="hidden"
name="id"
value="<?= $user['_id'] ?>">

<div class="mb-3">

<label>Name</label>

<input
type="text"
class="form-control"
name="name"
value="<?= htmlspecialchars($user['name'] ?? '') ?>">

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
class="form-control"
name="email"
value="<?= htmlspecialchars($user['email'] ?? '') ?>">

</div>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
class="form-control"
name="phone"
value="<?= htmlspecialchars($user['phone'] ?? '') ?>">

</div>

<div class="mb-3">

<label>Role</label>

<select
name="role"
class="form-select">

<option <?= (($user['role'] ?? '')=="User")?"selected":"" ?>>
User
</option>

<option <?= (($user['role'] ?? '')=="Admin")?"selected":"" ?>>
Admin
</option>

</select>

</div>

<button class="btn btn-warning">

Update User

</button>

<a href="list_users.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>

</html>