<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("./Includes/db.php");
    include("./Classes/advanceClass.php");
    $advanceClass = new advanceClass($conn);
    $job_id = $_POST['job_id'];
    $user_id = $_SESSION['logged']['id'];
    $sql = "INSERT INTO savedpost (job_listing_id, user_id) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $job_id, $user_id);
    if ($stmt->execute()) {
        try {
            $advanceClass->sendOKNotificationToUser($user_id, 'Successfully saved job post');
            header("Location: viewPostDetails.php?job_id=$job_id");
        } catch (Exception $e) {
            return;
        }
        $stmt->close();
        $conn->close();
        exit();
    } else {
        $advanceClass->sendNotOKNotificationToUser($user_id, 'Failed to save job post');
        header("Location: viewPostDetails.php?job_id=$job_id");
        $stmt->close();
        $conn->close();
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}
