<!-- <?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];
    $experience = $_POST['experience'] ?? null;
    $job_title = $_POST['job_title'] ?? null;
    $clause = "";

    if (!empty($job_title) || $job_title == null) {
        $clause .= "AND users_additional_info.user_main_profession LIKE '%$job_title%'";
    }
    if (!empty($experience)) {
        // Properly handling the 'fresher' value as a string in the SQL query
        $experience = $experience === 'fresher' ? "'fresher'" : $experience;
        $clause .= "AND (resumes.job_title_experience = $experience OR resumes2.job_title_experience = $experience OR resumes3.job_title_experience = $experience OR resume4.job_title_experience = $experience)";
    }
} else {
    header("Location: companyHome.php");
    exit();
}
?> -->