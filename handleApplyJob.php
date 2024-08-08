<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_POST['handleApplyJobsBtn'])) {
    header('Location: home.php');
    exit();
}
include ('./Includes/db.php');
include ('./Classes/Base.php');
include ('./Classes/advanceClass.php');
$base = new Select($conn);
$advanceClass = new advanceClass($conn);
$USER_ID = $_SESSION['logged']['id'];
$JOB_ID = $_POST['job_id'];
$COMPANY_ID = $_POST['company_id'];

if ($base->handleCompaniesAppliedJobs($USER_ID, $JOB_ID, $COMPANY_ID) && $base->insertIntoAppliedJobs($USER_ID, $JOB_ID)) {
    $advanceClass->sendOKNotificationToUser($USER_ID, 'Successfully Applied to the Job');
    header("Location: home.php");
    exit();
} else {
    $advanceClass->sendNotOKNotificationToUser($USER_ID, 'Failed to Apply to the Job');
    header("Location: home.php");
    exit();
}

