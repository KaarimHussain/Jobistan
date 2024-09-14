<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include('./Includes/db.php');
    include('./Classes/hireRequest.php');
    include('./Classes/Base.php');
    include('./Classes/mailing.php');
    include('./Classes/Community.php');
    $worker_id = $_POST['worker_id'];
    $emp_id = $_POST['emp_id'];
    $job_id = $_POST['job_id'];
    echo $worker_id . " Worker ID" . "<br>";
    echo $job_id . " Job ID" . "<br>";
    echo $emp_id . " Employee ID" . "<br>";
    $base = new Select($conn);
    $mail = new Mailing($conn);
    $community = new Community($conn);
    $emp_data = $base->selectCompanyForProfilesWithID($emp_id);
    $user_data = $base->SelectUserWithID($worker_id);
    $hire = new HireRequest($conn);
    $hiredPoster = "./Resources\JOBISTANLOGO\DALL·E 2024-08-23 16.41.25 - A visually appealing hiring poster with a frame around the text 'Hired! Congratulations'. The frame should be elegant, with a subtle yet celebratory d.png";
    $commnityPostContent = "WE ARE PLEASED TO ANNOUNCE THAT " . $emp_data['company_name'] . " HAS SUCCESSFULLY HIRED " . $user_data['username'] . " AFTER CLEARING THE INTERVIEW. WE ARE LOOKING FORWARD FOR MANY MORE";
    if (
        $hire->insertIntoHiredHistory($worker_id, $job_id, $emp_id)
        && $community->InsertIntoCommunityPost($emp_id, $commnityPostContent, $hiredPoster)
        && $mail->sendMailToAdmin($emp_data['company_name'], 'jobistan.karachi.pk@gmail.com', 'Successfully Hired', $commnityPostContent . " AT " . date("Y-m-d H:i:s")
            && $hire->changeRequiredCandidateCount($job_id))
    ) {
        header("Location: viewUserSelectedTable.php?job_id=$job_id");
        exit();
    } else {
        header("Location: viewUserSelectedTable.php?job_id=$job_id");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}
