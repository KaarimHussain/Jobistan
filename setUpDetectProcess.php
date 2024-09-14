<?php
include ('./Includes/sessionStart.php');
if (isset($_SESSION['logged']) && $_SESSION['logged']['role'] == 'worker') {
    include ('./Includes/db.php');
    include ('./Classes/ImageDetection.php');
    include ('./Classes/advanceClass.php');
    $advanceClass = new advanceClass($conn);
    $imageClass = new ImageDetection($conn);
    $userID = $_SESSION['logged']['id'];
    $userUploads = $_FILES['imageDetection'];

    if (isset($userUploads['name']) && $userUploads['name'] != '') {
        if ($imageClass->insertIntoImageDetectTable($userID, $userUploads)) {
            // Handle the Image
            try {
                $advanceClass->sendOKNotificationToUser($userID, 'You Account Protection has been Enhanced!');
                $_SESSION['generalSuccess'] = "Your update was successful.";
                header("Location: setting.php");
                exit();
            } catch (Exception $e) {
                $_SESSION["generalError"] = $e->getMessage();
            }
        } else {
            // Handle the Error
            echo "Failed to insert the Image";
        }
    } else {

    }
} else {
    header("Location: index.php");
    exit();
}
