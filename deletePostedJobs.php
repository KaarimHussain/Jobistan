<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] != 'recruiter') {
    header("Location: home.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $job_id = $_GET['job_id'];
    include ('./Includes/sessionStart.php');
    include ('./Classes/PostedJobs.php');
    include ('./Classes/advanceClass.php');
    $postedJobs = new PostedJobs($conn);
    $advanceClass = new advanceClass($conn);
    if ($postedJobs->deletePostedJob($job_id)) {
        $advanceClass->sendOKNotificationToUser($_SESSION['logged']['id'], 'Your Job Post has been deleted Successfully');
        header("Location: companyViewPostedJobs.php");
        exit();
    } else {
        $advanceClass->sendNotOKNotificationToUser($_SESSION['logged']['id'], 'Failed to delete your Job Post');
        header("Location: companyViewPostedJobs.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}