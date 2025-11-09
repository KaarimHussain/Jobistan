<?php
// processForgetPass.php
include ('./Includes/sessionStart.php');

if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_POST['generalforgetPassBtn'])) {
    header('Location: setting.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Classes/mailing.php');
    include ('./Includes/db.php');
    include ('./Classes/selection.php');
    $mainClass = new Mailing($conn);

    // Fetching all the Data that is coming from forgetPassword.php page
    $recovery_email = $_POST['recovery_email'];
    if ($mainClass->sendMailOTP($recovery_email) == true) {
        $_SESSION['recovery_email'] = $recovery_email;
        header("Location: insertOTP.php");
        exit();
    } else {
        header("Location: generalforgetpass.php");
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}