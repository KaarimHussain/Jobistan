<?php
include ("./Includes/sessionStart.php");
include ("./Classes/Base.php");

if (!isset($_SESSION['logged'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Checking if the server request method is comming from POST
        if (isset($_POST['SignUpBtn'])) {
            include ("Includes/db.php");
            $mainClass = new Select($conn);
            // Fetching all the Data that is coming from signup.php page
            $roleChoice = $_POST['roleChoice'];
            // Create an instance of the Select class

            if ($roleChoice == 'worker') {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];

                // Check if profile_picture was uploaded
                $picture = isset($_FILES['profile_picture']) ? $_FILES['profile_picture'] : null;
                // Call the InsertWorker method
                if ($mainClass->InsertWorker($username, $email, $password, 'worker', $phone, $address, $picture)) {
                    header("Location: home.php");
                    exit();
                } else {
                    // Error message is already set in the session by InsertWorker
                    // $_SESSION['register_error'] = "Cannot insert worker data!";
                    header("Location: signup.php");
                    exit();
                }
            } else if ($roleChoice == 'recruiter') {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $company_name = $_POST['company_name'];
                $company_culture = $_POST['company_culture'];
                $company_description = $_POST['company_description'];
                $company_benefits = $_POST['company_benefits'];

                // Check if company_logo was uploaded
                $company_logo = isset($_FILES['company_logo']) ? $_FILES['company_logo'] : null;

                // Call the InsertCompany method
                if ($mainClass->InsertCompany($username, $email, $password, 'recruiter', $company_name, $company_culture, $company_description, $company_benefits, $company_logo)) {
                    header("Location: signup.php");
                    exit();
                } else {
                    // Error message is already set in the session by InsertCompany
                    $_SESSION['register_error'] = "Cannot insert comapny data";
                    header("Location: signup.php");
                    exit();
                }
            } else {
                $_SESSION['register_error'] = "Invalid role selected. Please try again!";
                header("Location: signup.php");
                exit();
            }
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
