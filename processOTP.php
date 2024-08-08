<?php
include('./Includes/sessionStart.php');
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("./Includes/db.php");
    include('./Classes/mailing.php');
    $recoverOTP = $_POST['recover_otp'];
    // Cast both to strings for a reliable comparison
    if ((string) $recoverOTP === (string) $_SESSION['temp_otp']) {
        $OTPClass = new Mailing($conn);
        $OTPClass->updateOTP($recoverOTP);
        header("Location: changePassword.php");
        exit();
    } else {
        $_SESSION['recover_error'] = "Invalid OTP";
        header("Location: forgetPassword.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
