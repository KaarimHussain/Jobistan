<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("HTTP/1.1 405 now Logged In");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include ('./Includes/db.php');
    include ('./Classes/Chatting.php');
    header('Content-Type: application/json');
    $message = $_POST['message'];
    $receiver_id = $_POST['receiver_id'];
    $sender_id = $_SESSION['logged']['id'];
    $chat = new Chatting($conn);
    if ($chat->insertIntoInboxMessage($message, $receiver_id, $sender_id)) {
        echo json_encode(array('status' => 'success', 'message' => 'Successfully Insert Message'));
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to insert message']);
        exit();
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    exit();
}
// set the header for the response that will return from this page will be in json