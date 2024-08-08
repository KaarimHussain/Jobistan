<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./Includes/db.php');
    include('./Classes/Community.php');
    $community = new Community($conn);
    $user_id = $_SESSION['logged']['id'];
    $post_id = $_POST['post_id'];
    $response;
    if ($community->deleteLike($user_id, $post_id)) {
        $response = [
            "status" => "success",
        ];
    } else {
        $response = [
            "status" => "error",
        ];
    }
    // add Header File for JSON Encoding
    header('Content-Type: application/json');
    return json_encode($response);
} else {
    header("Location: home.php");
    exit();
}
