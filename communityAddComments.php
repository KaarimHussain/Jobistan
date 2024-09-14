<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./Classes/Community.php');
    include('./Includes/db.php');

    $post_id = $_POST['post_id'];
    $comment_text = $_POST['comment_text'];
    $user_id = $_SESSION['logged']['id'];

    $communityData = new Community($conn);
    $response = [];

    if ($communityData->InsertIntoCommunityComments($post_id, $user_id, $comment_text)) {
        $response = [
            "status" => "success",
            "message" => "Comment Added Successfully"
        ];
    } else {
        $response = [
            "status" => "error",
            "message" => "Failed to Add Comment"
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    header("Location: home.php");
    exit();
}
