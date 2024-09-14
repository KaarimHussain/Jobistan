<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['logged']['id'];
    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];
    $work_description = $_POST['work_description'];
    $company_start_date = $_POST['company_start_date'];
    $company_end_date = $_POST['company_end_date'] ?? null;
    include ('./Classes/advanceClass.php');
    include ('./Includes/db.php');
    $advanceClass = new advanceClass($conn);
    if ($advanceClass->insertExperience($user_id, $job_title, $company_name, $work_description, $company_start_date, $company_end_date)) {
        $_SESSION['generalSuccess'] = "Successfully added the Experience";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['generalError'] = "Failed to add the Experience";
        header("Location: profile.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}