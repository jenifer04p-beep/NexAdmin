<?php

echo "<h2>Step 1 - Autoload file exists</h2>";
var_dump(file_exists(__DIR__ . "/vendor/autoload.php"));

echo "<hr>";

require_once __DIR__ . "/vendor/autoload.php";

echo "<h2>Step 2 - MongoDB extension loaded</h2>";
var_dump(extension_loaded("mongodb"));

echo "<hr>";

echo "<h2>Step 3 - MongoDB Client class exists</h2>";
var_dump(class_exists("MongoDB\\Client"));