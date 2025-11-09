<?php
include("./Includes/sessionStart.php");
include("./Classes/ImageDetection.php");
include("./Classes/Base.php");
include("./Includes/db.php");

if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $base = new Select($conn);
    $email = $_POST['email'];  // Retrieve email from the form
    $emailDB = $base->SelectUserWithEmail($email);

    // Validate and sanitize email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register_error'] = "Invalid email address.";
        header("Location: loginthroughImage.php");
        exit();
    }

    $uploadDir = 'ImageDetection/';
    $uploadedImagePath = $uploadDir . basename($_FILES['image']['name']);

    // Validate image upload
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedImagePath)) {
        // Initialize image detection
        $detectionImage = new ImageDetection($conn);
        // Retrieve stored image path from database
        $saveUserImage = $detectionImage->selectImageFromDetectTable($emailDB['id']);  // Method to retrieve image by email

        if ($saveUserImage['savedImage'] == null) {
            $_SESSION['register_error'] = "No image found for this email. Please try again!";
            header("Location: loginthroughImage.php");
            exit();
        }

        $savedImagePath = $saveUserImage['savedImage'];

        // Check if savedImagePath is empty
        if (empty($savedImagePath)) {
            $_SESSION['register_error'] = "Saved image path is empty. Please try again!";
            header("Location: loginthroughImage.php");
            exit();
        }

        // Validate image types
        $imageType1 = @exif_imagetype($uploadedImagePath);
        $imageType2 = @exif_imagetype($savedImagePath);

        // Check if exif_imagetype failed
        if ($imageType1 === false || $imageType2 === false) {
            $_SESSION['register_error'] = "Failed to get image type. Please try again!";
            header("Location: loginthroughImage.php");
            exit();
        }

        // Compare images
        $similarity = $detectionImage->compareImages($uploadedImagePath, $imageType1, $savedImagePath, $imageType2);

        if ($similarity === false) {
            $_SESSION['register_error'] = "Image is not similar. Please try again!";
            header("Location: loginthroughImage.php");
            exit();
        } else {
            // If images are similar, log the user in
            $userData = new Select($conn);
            $row = $userData->SelectUserWithEmail($email);  // Method to select user by email

            if ($row === null) {
                $_SESSION['register_error'] = "User not found. Please try again!";
                header("Location: loginthroughImage.php");
                exit();
            }
            include('./Classes/mailing.php');
            $mail = new Mailing($conn);
            if ($mail->sendMailOTP($row['email'])) {
                $email = $row['email'];
                header("Location: OTPImageVerify.php?email=$email");
                exit();
            } else {
                $_SESSION['register_error'] = "Failed to send OTP. Please try again!";
                header("Location: loginthroughImage.php");
                exit();
            }
        }
    } else {
        $_SESSION['register_error'] = "Failed to upload image. Please try again!";
        header("Location: loginthroughImage.php");
        exit();
    }
}
