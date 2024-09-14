<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_GET['user_id'])) {
    header("Location: companyHome.php");
    exit();
}
if (!isset($_GET['job_id'])) {
    header("Location: companyHome.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'recruiter') {
    include("./Includes/db.php");
    include("./Classes/advanceClass.php");
    include("./Classes/PostedJobs.php");
    $postedJobs = new PostedJobs($conn);
    $advanceClass = new advanceClass($conn);
    $user_id = $_GET['user_id'];
    $job_id = $_GET['job_id'];
    if ($postedJobs->deleteFromInterviewTable($job_id, $user_id)) {
        $advanceClass->sendOKNotificationToUser($_SESSION['logged']['id'], 'Selected User has been deleted Successfully');
        header("Location: viewUserSelectedTable.php");
        exit();
    } else {
        $advanceClass->sendNotOKNotificationToUser($_SESSION['logged']['id'], 'Failed to Delete Selected User');
        header("Location: companyViewPostedJobs.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}