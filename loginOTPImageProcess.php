<?php
include("./Includes/sessionStart.php");
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Including required files
    include('./Includes/db.php');
    include('./Classes/mailing.php');
    include('./Classes/Base.php');
    // Defining Classes
    $base = new Select($conn);
    $mail = new Mailing($conn);
    // Defining Variables
    $tempOTP = $_POST['tempOTP'];
    $recover_otp = $_POST['recover_otp'];
    // Work for matching the OTP
    if ($mail->matchOTP($tempOTP, $recover_otp)) {
        if ($row = $base->SelectUserWithID($_SESSION['temp_user_id'])) {
            // Setting the Session and Redirecting user to the home page
            $_SESSION['logged'] = array(
                'id' => $row['id'],
                'username' => $row['username'],
                'email' => $row['email'],
                'role' => $row['role'],
            );
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['recover_error'] = "Failed to Select User Credentials";
            header("Location: loginProcessImage.php");
            exit();
        }
    } else {
        $_SESSION['otp_error'] = "Invalid OTP";
        header("Location: loginOtpImage.php");
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
