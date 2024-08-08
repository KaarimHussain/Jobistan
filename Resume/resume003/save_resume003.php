<?php




// Ensure the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Database connection (adjust with your database credentials)
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "job_website";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $currentuser = $_SESSION['logged']['id'];


  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve and sanitize each form field

  $fromtofinal = isset($_POST["form_skills"]) ? $_POST["form_skills"] : "";
  $langtofinal = isset($_POST["form_languages"]) ? $_POST["form_languages"] : "";

  $full_name = $conn->real_escape_string($_POST['form_full_name']);
  $job_title = $conn->real_escape_string($_POST['form_job_title']);
  $job_summary = $conn->real_escape_string($_POST['form_job_summary']);
  $email = $conn->real_escape_string($_POST['form_email']);
  $phone = $conn->real_escape_string($_POST['form_phone']);
  $linkedin = $conn->real_escape_string($_POST['form_linkedin']);
  $twitter = $conn->real_escape_string($_POST['form_twitter']);
  $location1 = $conn->real_escape_string($_POST['form_Location']);
  $job_title_1 = $conn->real_escape_string($_POST['form_job_title_1']);
  $company_name_1 = $conn->real_escape_string($_POST['form_company_name_1']);
  $job_duration_1 = $conn->real_escape_string($_POST['form_job_duration_1']);
  $job_description_1 = $conn->real_escape_string($_POST['form_job_description_1']);
  $job_title_2 = $conn->real_escape_string($_POST['form_job_title_2']);
  $company_name_2 = $conn->real_escape_string($_POST['form_company_name_2']);
  $job_duration_2 = $conn->real_escape_string($_POST['form_job_duration_2']);
  $job_description_2 = $conn->real_escape_string($_POST['form_job_description_2']);
  $form_skills = $conn->real_escape_string($_POST['form_skills']);
  $languages = $conn->real_escape_string($_POST['form_languages']);
  $Education1 = $conn->real_escape_string($_POST['form_Education1']);
  $Education_date1 = $conn->real_escape_string($_POST['form_education_date1']);
  $Education2 = $conn->real_escape_string($_POST['form_Education2']);
  $Education_date2 = $conn->real_escape_string($_POST['form_education_date2']);
  $job_title_experience = $conn->real_escape_string($_POST['exact_experience']);

  // Example: Inserting data into the resumes003 table
  $sql = "INSERT INTO resumes3 (user_id,full_name, job_title, job_summary, email, phone,locations, linkedin, twitter, title_1, company_name_1, job_duration_1, job_description_1, job_title_2, company_name_2, job_duration_2, job_description_2, skills, languages, Education1, education_date1, Education2, education_date2, job_title_experience)
    VALUES ($currentuser,'$full_name', '$job_title', '$job_summary', '$email', '$phone','$location1', '$linkedin', '$twitter', '$job_title_1', '$company_name_1', '$job_duration_1', '$job_description_1', '$job_title_2', '$company_name_2', '$job_duration_2', '$job_description_2', '$form_skills', '$languages', '$Education1', '$Education_date1', '$Education2', '$Education_date2', '$job_title_experience')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  }
  // // // Close connection
  $conn->close();
}

header("Location:final_preview.php?" .
  "&form_full_name=" . urlencode($full_name) .
  "&form_job_title=" . urlencode($job_title) .
  "&form_job_summary=" . urlencode($job_summary) .
  "&form_email=" . urlencode($email) .
  "&form_phone=" . urlencode($phone) .
  "&form_linkedin=" . urlencode($linkedin) .
  "&form_twitter=" . urlencode($twitter) .
  "&form_job_tittle_1=" . urlencode($job_title_1) .
  "&form_company_name_1=" . urlencode($company_name_1) .
  "&form_job_duration_1=" . urlencode($job_duration_1) .
  "&form_job_description_1=" . urlencode($job_description_1) .
  "&form_job_title_2=" . urlencode($job_title_2) .
  "&form_company_name_2=" . urlencode($company_name_2) .
  "&form_job_duration_2=" . urlencode($job_duration_2) .
  "&form_job_description_2=" . urlencode($job_description_2) .
  "&SKILLSTOFORM=" . urlencode($fromtofinal) .
  "&form_languages=" . urlencode($langtofinal) .
  "&form_Education1=" . urlencode($Education1) .
  "&form_education_date1=" . urlencode($Education_date1) .
  "&form_Education2=" . urlencode($Education2) .
  "&form_Location=" . urlencode($Location) .
  "&form_education_date2=" . urlencode($Education_date2));

// header("Location: final_preview.php?skills=" . urlencode($form_skills));
exit();
