<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include ("./Includes/db.php");
    include ("./Includes/sessionStart.php");
    include ("./Classes/mailing.php");
    $mailClass = new Mailing($conn);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    if ($mailClass->sendMailToAdmin($username, $email, $subject, $message)) {
        if ($mailClass->sendMailToSender($username, $email, $subject)) {
            $_SESSION['contact_approve'] = "The Mail sended Successfully";
            header("Location: ContactUs.php");
            exit();
        } else {
            header("Location: ContactUs.php");
            exit();
        }
    } else {
        header("Location: ContactUs.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
