<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CREATE_RESUME";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $education = $_POST['education'];
    $skills = $_POST['skills'];
    
    $user_id = 1; 

    if (isset($_POST['job_experience'])) {
        $job_experience = $_POST['job_experience'];
        $serialized_experience = serialize($job_experience);
    } else {
        $serialized_experience = ''; 
    }

    $sql = "INSERT INTO resumes (user_id, full_name, email, phone, education, experience, skills) 
            VALUES ('$user_id', '$full_name', '$email', '$phone', '$education', '$serialized_experience', '$skills')";

    if ($conn->query($sql) === TRUE) {
        echo "Resume created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
