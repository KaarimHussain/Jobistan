<?php
session_start();
include('./Includes/db.php'); // Include your database connection file

if (!isset($_SESSION['logged']['id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['logged']['id'];

// Function to backup data from tables
function backupData($conn, $sql, $user_id, $description)
{
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        // echo 'Prepare failed for ' . $description . ': ' . $conn->error . "<br>";
        return false;
    }

    if (strpos($description, 'messages') !== false) {
        // For messages, bind two parameters
        $stmt->bind_param("ii", $user_id, $user_id);
    } else {
        $stmt->bind_param("i", $user_id);
    }

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            // Uncomment the line below if you want to see success messages
            // echo "Backup of $description data successful.<br>";
            $stmt->close();
            return true;
        } else {
            // echo "No $description data to back up for user_id: $user_id.<br>";
            $stmt->close();
            return false;
        }
    } else {
        // echo "Error backing up $description data: " . $stmt->error . "<br>";
        $stmt->close();
        return false;
    }
}

// Function to temporarily drop and re-add foreign key constraints
function manageForeignKeyConstraints($conn, $action)
{
    $constraints = [
        'resumes' => 'resumes_ibfk_1'
    ];

    foreach ($constraints as $table => $constraint) {
        if ($action === 'drop') {
            $sql = "ALTER TABLE $table DROP FOREIGN KEY $constraint";
        } elseif ($action === 'add') {
            $sql = "ALTER TABLE $table ADD CONSTRAINT $constraint FOREIGN KEY (user_id) REFERENCES users(id)";
        }
        if (!$conn->query($sql)) {
            throw new Exception("Error managing foreign key constraint $constraint on $table: " . $conn->error);
        }
    }
}

try {
    // Start transaction to ensure atomicity
    $conn->begin_transaction();

    // Drop foreign key constraints in backup tables
    manageForeignKeyConstraints($conn, 'drop');

    // Backup all data
    $backup_status = true;

    $backup_status &= backupData($conn, "INSERT INTO backup_profiles (user_id, name, phone, address, profile_picture, created_at)
                      SELECT user_id, name, phone, address, profile_picture, created_at FROM profiles WHERE user_id = ?", $user_id, 'profiles');

    $backup_status &= backupData($conn, "INSERT INTO backup_resume_data (user_id, resume, skills, experience, education)
                      SELECT user_id, resume, skills, experience, education FROM resume_data WHERE user_id = ?", $user_id, 'resume');

    $backup_status &= backupData($conn, "INSERT INTO backup_employer_profiles (user_id, company_name, company_description, company_culture, company_benefits, company_logo)
                      SELECT user_id, company_name, company_description, company_culture, company_benefits, company_logo FROM employer_profiles WHERE user_id = ?", $user_id, 'employer profiles');

    $backup_status &= backupData($conn, "INSERT INTO backup_applications (job_seeker_id, job_listing_id, status, created_at)
                      SELECT job_seeker_id, job_listing_id, status, created_at FROM applications WHERE job_seeker_id = ?", $user_id, 'applications');

    // $backup_status &= backupData($conn, "INSERT INTO backup_messages (sender_id, receiver_id, message, created_at)
    //                   SELECT sender_id, receiver_id, message, created_at FROM messages WHERE sender_id = ? OR receiver_id = ?", $user_id, 'messages');

    $backup_status &= backupData($conn, "INSERT INTO backup_user_work_experience (user_id, company_name, work_description, company_start_date, company_end_date)
                      SELECT user_id, company_name, work_description, company_start_date, company_end_date FROM user_work_experience WHERE user_id = ?", $user_id, 'user work experience');

    $backup_status &= backupData($conn, "INSERT INTO backup_companies_applied_jobs (users_id, job_id, employers_id, created_at)
                      SELECT users_id, job_id, employers_id, created_at FROM companies_applied_jobs WHERE users_id = ?", $user_id, 'companies applied jobs');

    $backup_status &= backupData($conn, "INSERT INTO backup_workers_resume (user_id, resume_file, visibility)
                      SELECT user_id, resume_file, visibility FROM workers_resume WHERE user_id = ?", $user_id, 'workers resume');

    $backup_status &= backupData($conn, "INSERT INTO backup_external_user_resume (user_id, job_title, job_experience)
                      SELECT user_id, job_title, job_experience FROM external_user_resume WHERE user_id = ?", $user_id, 'external user resume');

    // Delete user data from main tables
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
        'external_user_resume' => 'user_id'
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

    // Delete user account
    $sql_delete_user = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql_delete_user);
    if ($stmt === false) {
        throw new Exception("Error preparing delete statement for user: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        // Commit transaction
        $conn->commit();

        // Recreate foreign key constraints
        manageForeignKeyConstraints($conn, 'add');

        // Destroy session and redirect to goodbye page
        unset($_SESSION['logged']);
        session_destroy();
        // Uncomment the lines below if you want to show success messages
        // echo "Account deleted successfully.<br>";
        // echo "Data backup completed successfully.<br>";
        header('Location: index.php'); // Redirect after 3 seconds
        exit;
    } else {
        throw new Exception("Error deleting user account: " . $stmt->error);
    }
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage() . "<br>";
}

// Close connection
$conn->close();
?>
