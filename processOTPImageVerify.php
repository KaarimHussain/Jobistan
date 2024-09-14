<?php
include ('./Includes/sessionStart.php');
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ("./Includes/db.php");
    include ('./Classes/mailing.php');
    include ('./Classes/Base.php');
    $recoverOTP = $_POST['recover_otp'];
    $email = $_POST['email'];
    // Cast both to strings for a reliable comparison
    if ((string) $recoverOTP === (string) $_SESSION['temp_otp']) {
        $OTPClass = new Mailing($conn);
        $base = new Select($conn);
        $OTPClass->updateOTP($recoverOTP);
        $row = $base->SelectUserWithEmail($email);
        if (!empty($row)) {
            $_SESSION['logged'] = array(
                'id' => $row['id'],
                'username' => $row['username'],
                'email' => $row['email'],
                'role' => $row['role'],
            );
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['register_error'] = "Failed to fetch your account details. Please try again!";
            header("Location: loginthroughImage");
            exit();
        }
    } else {
        $_SESSION['recover_error'] = "Invalid OTP";
        header("Location: forgetPassword.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
