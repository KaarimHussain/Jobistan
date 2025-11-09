<?php
session_start();
include('./Includes/db.php');

if (!isset($_SESSION['logged']['id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['logged']['id'];

function backupData($conn, $sql, $user_id, $description)
{
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new Exception("Error preparing backup statement for $description: " . $conn->error);
    }

    if (strpos($description, 'messages') !== false) {
        $stmt->bind_param("ii", $user_id, $user_id);
    } else {
        $stmt->bind_param("i", $user_id);
    }

    if (!$stmt->execute()) {
        throw new Exception("Error executing backup statement for $description: " . $stmt->error);
    }

    $stmt->close();
}

try {
    $conn->begin_transaction();

    $conn->query('SET foreign_key_checks = 0');

    backupData($conn, "INSERT INTO backup_profiles (user_id, name, phone, address, profile_picture, created_at)
               SELECT user_id, name, phone, address, profile_picture, created_at FROM profiles WHERE user_id = ?", $user_id, 'profiles');

    backupData($conn, "INSERT INTO backup_resume_data (user_id, resume, skills, experience, education)
               SELECT user_id, resume, skills, experience, education FROM resume_data WHERE user_id = ?", $user_id, 'resume');

    backupData($conn, "INSERT INTO backup_employer_profiles (user_id, company_name, company_description, company_culture, company_benefits, company_logo)
               SELECT user_id, company_name, company_description, company_culture, company_benefits, company_logo FROM employer_profiles WHERE user_id = ?", $user_id, 'employer profiles');

    backupData($conn, "INSERT INTO backup_applications (job_seeker_id, job_listing_id, status, created_at)
               SELECT job_seeker_id, job_listing_id, status, created_at FROM applications WHERE job_seeker_id = ?", $user_id, 'applications');

    backupData($conn, "INSERT INTO backup_user_work_experience (user_id, company_name, work_description, company_start_date, company_end_date)
               SELECT user_id, company_name, work_description, company_start_date, company_end_date FROM user_work_experience WHERE user_id = ?", $user_id, 'user work experience');

    backupData($conn, "INSERT INTO backup_companies_applied_jobs (users_id, job_id, employers_id, created_at)
               SELECT users_id, job_id, employers_id, created_at FROM companies_applied_jobs WHERE users_id = ?", $user_id, 'companies applied jobs');

    backupData($conn, "INSERT INTO backup_workers_resume (user_id, resume_file, visibility)
               SELECT user_id, resume_file, visibility FROM workers_resume WHERE user_id = ?", $user_id, 'workers resume');

    backupData($conn, "INSERT INTO backup_external_user_resume (user_id, job_title, job_experience)
               SELECT user_id, job_title, job_experience FROM external_user_resume WHERE user_id = ?", $user_id, 'external user resume');

    backupData($conn, "INSERT INTO backup_users_additional_info (user_id, user_description, user_interest, user_hobbies, user_main_profession)
               SELECT user_id, user_description, user_interest, user_hobbies, user_main_profession FROM users_additional_info WHERE user_id = ?", $user_id, 'users additional info');

    $delete_queries = [
        'profiles' => 'user_id',
        'resume_data' => 'user_id',
        'employer_profiles' => 'user_id',
        'applications' => 'job_seeker_id',
        'messages' => ['sender_id', 'receiver_id'],
        'user_work_experience' => 'user_id',
        'resumes' => 'user_id',
        'companies_applied_jobs' => 'users_id',
        'workers_resume' => 'user_id',
        'external_user_resume' => 'user_id',
        'users_additional_info' => 'user_id'
    ];

    foreach ($delete_queries as $table => $condition) {
        if (is_array($condition)) {
            $sql_delete = "DELETE FROM $table WHERE $condition[0] = ? OR $condition[1] = ?";
            $stmt = $conn->prepare($sql_delete);
            if ($stmt === false) {
                throw new Exception("Error preparing delete statement for $table: " . $conn->error);
            }
            $stmt->bind_param("ii", $user_id, $user_id);
        } else {
            $sql_delete = "DELETE FROM $table WHERE $condition = ?";
            $stmt = $conn->prepare($sql_delete);
            if ($stmt === false) {
                throw new Exception("Error preparing delete statement for $table: " . $conn->error);
            }
            $stmt->bind_param("i", $user_id);
        }

        if (!$stmt->execute()) {
            throw new Exception("Error deleting data from $table: " . $stmt->error);
        }
        $stmt->close();
    }

    $sql_delete_user = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql_delete_user);
    if ($stmt === false) {
        throw new Exception("Error preparing delete statement for user: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    if (!$stmt->execute()) {
        throw new Exception("Error deleting user account: " . $stmt->error);
    }

    $conn->commit();

    $conn->query('SET foreign_key_checks = 1');

    unset($_SESSION['logged']);
    session_destroy();
    header('Location: index.php');
    exit;

} catch (Exception $e) {
    $conn->rollback();

    $conn->query('SET foreign_key_checks = 1');

    echo "Transaction failed: " . $e->getMessage() . "<br>";
}

$conn->close();
