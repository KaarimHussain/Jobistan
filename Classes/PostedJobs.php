<?php
include('./Includes/sessionStart.php');
include('./Includes/db.php');

class PostedJobs
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function editJobPost($job_id, $title, $description, $requirement, $location, $job_type, $experience_level, $salary_range, $tags)
    {
        if ($this->ifExistJobPost($job_id)) {
            $SQL = "INSERT INTO job_listings (title, description, requirements, location, job_type, experience_level, salary_range, tags) VALUES(?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($SQL);
            $stmt->bind_param("ssssssss", $title, $description, $requirement, $location, $job_type, $experience_level, $salary_range, $tags);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function ifExistJobPost($job_id)
    {
        $SQL = "SELECT * FROM job_listings WHERE id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function fetchAllJobPostWithID($job_id)
    {
        $SQL = "SELECT * FROM job_listings WHERE id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
    public function updatePostedJobs($job_id, $title, $description, $requirement, $location, $job_type, $experience, $salary, $tags)
    {
        $SQL = "UPDATE job_listings SET title =?, description =?, requirements =?, location =?, job_type =?, experience_level =?, salary_range =?, tags =? WHERE id =?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ssssssisi", $title, $description, $requirement, $location, $job_type, $experience, $salary, $tags, $job_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deletePostedJob($job_id)
    {
        $SQL = "DELETE FROM job_listings WHERE id =?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function selectAppliedJobUsers($job_id)
    {
        $SQL = "SELECT 
                applied_jobs.user_id,
                applied_jobs.job_id,
                users.username,
                users.email,
                external_user_resume.job_title,
                users_additional_info.user_main_profession
            FROM 
                applied_jobs
            INNER JOIN 
                users ON applied_jobs.user_id = users.id
            LEFT JOIN 
                external_user_resume ON applied_jobs.user_id = external_user_resume.user_id
            LEFT JOIN 
            users_additional_info ON users.id = users_additional_info.user_id
            WHERE 
                applied_jobs.job_id = ?  
            ";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
