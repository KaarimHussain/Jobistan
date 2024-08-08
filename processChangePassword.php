<?php
include ('./Includes/sessionStart.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Includes/db.php');
    include ('./Classes/mailing.php');
    $mailingClass = new Mailing($conn);
    $password = $_POST['password'];
    if ($mailingClass->updatePassword($password, $_SESSION['recovery_email'])) {
        unset($_SESSION['recovery_email']);
        $_SESSION['register_success'] = "Password has been changed. Try Logging in again.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['recover_error'] = "Failed to update password";
        header("Location: changePassword.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}