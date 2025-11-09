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

// $dbname = "sql12758059"; // Database Name
// $host = "sql12.freesqldatabase.com"; // Local Host
// $user = "sql12758059"; // User
// $pass = "weDXKKjmZs"; // Password
// $port = 3306;
// $conn = new mysqli($host, $user, $pass, $dbname, $port);
// if (!$conn) {
//     echo $conn->error;
//     exit();
// }
// return $conn;
