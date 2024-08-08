<?php

$dbname = "job_website"; // Database Name
$host = "localhost"; // Local Host
$user = "root"; // User
$pass = ""; // Password
$conn = new mysqli($host, $user, $pass, $dbname);
if (!$conn) {
    echo $conn->error;
    exit();
}
return $conn;
