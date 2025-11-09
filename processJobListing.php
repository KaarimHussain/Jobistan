<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'worker') {
    header("Location: companyHome.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createJobPostBtn'])) {
        include("./Includes/db.php");
        include("./Classes/Base.php");
        include("./Classes/advanceClass.php");
        $base = new Select($conn);
        $advanceClass = new advanceClass($conn);
        $required_candidate = $_POST['required_candidate'];
        $user_id = $_SESSION['logged']['id'];
        $title = $_POST['job-title'];
        $description = $_POST['job-description'];
        $requirement = $_POST['job-requirement'];
        $location = $_POST['location'];
        $jobType = $_POST['jobType'];
        $experience = $_POST['experience'];
        $salary = $_POST['salary'];
        $tags = $_POST['tags'];
        if ($base->insertDataIntoJobListing($user_id, $title, $description, $requirement, $location, $jobType, $experience, $salary, $tags, $required_candidate)) {
            if ($advanceClass->sendOKNotificationToUser($user_id, 'Job Post has been created successfully!')) {
                header("Location: companyProfile.php");
                exit();
            } else {
                $_SESSION['generalError'] = "Failed to send notification to User";
                header("Location: companyProfile.php");
                exit();
            }
        }
    } else {
        header("Location: companyProfile.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
