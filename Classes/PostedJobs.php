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
        $SQL = "DELETE FROM job_listings WHERE id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function selectAppliedJobUsers($job_id, $clause = "")
    {
        $SQL = "SELECT 
                applied_jobs.user_id,
                applied_jobs.job_id,
                users.username,
                users.email,
                users_additional_info.user_main_profession,
                resumes.job_title_experience AS resume1_experience,
                resumes2.job_title_experience AS resume2_experience,
                resumes3.job_title_experience AS resume3_experience,
                resume4.job_title_experience AS resume4_experience
            FROM 
                applied_jobs
            INNER JOIN 
                users ON applied_jobs.user_id = users.id
            LEFT JOIN 
                users_additional_info ON users.id = users_additional_info.user_id
            LEFT JOIN 
                resumes ON applied_jobs.user_id = resumes.user_id
            LEFT JOIN 
                resumes2 ON applied_jobs.user_id = resumes2.user_id
            LEFT JOIN 
                resumes3 ON applied_jobs.user_id = resumes3.user_id
            LEFT JOIN 
                resume4 ON applied_jobs.user_id = resume4.user_id
            WHERE 
                applied_jobs.job_id = ?  
            " . $clause;

        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function selectAllSchedulesInterViews($job_id)
    {
        $SQL = "SELECT * FROM scheduledinterviews WHERE job_id =?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteAppliedJobs($user_id)
    {
        $sql = "DELETE FROM applied_jobs WHERE user_id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function insertIntoInterviewedTable($user_id, $job_id, $username, $email, $job_title, $description, $date, $time)
    {
        $sql = "INSERT INTO scheduledInterviews (
            user_id,
            job_id,
            interviewedUser,
            interviewedEmail,
            job_title,
            interviewed_description,
            interviewed_date,
            interviewed_time,
            created_at,
            interviewStatus
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'interview_on'
        )";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iissssss", $user_id, $job_id, $username, $email, $job_title, $description, $date, $time);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }

        // $sql = "INSERT INTO scheduledInterviews (
        //     user_id,
        //     job_id,
        //     interviewedUser,
        //     interviewedEmail,
        //     job_title,
        //     interviewed_description,
        //     interviewed_date,
        //     interviewed_time,
        //     created_at
        // ) VALUES (
        //     ?, ?, ?, ?, ?, ?, ?, ?, NOW()
        // )";
        // $stmt = $this->conn->prepare($sql);
        // $stmt->bind_param("iissssss", $user_id, $job_id, $username, $email, $job_title, $description, $date, $time);
        // $stmt->execute();
        // if ($stmt->affected_rows > 0) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
    public function ifExistInterviewedUser($user_id, $job_id)
    {
        $sql = "SELECT * FROM scheduledInterviews WHERE user_id = ? AND job_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function changeStatusFromInterviewed($user_id, $job_id)
    {
        // $sql = "DELETE FROM scheduledInterviews WHERE user_id = ?, job_id = ?";
        // $stmt = $this->conn->prepare($sql);
        // $stmt->bind_param("ii", $user_id, $job_id);
        // if ($stmt->execute()) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
    public function checkInterviewStatus($job_id, $user_id)
    {
        $SQL = "SELECT interviewStatus FROM scheduledinterviews WHERE job_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ii", $job_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['interviewStatus'];
        } else {
            return null;
        }
    }
    public function deleteFromInterviewTable($job_id, $user_id)
    {
        $sql = "DELETE FROM scheduledinterviews WHERE job_id = ? AND user_id = ?";
        $sql2 = "DELETE FROM applied_jobs WHERE job_id = ? AND user_id = ?";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $job_id, $user_id);
        $stmt2->bind_param("ii", $job_id, $user_id);
        if ($stmt->execute() && $stmt2->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function changePostStatus($job_id)
    {
        $sql = "UPDATE job_listings SET job_status = CASE WHEN job_status = 'open' THEN 'close' ELSE 'open' END WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getPostStatus($job_id)
    {
        $sql = "SELECT job_status FROM job_listings WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['job_status'];
        } else {
            return null;
        }
    }
    public function getScheduledInterviewsCount($job_id)
    {
        $sql = "SELECT COUNT(*) as count FROM scheduledinterviews WHERE job_id = ? AND interviewStatus = 'interview_on'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    public function getAppliedUserCount($job_id)
    {
        $sql = "SELECT COUNT(*) as count FROM applied_jobs WHERE job_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    public function viewHiredEmpCount($job_id)
    {
        $sql = "SELECT COUNT(*) as count FROM hired_history WHERE job_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }
}
