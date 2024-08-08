<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "CREATE_RESUME";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $stmt = $conn->prepare("INSERT INTO resumes2 (full_name, job_title, phone, email, address, expertise, languages, hobbies, about_me, education, profile_picture, job_title_1, company_name_1, job_duration_1, job_description_1, r_name, job_position_1, company_name, job_phone, job_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// $stmt->bind_param("ssssssssssssssssssss", $full_name, $job_title, $phone, $email, $address, $expertise, $languages, $hobbies, $about_me, $education, $profile_picture, $job_title_1, $company_name_1, $job_duration_1, $job_description_1, $r_name, $job_position_1, $company_name, $job_phone, $job_email);

// $full_name = $_POST['full_name'] ?? '';
// $job_title = $_POST['job_title'] ?? '';
// $phone = $_POST['phone'] ?? '';
// $email = $_POST['email'] ?? '';
// $address = $_POST['address'] ?? '';
// $expertise = $_POST['expertise'] ?? '';
// $languages = $_POST['languages'] ?? '';
// $hobbies = $_POST['hobbies'] ?? '';
// $about_me = $_POST['about_me'] ?? '';
// $education = $_POST['education'] ?? '';
// $profile_picture = null;

// if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['size'] > 0) {
//     $profile_picture = file_get_contents($_FILES['profile_picture']['tmp_name']);
// }

// // Assuming these are single values, not arrays
// $job_title_1 = $_POST['job_title_1'] ?? '';
// $company_name_1 = $_POST['company_name_1'] ?? '';
// $job_duration_1 = $_POST['job_duration_1'] ?? '';
// $job_description_1 = $_POST['job_description_1'] ?? '';
// $r_name = $_POST['r_name'] ?? '';
// $job_position_1 = $_POST['job_position_1'] ?? '';
// $company_name = $_POST['company_name'] ?? '';
// $job_phone = $_POST['job_phone'] ?? '';
// $job_email = $_POST['job_email'] ?? '';

// if ($stmt->execute()) {
//     $location = "Location: template.php?" . http_build_query([
//         'full_name' => $full_name,
//         'job_title' => $job_title,
//         'phone' => $phone,
//         'email' => $email,
//         'address' => $address,
//         'expertise' => $expertise,
//         'languages' => $languages,
//         'hobbies' => $hobbies,
//         'about_me' => $about_me,
//         'education' => $education,
//         'profile_picture' => $profile_picture,
//         'job_title_1' => $job_title_1,
//         'company_name_1' => $company_name_1,
//         'job_duration_1' => $job_duration_1,
//         'job_description_1' => $job_description_1,
//         'r_name' => $r_name,
//         'job_position_1' => $job_position_1,
//         'company_name' => $company_name,
//         'job_phone' => $job_phone,
//         'job_email' => $job_email,
//     ]);
//     header($location);
//     exit();
// } else {
//     echo "Error: " . $stmt->error;
// }

// $stmt->close();
// $conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CREATE_RESUME";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO resumes2 (full_name, job_title, phone, email, address, expertise, languages, hobbies, about_me, education, profile_picture, job_title_1, company_name_1, job_duration_1, job_description_1, r_name, job_position_1, company_name, job_phone, job_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssssssssssssss", $full_name, $job_title, $phone, $email, $address, $expertise, $languages, $hobbies, $about_me, $education, $profile_picture, $job_title_1, $company_name_1, $job_duration_1, $job_description_1, $r_name, $job_position_1, $company_name, $job_phone, $job_email);

$full_name = $_POST['full_name'] ?? '';
$job_title = $_POST['job_title'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$expertise = $_POST['expertise'] ?? '';
$languages = $_POST['languages'] ?? '';
$hobbies = $_POST['hobbies'] ?? '';
$about_me = $_POST['about_me'] ?? '';
$education = $_POST['education'] ?? '';
$profile_picture = null;

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['size'] > 0) {
    $profile_picture = file_get_contents($_FILES['profile_picture']['tmp_name']);
}

$experience = '';
foreach ($_POST['job_title'] as $index => $job_title) {
    $company_name = $_POST['company_name'][$index];
    $job_duration = $_POST['job_duration'][$index];
    $job_description = $_POST['job_description'][$index];

    $experience .= $job_title . " at " . $company_name . " (" . $job_duration . "): " . $job_description . "\n";
}

$r_name = $_POST['r_name'] ?? '';
$job_position_1 = $_POST['job_position_1'] ?? '';
$company_name = $_POST['company_name'] ?? '';
$job_phone = $_POST['job_phone'] ?? '';
$job_email = $_POST['job_email'] ?? '';

if ($stmt->execute()) {
    $location = "Location: template.php?" . http_build_query([
        'full_name' => $full_name,
        'job_title' => $job_title,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'expertise' => $expertise,
        'languages' => $languages,
        'hobbies' => $hobbies,
        'about_me' => $about_me,
        'education' => $education,
        'job_title_1' => $job_title_1,
        'company_name_1' => $company_name_1,
        'job_duration_1' => $job_duration_1,
        'job_description_1' => $job_description_1,
        'r_name' => $r_name,
        'job_position_1' => $job_position_1,
        'company_name' => $company_name,
        'job_phone' => $job_phone,
        'job_email' => $job_email,
    ]);
    header($location);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

