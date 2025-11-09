<?php
include ('../../Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: ../../index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
    include ('../../Includes/db.php');
    $user_id = $_SESSION['logged']['id'];
    $stmt = $conn->prepare("SELECT * FROM workers_resume WHERE user_id = $user_id");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (file_exists('../.' . $row['resume_data'])) {
            unlink('../.' . $row['resume_data']);
            $stmt = $conn->prepare("DELETE FROM workers_resume WHERE user_id = $user_id");
            $stmt->execute();
        } else {
            // Do nothing, the file does not exist.
        }
    }
    $pdfFile = $_FILES['pdf'];
    // Define the directory where PDFs will be saved
    $uploadDir = '../../UserResume/';
    $uploadFile = $uploadDir . basename($pdfFile['name']);
    $uploadFileDB = './UserResume/' . basename($pdfFile['name']);
    // Ensure the directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    // Move the uploaded file to the directory
    if (move_uploaded_file($pdfFile['tmp_name'], $uploadFile)) {
        // Prepare SQL statement
        $stmt = $conn->prepare('INSERT INTO workers_resume (user_id ,resume_file) VALUES (?,?)');
        $stmt->bind_param('is', $user_id, $uploadFileDB);
        $stmt->execute();
        exit();
    } else {
        header("Location: ../../mainresume/CreateResume.php");
        exit();
    }
} else {
    header("Location: ../../mainresume/CreateResume.php");
    exit();
}
