<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Includes/db.php');
    include ('./Classes/Chatting.php');
    $chattingData = new Chatting($conn);
    $message = $chattingData->encryptMessage($_POST['message']);
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $SQL = "INSERT INTO messages(sender_id,receiver_id,messages,created_at) VALUES(?,?,?,NOW())";
    $stmt = $conn->prepare($SQL);
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
} else {
    header("Location: home.php");
    exit();
}