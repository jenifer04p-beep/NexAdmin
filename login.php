<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NexAdmin | Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

<style>

body{

    font-family:'Poppins',sans-serif;

    background:linear-gradient(135deg,#2563eb,#3b82f6,#60a5fa);

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

}

.login-card{

    width:420px;

    border:none;

    border-radius:20px;

    background:rgba(255,255,255,.95);

    backdrop-filter:blur(10px);

    box-shadow:0 20px 45px rgba(0,0,0,.2);

    animation:fadeIn .8s;

}

.logo{

    font-size:60px;

}

.form-control{

    height:50px;

    border-radius:12px;

}

.btn-login{

    width:100%;

    height:50px;

    border-radius:12px;

    font-weight:600;

    font-size:18px;

}

@keyframes fadeIn{

from{

opacity:0;

transform:translateY(30px);

}

to{

opacity:1;

transform:translateY(0);

}

}

.footer-text{

    color:#6c757d;

    font-size:14px;

}

</style>

</head>

<body>

<div class="login-card p-4">

<div class="text-center">

<div class="logo">

🛡️

</div>

<h2 class="fw-bold text-primary">

NexAdmin

</h2>

<p class="text-muted">

Smart User Management System

</p>

</div>

<form action="login_process.php" method="POST">

<div class="mb-3">

<label class="form-label">

<i class="bi bi-person-fill"></i>

Username

</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Enter Username"
required>

</div>

<div class="mb-4">

<label class="form-label">

<i class="bi bi-lock-fill"></i>

Password

</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required>

</div>

<button
type="submit"
class="btn btn-primary btn-login">

<i class="bi bi-box-arrow-in-right"></i>

Login

</button>

</form>

<hr>

<div class="text-center footer-text">

© <?php echo date("Y"); ?>

<strong>NexAdmin</strong>

<br>

Secure User Management Portal

</div>

</div>

</body>

</html>