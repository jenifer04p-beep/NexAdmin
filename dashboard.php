<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require "config/database.php";

$totalUsers = $usersCollection->countDocuments();

$totalAdmins = $usersCollection->countDocuments([
    "role" => "Admin"
]);

$totalNormalUsers = $usersCollection->countDocuments([
    "role" => "User"
]);

$isAdmin = ($_SESSION['role'] === "Admin");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NexAdmin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-dark shadow">

<div class="container">

<a class="navbar-brand fw-bold fs-3" href="#">

🛡️ NexAdmin

</a>

<div class="d-flex align-items-center">

<div class="text-white me-4 text-end">

<div>

Welcome,

<strong><?= htmlspecialchars($_SESSION['username']) ?></strong>

(<?= htmlspecialchars($_SESSION['role']) ?>)

</div>

<small id="liveDateTime"></small>

</div>

<button class="btn btn-light btn-sm me-2" id="themeToggle">

🌙

</button>

<a href="logout.php" class="btn btn-danger btn-sm">

<i class="bi bi-box-arrow-right"></i>

Logout

</a>

</div>

</div>

</nav>

<!-- ================= DASHBOARD ================= -->

<div class="container mt-5">

<div class="row g-4">

<!-- Total Users -->

<div class="col-md-4">

<div class="card stat-card blue shadow-lg">

<div class="card-body text-center">

<i class="bi bi-people-fill display-4"></i>

<h1 class="mt-3">

<?= $totalUsers ?>

</h1>

<h5>Total Users</h5>

</div>

</div>

</div>

<!-- Admins -->

<div class="col-md-4">

<div class="card stat-card green shadow-lg">

<div class="card-body text-center">

<i class="bi bi-person-badge-fill display-4"></i>

<h1 class="mt-3">

<?= $totalAdmins ?>

</h1>

<h5>Admins</h5>

</div>

</div>

</div>

<!-- Users -->

<div class="col-md-4">

<div class="card stat-card red shadow-lg">

<div class="card-body text-center">

<i class="bi bi-person-fill display-4"></i>

<h1 class="mt-3">

<?= $totalNormalUsers ?>

</h1>

<h5>Users</h5>

</div>

</div>

</div>

</div>

<!-- ================= QUICK ACTIONS ================= -->

<div class="card shadow-lg rounded-4 mt-5">

<div class="card-header">

<h4>

<i class="bi bi-grid-fill"></i>

Quick Actions

</h4>

</div>

<div class="card-body text-center">

<?php if($isAdmin): ?>

<a href="users/add_user.php" class="btn btn-success dashboard-btn">

<i class="bi bi-person-plus-fill"></i>

Add User

</a>

<a href="users/list_users.php" class="btn btn-primary dashboard-btn">

<i class="bi bi-people-fill"></i>

Manage Users

</a>

<?php endif; ?>

<a href="profile.php" class="btn btn-info dashboard-btn">

<i class="bi bi-person-circle"></i>

My Profile

</a>

<a href="change_password.php" class="btn btn-warning dashboard-btn">

<i class="bi bi-key-fill"></i>

Change Password

</a>
</a>

</div>

</div>

<!-- ================= USER STATISTICS ================= -->

<div class="card shadow-lg rounded-4 mt-5">

    <div class="card-header">

        <h4>
            <i class="bi bi-bar-chart-fill"></i>
            User Statistics
        </h4>

    </div>

    <div class="card-body">

        <canvas id="userChart" height="100"></canvas>

    </div>

</div>

</div>

<!-- ================= FOOTER ================= -->

<footer class="mt-5 text-center text-secondary">

    <hr>

    <p>

        © <?= date("Y") ?>

        <strong>NexAdmin</strong>

        | Smart User Management System

    </p>

</footer>

<!-- ================= CHART ================= -->

<script>

const ctx = document.getElementById('userChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Total Users',

            'Admins',

            'Users'

        ],

        datasets: [{

            label: 'User Statistics',

            data: [

                <?= $totalUsers ?>,

                <?= $totalAdmins ?>,

                <?= $totalNormalUsers ?>

            ],

            backgroundColor: [

                '#2563eb',

                '#16a34a',

                '#dc2626'

            ],

            borderRadius: 12

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>

<!-- ================= DARK MODE ================= -->

<script>

const toggle = document.getElementById("themeToggle");

if(localStorage.getItem("theme") === "dark"){

    document.body.classList.add("dark-mode");

    toggle.innerHTML = "☀️";

}else{

    toggle.innerHTML = "🌙";

}

toggle.addEventListener("click",function(){

    document.body.classList.toggle("dark-mode");

    if(document.body.classList.contains("dark-mode")){

        localStorage.setItem("theme","dark");

        toggle.innerHTML="☀️";

    }else{

        localStorage.setItem("theme","light");

        toggle.innerHTML="🌙";

    }

});

</script>
<script>

function updateClock(){

const now=new Date();

const options={

weekday:'short',

year:'numeric',

month:'short',

day:'numeric'

};

const date=now.toLocaleDateString('en-IN',options);

const time=now.toLocaleTimeString();

document.getElementById("liveDateTime").innerHTML=date+" | "+time;

}

updateClock();

setInterval(updateClock,1000);

</script>
<div class="toast-container position-fixed bottom-0 end-0 p-3">

<div
id="liveToast"
class="toast text-bg-success border-0"
role="alert">

<div class="d-flex">

<div class="toast-body">

<i class="bi bi-check-circle-fill"></i>

Action completed successfully.

</div>

<button
type="button"
class="btn-close btn-close-white me-2 m-auto"
data-bs-dismiss="toast">

</button>

</div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

const toastLiveExample=document.getElementById('liveToast');

const toast=new bootstrap.Toast(toastLiveExample);

toast.show();

</script>
</body>

</html>