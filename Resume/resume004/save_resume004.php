<?php
// Check if form is submitted
// Retrieve data from POST variables
// Retrieve data from POST variables

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$currentuser = $_SESSION['logged']['id'];
$full_name = $_POST['full_name'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$expertofinal = isset($_POST["expertise"]) ? $_POST["expertise"] : "";
$expertise = $_POST['expertise'];
$languages = $_POST['languages'];
$hobbies = $_POST['hobbies'];
$about_me = $_POST['about_me'];
$job_title_1 = $_POST['job_title_1'];
$company_name_1 = $_POST['company_name_1'];
$joblocation1 = $_POST['joblocation1'];
$job_duration_start1 = $_POST['job_duration_start1'];
$job_duration_end1 = $_POST['job_duration_end1'];
$job_description_1 = $_POST['job_description_1'];
$job_title_2 = $_POST['job_title_2'];
$company_name_2 = $_POST['company_name_2'];
$joblocation2 = $_POST['joblocation2'];
$job_duration_start2 = $_POST['job_duration_start2'];
$job_duration_end2 = $_POST['job_duration_end2'];
$job_description_2 = $_POST['job_description_2'];
$Education_name1 = $_POST['Education_name1'];
$Education_passoutdate1 = $_POST['Education_passoutdate1'];
$Education_discription1 = $_POST['Education_discription1'];
$Education_name2 = $_POST['Education_name2'];
$Education_passoutdate2 = $_POST['Education_passoutdate2'];
$Education_discription2 = $_POST['Education_discription2'];
$r_name = $_POST['r_name'];
$job_position_1 = $_POST['job_position_1'];
$r_company_name_1 = $_POST['r_company_name_1'];
$job_phone_1 = $_POST['job_phone_1'];
$job_email_1 = $_POST['job_email_1'];
$job_title_experience = $_POST['exact_experience'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "job_website";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Example: Insert data into a table
        // Prepare SQL statement for inserting data into table
        $sql = "INSERT INTO resume4 (user_id, full_name, job_title, phone, email, address, expertise, languages, hobbies,
         job_title_1, company_name_1, joblocation1, job_duration_start1, job_duration_end1, job_description_1,
         job_title_2, company_name_2, joblocation2, job_duration_start2, job_duration_end2, job_description_2,
         Education_name1, Education_passoutdate1, Education_discription1,
         Education_name2, Education_passoutdate2, Education_discription2,
         r_name, job_position_1, r_company_name_1, job_phone_1, job_email_1, aboutme, job_title_experience)
         VALUES ($currentuser ,:full_name, :job_title, :phone, :email, :address, :expertise, :languages, :hobbies,
         :job_title_1, :company_name_1, :joblocation1, :job_duration_start1, :job_duration_end1, :job_description_1,
         :job_title_2, :company_name_2, :joblocation2, :job_duration_start2, :job_duration_end2, :job_description_2,
         :Education_name1, :Education_passoutdate1, :Education_discription1,
         :Education_name2, :Education_passoutdate2, :Education_discription2,
         :r_name, :job_position_1, :r_company_name_1, :job_phone_1, :job_email_1, :about_me, :job_title_experience)";

        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':job_title', $job_title);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);

        $stmt->bindParam(':expertise', $expertise);
        $stmt->bindParam(':languages', $languages);
        $stmt->bindParam(':hobbies', $hobbies);

        $stmt->bindParam(':job_title_1', $job_title_1);
        $stmt->bindParam(':company_name_1', $company_name_1);
        $stmt->bindParam(':joblocation1', $joblocation1);
        $stmt->bindParam(':job_duration_start1', $job_duration_start1);
        $stmt->bindParam(':job_duration_end1', $job_duration_end1);
        $stmt->bindParam(':job_description_1', $job_description_1);

        $stmt->bindParam(':job_title_2', $job_title_2);
        $stmt->bindParam(':company_name_2', $company_name_2);
        $stmt->bindParam(':joblocation2', $joblocation2);
        $stmt->bindParam(':job_duration_start2', $job_duration_start2);
        $stmt->bindParam(':job_duration_end2', $job_duration_end2);
        $stmt->bindParam(':job_description_2', $job_description_2);

        $stmt->bindParam(':Education_name1', $Education_name1);
        $stmt->bindParam(':Education_passoutdate1', $Education_passoutdate1);
        $stmt->bindParam(':Education_discription1', $Education_discription1);

        $stmt->bindParam(':Education_name2', $Education_name2);
        $stmt->bindParam(':Education_passoutdate2', $Education_passoutdate2);
        $stmt->bindParam(':Education_discription2', $Education_discription2);

        $stmt->bindParam(':r_name', $r_name);
        $stmt->bindParam(':job_position_1', $job_position_1);
        $stmt->bindParam(':r_company_name_1', $r_company_name_1);
        $stmt->bindParam(':job_phone_1', $job_phone_1);
        $stmt->bindParam(':job_email_1', $job_email_1);
        $stmt->bindParam(':about_me', $about_me);
        $stmt->bindParam(':job_title_experience', $job_title_experience);
        // Execute the query
        $stmt->execute();

        echo "Data inserted successfully!";


        $redirectURL = "Location: final_resume004.php?" .
            "full_name=" . urlencode($full_name) .
            "&job_title=" . urlencode($job_title) .
            "&email=" . urlencode($email) .
            "&phone=" . urlencode($phone) .
            "&address=" . urlencode($address) .
            "&expertise=" . urlencode($expertise) .
            "&languages=" . urlencode($languages) .
            "&hobbies=" . urlencode($hobbies) .
            "&about_me=" . urlencode($about_me) .
            "&job_title_1=" . urlencode($job_title_1) .
            "&company_name_1=" . urlencode($company_name_1) .
            "&joblocation1=" . urlencode($joblocation1) .
            "&job_duration_start1=" . urlencode($job_duration_start1) .
            "&job_duration_end1=" . urlencode($job_duration_end1) .
            "&job_description_1=" . urlencode($job_description_1) .
            "&job_title_2=" . urlencode($job_title_2) .
            "&company_name_2=" . urlencode($company_name_2) .
            "&joblocation2=" . urlencode($joblocation2) .
            "&job_duration_start2=" . urlencode($job_duration_start2) .
            "&job_duration_end2=" . urlencode($job_duration_end2) .
            "&job_description_2=" . urlencode($job_description_2) .
            "&Education_name1=" . urlencode($Education_name1) .
            "&Education_passoutdate1=" . urlencode($Education_passoutdate1) .
            "&Education_discription1=" . urlencode($Education_discription1) .
            "&Education_name2=" . urlencode($Education_name2) .
            "&Education_passoutdate2=" . urlencode($Education_passoutdate2) .
            "&Education_discription2=" . urlencode($Education_discription2) .
            "&r_name=" . urlencode($r_name) .
            "&job_position_1=" . urlencode($job_position_1) .
            "&r_company_name_1=" . urlencode($r_company_name_1) .
            "&job_phone_1=" . urlencode($job_phone_1) .
            "&job_email_1=" . urlencode($job_email_1) .
            "&about_me=" . urlencode($about_me);
        header($redirectURL);
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close connection
    $conn = null;
} else {
    echo "Form not submitted.";
}
