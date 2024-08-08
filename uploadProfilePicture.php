<?php
include('./Includes/sessionStart.php');

if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./Classes/advanceClass.php');
    include('./Classes/Base.php');
    include('./Includes/db.php');

    $user_id = $_SESSION['logged']['id'];
    $advanceClass = new advanceClass($conn);
    $baseClass = new Select($conn);

    if (isset($_FILES['profilePicture'])) {
        $user_picture = $_FILES['profilePicture'];
        $filePath = "UserUploads/";

        if ($user_info = $advanceClass->selectUserBasicInfo($user_id)) {
            $targetFilePath = $filePath . basename($_FILES['profilePicture']['name']);
            $escaped_string_picture = $conn->real_escape_string($targetFilePath);

            if (file_exists($user_info['company_logo'])) {
                if (unlink($user_info['company_logo']) && move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFilePath) && $advanceClass->updateUserProfilePicture($user_id, $escaped_string_picture)) {
                    $advanceClass->sendOKNotificationToUser($user_id, 'Your Company Logo has been updated successfully');
                    $_SESSION['generalSuccess'] = "Profile Picture Updated Successfully";
                } else {
                    $advanceClass->sendNotOKNotificationToUser($user_id, 'Failed to update your Company Logo');
                    $_SESSION['generalError'] = "Failed to Update Profile Picture!";
                }
            } else {
                if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFilePath) && $advanceClass->updateUserProfilePicture($user_id, $escaped_string_picture)) {
                    $advanceClass->sendOKNotificationToUser($user_id, 'Your Company Logo has been updated successfully');
                    $_SESSION['generalSuccess'] = "Profile Picture Updated Successfully";
                } else {
                    $advanceClass->sendNotOKNotificationToUser($user_id, 'Failed to update your Company Logo');

                    $_SESSION['generalError'] = "Failed to Update Profile Picture!";
                }
            }

            header("Location: profile.php");
            exit();
        } else {
            $_SESSION['generalError'] = "Failed to Get User Basic Info";
            header("Location: profile.php");
            exit();
        }
    } else {
        $_SESSION['generalError'] = "No Profile Picture Uploaded";
        header("Location: profile.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
