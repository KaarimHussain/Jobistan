<?php
// Ensure the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Database connection (adjust with your database credentials)
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "resumes";

//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);

//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }



$fromtofinal = isset($_POST["form_skills"]) ? $_POST["form_skills"] : "";

//$form_skills = $conn->real_escape_string($_POST['form_skills']);


//   $sql = "INSERT INTO resumes003 (full_name, job_title, job_summary, email, phone,locations, linkedin, twitter, title_1, company_name_1, job_duration_1, job_description_1, job_title_2, company_name_2, job_duration_2, job_description_2, skills, languages, Education1, education_date1, Education2, education_date2)
//   VALUES ('$full_name', '$job_title', '$job_summary', '$email', '$phone','$location1', '$linkedin', '$twitter', '$job_title_1', '$company_name_1', '$job_duration_1', '$job_description_1', '$job_title_2', '$company_name_2', '$job_duration_2', '$job_description_2', '$form_skills', '$languages', '$Education1', '$Education_date1', '$Education2', '$Education_date2')";

//     if ($conn->query($sql) === false) {
//       echo "this is expected";
//     } 

header("Location: skills_display.php?chutiya=" . urlencode($fromtofinal));
exit();
?>