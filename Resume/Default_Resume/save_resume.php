<?php
include('../../Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: ../../index.php");
    exit();
}

include('../../Includes/db.php');
$currentuser = $_SESSION['logged']['id'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO resumes (user_id,full_name, job_title, email, phone, linkedin, summary, education, skills, experience, job_title_experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssssss", $currentuser, $full_name, $job_title, $email, $phone, $linkedin, $summary, $education, $skills, $experience, $job_title_experience);
$job_title_experience = $_POST['exact_experience'];
$full_name = $_POST['full_name'];
$job_title = $_POST['job_title'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$linkedin = $_POST['linkedin'];
$summary = $_POST['summary'];
$education = $_POST['education'];
$skills = $_POST['skills'];
$experience = '';
foreach ($_POST['job_title'] as $index => $job_title) {
    $company_name = $_POST['company_name'][$index];
    $job_duration = $_POST['job_duration'][$index];
    $job_description = $_POST['job_description'][$index];

    $experience .= $job_title . " at " . $company_name . " (" . $job_duration . "): " . $job_description . "\n";
}

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: template3.php?full_name=" . urlencode($full_name) .
    "&job_title=" . urlencode($job_title) .
    "&email=" . urlencode($email) .
    "&phone=" . urlencode($phone) .
    "&linkedin=" . urlencode($linkedin) .
    "&summary=" . urlencode($summary) .
    "&education=" . urlencode($education) .
    "&skills=" . urlencode($skills) .
    "&experience=" . urlencode($experience));

exit();
