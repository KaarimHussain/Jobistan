<?php
include('./Includes/sessionStart.php');
class HandleResume
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    /**
     * Attempts to log in a user with the provided email and password.
     * **Note:** This method does not handle the sessions error for you   
     *
     * @param string $job_title The user's job_title.
     * @param string $job_experience The user's experience.
     * @param int $user_id The user's experience.
     * @param string $pdfFile The user's pdfFile.
     * @return bool True if file uploaded on db successfull.
     */
    public function handleExternalResume($user_id, $job_title, $job_experience, $pdfFile)
    {
        $SQL = "INSERT INTO external_user_resume(user_id, job_title, job_experience) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("iss", $user_id, $job_title, $job_experience);
        $stmt->execute();
        if ($stmt->affected_rows > 0 && $this->handleDirForResume($user_id, $pdfFile)) {
            $_SESSION['generalSuccess'] = "Successfully Uploaded your PDF in the Database";
            return true;
        } else {
            return false;
        }
    }

    public function handleDirForResume($user_id, $pdfFile)
    {
        // Define the directory where PDFs will be saved
        $uploadDir = './ExternalResume/';
        $uploadFile = $uploadDir . basename($pdfFile['name']);
        $uploadFileDB = './ExternalResume/' . basename($pdfFile['name']);
        // Ensure the directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        // Move the uploaded file to the directory
        if (move_uploaded_file($pdfFile['tmp_name'], $uploadFile)) {
            // Prepare SQL statement
            $stmt = $this->conn->prepare('INSERT INTO workers_resume (user_id ,resume_file) VALUES (?,?)');
            $stmt->bind_param('is', $user_id, $uploadFileDB);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                $_SESSION['generalError'] = "Failed to save the resume in the Database";
                return false;
            }
        } else {
            return false;
        }
    }
    // public function InsertIntoWorkerResume($user_id, $resume)
    // {
    //     $SQL = "INSERT INTO worker_resumes(user_id, resume_file) VALUES (?,?)";
    //     $stmt = $this->conn->prepare($SQL);
    //     $stmt->bind_param("is", $user_id, $resume);
    //     $stmt->execute();
    //     if ($stmt->affected_rows > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
