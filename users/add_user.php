<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require "../config/auth.php";

requireAdmin();

require "../config/database.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Add User</h2>

<form action="insert_user.php" method="POST">

<label>Name</label><br>
<input type="text" name="name"><br><br>

<label>Email</label><br>
<input type="email" name="email"><br><br>

<label>Phone</label><br>
<input type="text" name="phone"><br><br>

<label>Password</label><br>
<input type="password" name="password"><br><br>

<label>Role</label><br>
<select name="role">
    <option>User</option>
    <option>Admin</option>
</select>

<br><br>

<button type="submit">Save</button>

</form>

</body>
</html>