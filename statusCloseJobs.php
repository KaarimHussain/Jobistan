<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./Includes/db.php');
    include('./Classes/PostedJobs.php');
    $job_id = $_POST['job_id'];
    $postedJobs = new PostedJobs($conn);
    if ($postedJobs->changePostStatus($job_id)) {
        $_SESSION['changedJobStatus'] = "Posted Job Status has been changed to Closed";
        header("Location: companyViewPostedJobs.php");
        exit();
    } else {
        $_SESSION['changedJobStatus'] = "Failed to change Posted Job Status";
        header("Location: companyViewPostedJobs.php");
        exit();
    }

} else {
    header("Location: home.php");
    exit();
}