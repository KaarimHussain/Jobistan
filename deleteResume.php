<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'recruiter') {
    header("Location: companyHome.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['logged']['id'];
    include ('./Includes/db.php');
    include ('./Classes/advanceClass.php');
    $advanceClass = new advanceClass($conn);
    if ($advanceClass->deleteUserResumeFile($user_id)) {
        $_SESSION['generalSuccess'] = "Resume File Deleted Successfully";
        header("Location: setting.php");
        exit();
    } else {
        $_SESSION['generalError'] = "Failed to Delete Resume File";
        header("Location: setting.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}