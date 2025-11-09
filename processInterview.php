<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
if ($_SESSION['logged']['role'] != 'recruiter') {
    header('Location: home.php');
    exit();
}
if (!isset($_POST['sendInterviewRequestBtn'])) {
    header('Location: home.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./Includes/db.php');
    include('./Classes/mailing.php');
    include('./Classes/PostedJobs.php');
    include('./Classes/advanceClass.php');
    $postedJobs = new PostedJobs($conn);
    $mail = new Mailing($conn);
    $advanceClass = new advanceClass($conn);
    $user_id = $_POST['user_id'];
    $job_id = $_POST['job_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $job_title = $_POST['job_title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    if ($postedJobs->insertIntoInterviewedTable($user_id, $job_id, $username, $email, $job_title, $description, $date, $time) && $mail->sendMailToSenderForInterviewSchedule($username, $email, $_SESSION['logged']['email'], $_SESSION['logged']['username'], $job_title, $description, $date, $time)) {
        $advanceClass->sendOKNotificationToUser($_SESSION['logged']['id'], 'The Interview has been Scheduled');
        header("Location: viewUserAppliedTable.php?job_id=$job_id");
        exit();
    } else {
        $advanceClass->sendNotOKNotificationToUser($_SESSION['logged']['id'], 'The Interview was failed to Scheduled');
        header("Location: viewUserAppliedTable.php?job_id=$job_id");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
