<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("./Classes/ImageDetection.php");
    include("./Includes/sessionStart.php");
    include("./Classes/Base.php");
    include("./Includes/db.php");

    $user_id = $_POST['user_id'];
    $detectionImage = new ImageDetection($conn);
    $saveUserImage = $detectionImage->selectImageFromDetectTable($user_id);
    $uploadDir = 'ImageDetection/';
    $imagePath1 = $uploadDir . basename($_FILES['image1']['name']);
    $imageType1 = exif_imagetype($_FILES['image1']['tmp_name']);
    $imagePath2 = $saveUserImage['savedImage'];
    $imageType2 = exif_imagetype($saveUserImage['savedImage']);

    $similarity = $detectionImage->compareImages($imagePath1, $imageType1, $imagePath2, $imageType2);
    if ($similarity === false) {
        $_SESSION['register_error'] = "Image is not Similar. Please try again!";
        header("Location: login.php");
        exit();
    } else {
        $userData = new Select($conn);
        $row = $userData->SelectUserWithID($user_id);
        $_SESSION['logged'] = array(
            'id' => $row['id'],
            'username' => $row['username'],
            'email' => $row['email'],
            'role' => $row['role'],
        );
        header("Location: home.php");
        exit();
    }
}
