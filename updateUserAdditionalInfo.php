<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['logged']['id'];
    if (isset($_POST['updateInfoBtn'])) {
        include ('./Classes/Base.php');
        include ('./Classes/advanceClass.php');
        include ('./Includes/db.php');
        $advance = new advanceClass($conn);
        $base = new Select($conn);
        $additionalInfoData = $base->getUserAdditionInfoByID($user_id);
        if (empty($additionalInfoData)) {
            $SQL = "INSERT INTO users_additional_info(user_id) VALUES (?)";
            $stmt = $conn->prepare($SQL);
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                $advance->sendOKNotificationToUser($user_id, 'Your Additional Information has been registered');
            } else {
                $advance->sendNotOKNotificationToUser($user_id, 'Failed to Registered Additional Information');
            }
        }
        if (!empty($_POST['main_profession'])) {
            $main_profession = $_POST['main_profession'];
            $base = new Select($conn);
            if ($base->updateMainProfession($user_id, $main_profession)) {
                $advance->sendOKNotificationToUser($user_id, 'Your Main Profession has been updated');
            } else {
                $advance->sendNotOKNotificationToUser($user_id, 'Failed to update your Main Professional Info');
            }
        }
        if (!empty($_POST['user_description'])) {
            $user_description = $_POST['user_description'];
            $base = new Select($conn);
            if ($base->updateDescription($user_id, $user_description)) {
                $advance->sendOKNotificationToUser($user_id, 'Your Description has been updated');
            } else {
                $advance->sendNotOKNotificationToUser($user_id, 'Failed to update your Description');
            }
        }
        if (!empty($_POST['hobbies'])) {
            $hobbies = $_POST['hobbies'];
            $base = new Select($conn);
            if ($base->updateHobby($user_id, $hobbies)) {
                $advance->sendOKNotificationToUser($user_id, 'Your Hobbies have been updated');
            } else {
                $advance->sendNotOKNotificationToUser($user_id, 'Failed to update your Hobbies');
            }
        }
        if (!empty($_POST['interest'])) {
            $interest = $_POST['interest'];
            $base = new Select($conn);
            if ($base->updateInterest($user_id, $interest)) {
                $advance->sendOKNotificationToUser($user_id, 'Your Interests have been updated');
            } else {
                $advance->sendNotOKNotificationToUser($user_id, 'Failed to update your Interests');
            }
        }
        header("Location: setting.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}