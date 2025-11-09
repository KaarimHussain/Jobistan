<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Classes/advanceClass.php');
    $user_id = $_SESSION['logged']['id'];
    $advanceClass = new advanceClass($conn);
    if ($advanceClass->changeNotificationRead($user_id)) {
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['generalError'] = "Failed to Mark the Notification as Read";
        header("Location: setting.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}