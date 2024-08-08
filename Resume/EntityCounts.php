<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$counts = [];

$tables = ['users', 'job_listings', 'applications', 'analytics', 'resume_templates', 'interview_schedules', 'job_alerts', 'feedback', 'messages'];
foreach ($tables as $table) {
    $sql = "SELECT COUNT(*) AS count FROM $table";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $counts[$table] = $row['count'];
}

echo json_encode($counts);
$conn->close();
?>
