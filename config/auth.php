<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

function requireAdmin()
{
    if ($_SESSION['role'] !== "Admin") {
        die("<h3>Access Denied! Admin Only.</h3>");
    }
}