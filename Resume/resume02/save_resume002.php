<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "job_website";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$currentuser = $_SESSION['logged']['id'];


// Create a new MySQLi instance
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Check if data is being received
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // Sanitize and validate input data

    $toformskill = isset($_POST['form_skills']) ? $_POST['form_skills'] : '';
    $toformlang = isset($_POST['language_list']) ? $_POST['language_list'] : '';

    $full_name = isset($_POST['form_full_name']) ? $conn->real_escape_string($_POST['form_full_name']) : '';
    $job_title = isset($_POST['form_job_title']) ? $conn->real_escape_string($_POST['form_job_title']) : '';
    $email = isset($_POST['form_email']) ? $conn->real_escape_string($_POST['form_email']) : '';
    $phone = isset($_POST['form_phone']) ? $conn->real_escape_string($_POST['form_phone']) : '';
    $address = isset($_POST['form_address']) ? $conn->real_escape_string($_POST['form_address']) : '';
    $dob = isset($_POST['form_dob']) ? $conn->real_escape_string($_POST['form_dob']) : '';
    $summary = isset($_POST['form_summary']) ? $conn->real_escape_string($_POST['form_summary']) : '';
    $job_title1 = isset($_POST['form_job_title1']) ? $conn->real_escape_string($_POST['form_job_title1']) : '';
    $company_name = isset($_POST['form_company_name']) ? $conn->real_escape_string($_POST['form_company_name']) : '';
    $job_duration_start = isset($_POST['form_job_duration_start']) ? $conn->real_escape_string($_POST['form_job_duration_start']) : '';
    $job_duration_end = isset($_POST['form_job_duration_end']) ? $conn->real_escape_string($_POST['form_job_duration_end']) : '';
    $job_description = isset($_POST['form_job_description']) ? $conn->real_escape_string($_POST['form_job_description']) : '';
    $education_name = isset($_POST['form_education_name']) ? $conn->real_escape_string($_POST['form_education_name']) : '';
    $education_description = isset($_POST['form_education_description']) ? $conn->real_escape_string($_POST['form_education_description']) : '';
    $education_name2 = isset($_POST['form_education_name2']) ? $conn->real_escape_string($_POST['form_education_name2']) : '';
    $education_description2 = isset($_POST['form_education_description2']) ? $conn->real_escape_string($_POST['form_education_description2']) : '';
    $education_name3 = isset($_POST['form_education_name3']) ? $conn->real_escape_string($_POST['form_education_name3']) : '';
    $education_description3 = isset($_POST['form_education_description3']) ? $conn->real_escape_string($_POST['form_education_description3']) : '';
    $skills = isset($_POST['form_skills']) ? $conn->real_escape_string($_POST['form_skills']) : '';
    $language_list = isset($_POST['language_list']) ? $conn->real_escape_string($_POST['language_list']) : '';
    $job_title_experience = isset($_POST['exact_experience']) ? $conn->real_escape_string($_POST['exact_experience']) : '';

    // SQL query to insert data into the database
    $sql = "INSERT INTO resumes2 (user_id,full_name, job_title, email, phone, address, dob, summary, job_title1, company_name, job_duration_start, job_duration_end, job_description, education_name, education_description, education_name2, education_description2, education_name3, education_description3, skills, language_list, job_title_experience)
            VALUES ('$currentuser','$full_name', '$job_title', '$email', '$phone', '$address', '$dob', '$summary', '$job_title1', '$company_name', '$job_duration_start', '$job_duration_end', '$job_description', '$education_name', '$education_description', '$education_name2', '$education_description2', '$education_name3', '$education_description3', '$skills', '$language_list', '$job_title_experience')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    }

    // Close the database connection
    $conn->close();
}
header(
    "Location: final_resume002.php?" .
        "full_name=" . urlencode($full_name) .
        "&job_title=" . urlencode($job_title) .
        "&email=" . urlencode($email) .
        "&phone=" . urlencode($phone) .
        "&address=" . urlencode($address) .
        "&dob=" . urlencode($dob) .
        "&summary=" . urlencode($summary) .
        "&job_title1=" . urlencode($job_title1) .
        "&company_name=" . urlencode($company_name) .
        "&job_duration_start=" . urlencode($job_duration_start) .
        "&job_duration_end=" . urlencode($job_duration_end) .
        "&job_description=" . urlencode($job_description) .
        "&education_name=" . urlencode($education_name) .
        "&education_description=" . urlencode($education_description) .
        "&education_name2=" . urlencode($education_name2) .
        "&education_description2=" . urlencode($education_description2) .
        "&education_name3=" . urlencode($education_name3) .
        "&education_description3=" . urlencode($education_description3) .
        "&skills=" . urlencode($toformskill) .
        "&language_list=" . urlencode($toformlang)
);
exit();
