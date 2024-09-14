<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    $_SESSION['register_error'] = "You need to login or create an account first!";
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Classes/advanceClass.php');
    include ('./Classes/Base.php');
    $baseClass = new Select($conn);
    $generalClass = new advanceClass($conn);
    $user_id = $_SESSION['logged']['id'];

    // =================================================================
    // Updating Username
    if (!empty($_POST['username']) && isset($_POST['username'])) {
        $username = $_POST['username'];
        if ($generalClass->updateUserName($user_id, $username)) {
            if ($generalClass->sendOKNotificationToUser($user_id, 'Your username has been changed!')) {
                $_SESSION['logged']['username'] = $username;
                $_SESSION['generalNotifcationSuccess'] = "Notification has been sent successfully.";
                $_SESSION['generalSuccess'] = "Your update was successful.";
            } else {
                // Failed to send OK notification
                $_SESSION['generalNotifcationError'] = "Failed to Send Notfication";
                $_SESSION['generalSuccess'] = "Your Updation has been successfull";
            }
        } else {
            if ($generalClass->sendNotOKNotificationToUser($user_id, 'Failed to Update your username')) {
                // Failed to send Not OK notification
                $_SESSION['generalError'] = "Failed to Update the Username";
                $_SESSION['generalNotifcationSuccess'] = "Notification has been sent successfully.";
            } else {
                // Failed to send Not OK notification
                $_SESSION['generalError'] = "Failed to Update the Username";
                $_SESSION['generalNotifcationError'] = "Failed to Send Notfication";
            }
        }
    }
    // =================================================================
    // Updating Password
    if (!empty($_POST['current_password']) && isset($_POST['current_password']) && !empty($_POST['new_password']) && isset($_POST['new_password'])) {
        // Fetch user's current hashed password from the database
        $userPassword = $baseClass->SelectUserWithID($user_id);
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];

        // Verify if the entered current password matches the hashed password in the database
        if (password_verify($currentPassword, $userPassword['password'])) {
            // Update the password in the database
            if ($generalClass->updatePassword($user_id, $newPassword)) {
                // Password updated successfully
                if ($generalClass->sendOKNotificationToUser($user_id, 'Your Password has been changed!')) {
                    $_SESSION['generalNotifcationSuccess'] = "Notification has been sent successfully.";
                    $_SESSION['generalSuccess'] = "Your update was successful.";
                } else {
                    $_SESSION['generalNotifcationError'] = "Failed to Send Notification";
                    $_SESSION['generalSuccess'] = "Your update was successful.";
                }
            } else {
                // Failed to update password
                if ($generalClass->sendNotOKNotificationToUser($user_id, 'Failed to change your password!')) {
                    $_SESSION['generalError'] = "Failed to Update the Password";
                    $_SESSION['generalNotifcationSuccess'] = "Notification has been sent successfully.";
                } else {
                    $_SESSION['generalError'] = "Failed to Update the Password";
                    $_SESSION['generalNotifcationError'] = "Failed to Send Notification";
                }
            }
        } else {
            // Incorrect current password
            if ($generalClass->sendNotOKNotificationToUser($user_id, 'Your Password is invalid! Please try again')) {
                $_SESSION['generalError'] = "Your Password is invalid! Please try again";
                $_SESSION['generalNotifcationSuccess'] = "Notification has been sent successfully.";
            } else {
                $_SESSION['generalError'] = "Your Password is invalid! Please try again";
                $_SESSION['generalNotifcationError'] = "Failed to Send Notification";
            }
        }
    } else {
        // Do nothing for empty fields (though ideally, front-end validation should handle this)
        $_SESSION['generalError'] = "Please provide necessary information in the fields";
        if ($_SESSION['logged']['role'] == 'worker') {
            header("Location: setting.php");
            exit();
        } else if ($_SESSION['logged']['role'] == 'recruiter') {
            header("Location: companySettins.php");
            exit();
        }
    }
    // =================================================================
    if ($_SESSION['logged']['role'] == 'worker') {
        header("Location: setting.php");
        exit();
    } else if ($_SESSION['logged']['role'] == 'recruiter') {
        header("Location: companySettings.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
