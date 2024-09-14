<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['logged']['id'];
    include ('./Classes/advanceClass.php');
    include ('./Includes/db.php');
    $advanceClass = new advanceClass($conn);
    if ($advanceClass->deleteExperience($user_id)) {
        $_SESSION['generalSuccess'] = "Successfully Deleted the Experience";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['generalError'] = "Failed to Delete the Experience";
        header("Location: profile.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}