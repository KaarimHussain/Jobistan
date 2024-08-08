<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./Classes/resumes.php');
    include('./Includes/db.php');
    $none_builders_resume = $_FILES['none_builders_resume'];
    $job_title = $_POST['job_title'];
    $exact_experience = $_POST['exact_experience'];
    $user_id = $_SESSION['logged']['id'];
    $resumeTable = new HandleResume($conn);
    if ($resumeTable->handleExternalResume($user_id, $job_title, $exact_experience, $none_builders_resume)) {
        header("Location: setting.php");
        exit();
    } else {
        header("Location: setting.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}
