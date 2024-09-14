<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addPostButton'])) {
    include("./Classes/Community.php");
    include('./Includes/db.php');
    $user_id = $_SESSION['logged']['id'];
    $community = new Community($conn);
    $uploadDir = "./CommunityPostImage/";

    // Initialize variables
    $imageFilePath = null;

    // Check if a file was uploaded
    if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size if needed
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $fileType = $_FILES['imageFile']['type'];

        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the desired directory
            $imageFileName = basename($_FILES['imageFile']['name']);
            $imageFilePath = $uploadDir . $imageFileName;

            if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $imageFilePath)) {
                // File upload was successful
            } else {
                // Handle file upload error
                $_SESSION['community_error'] = "Error uploading file.";
                exit();
            }
        } else {
            // Handle invalid file type
            $_SESSION['community_error'] = "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
            exit();
        }
    }

    // Handle post content
    $postContent = isset($_POST['postContent']) ? htmlspecialchars($_POST['postContent']) : '';

    // Insert into the community post (assuming the insert method is correctly implemented)
    if ($community->InsertIntoCommunityPost($user_id, $postContent, $imageFilePath)) {
        // Redirect or confirm successful insertion
        include('./Classes/advanceClass.php');
        $advanceClass = new advanceClass($conn);
        $advanceClass->sendOKNotificationToUser($user_id, 'Your Post was successfully Uploaded!');
        header("Location: community.php");
        exit();
    } else {
        // Handle insert error
        $_SESSION['community_error'] = "Error inserting post into database.";
        exit();
    }
} else {
    header("Location: community.php");
    exit();
}
