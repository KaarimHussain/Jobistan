<?php
include("./Includes/sessionStart.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("./Classes/Base.php");
    $user_id = $_SESSION['logged']['id'];
    $base = new Select($conn);

    // Fix: Use the same logic for both visibility variables
    $user_account_visib = $_POST['visibilityAccount'] ?? "off";
    $user_resume_visib = $_POST['visibilityResume'] ?? "off";

    $accountVisibility = $base->getUserAccountVisibility($user_id);
    $resumeVisibility = $base->getUserResumeVisibility($user_id);

    // Fix: Simplify the logic for changing visibility
    $base->changeUserAccountVisibility($user_id, $user_account_visib == 'off');
    $base->changeUserResumeVisibility($user_id, $user_resume_visib == 'off');

    // Fix: Remove unnecessary echo statements
    // echo $_POST['visibilityAccount'] ?? "off";
    // echo $_POST['visibilityResume'] ?? "off";

    // Fix: Use a more secure redirect method
    http_response_code(302);
    header("Location: setting.php", true, 302);
    exit(); // Fix: Add exit() after redirect
} else {
    header("Location: home.php");
    exit();
}
