<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Includes/db.php');
    include ('./Classes/Startup.php');
    $startup = new Startup($conn);
    $user_id = $_SESSION['logged']['id'];
    $user_main_profession = $_POST['user_main_profession'];
    $user_description = $_POST['user_description'];
    $user_interest = $_POST['user_interest'];
    $user_hobbies = $_POST['user_hobbies'];
    if ($startup->insertIntoAdditionalInfo($user_id, $user_description, $user_interest, $user_hobbies, $user_main_profession)) {
        header("Location: home.php");
        exit();
    } else {
        $_SESSION['generalError'] = "Failed to update Additional Information";
        header("Location: setting.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}