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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Includes/db.php');
    include ('./Classes/PostedJobs.php');
    include ('./Classes/advanceClass.php');
    $jobClass = new PostedJobs($conn);
    $advanceClass = new advanceClass($conn);
    $job_id = $_POST['job_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $requirement = $_POST['requirement'];
    $location = $_POST['location'];
    $job_type = $_POST['jobType'];
    $experience = $_POST['experience'];
    $salary = $_POST['salary_range'];
    $tags = $_POST['tags'];
    if ($jobClass->updatePostedJobs($job_id, $title, $description, $requirement, $location, $job_type, $experience, $salary, $tags)) {
        $advanceClass->sendOKNotificationToUser($_SESSION['logged']['id'], 'Your Job Updation was successful');
        header("Location: companySettings.php");
        exit();
    } else {
        $advanceClass->sendNotOKNotificationToUser($_SESSION['logged']['id'], 'Your Job Updation was Failed');
        header("Location: companySettings.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}