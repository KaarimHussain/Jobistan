<?php
include ('./Includes/db.php');
include ('./Includes/sessionStart.php');
class advanceClass
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function selectUserInfoForProfile($user_id)
    {
        $SQL = "
    SELECT 
        users.email,
        users.username,
        users.created_at,
        users.role,
        profiles.phone,
        profiles.address,
        profiles.profile_picture,
        users_additional_info.user_description,
        users_additional_info.user_interest,
        users_additional_info.user_hobbies,
        users_additional_info.user_main_profession,
        user_work_experience.company_name,
        user_work_experience.work_description,
        user_work_experience.company_start_date,
        user_work_experience.company_end_date
    FROM 
        users
    INNER JOIN 
        profiles ON users.id = profiles.user_id
    INNER JOIN 
        users_additional_info ON users.id = users_additional_info.user_id
    INNER JOIN 
        user_work_experience ON users.id = user_work_experience.user_id
    WHERE 
        users.id = ?
    ";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Return a single associative array
        } else {
            return null; // No user found
        }
    }
    public function selectUserSkills($user_id)
    {
    }
    public function selectUserWorkExperience($user_id)
    {
    }
    public function selectUserBasicInfo($user_id)
    {
        $sql = "SELECT users.*, profiles.*
                FROM profiles
                INNER JOIN users
                ON profiles.user_id = users.id
                WHERE user_id = ?
                ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Return a single associative array
        } else {
            return null; // No user found
        }
    }
    public function selectUserSavedPost($user_id)
    {
        $SQL = "SELECT COUNT(id) FROM savedpost WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }
    public function selectUserAppliedPost($user_id)
    {
        $SQL = "SELECT COUNT(id) FROM applied_jobs WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }
    public function sendOKNotificationToUser($user_id, $message)
    {
        $SQL = "INSERT INTO notifications (user_id, notification_type, content, is_read, created_at, message_from) VALUES (?, 'OK', ?, FALSE, NOW(), 'System')";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("is", $user_id, $message);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function sendNotOKNotificationToUser($user_id, $message)
    {
        $SQL = "INSERT INTO notifications (user_id, notification_type, content, is_read, created_at, message_from) VALUES (?, 'NOT OK', ?, FALSE, NOW(), 'System')";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("is", $user_id, $message);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUserName($user_id, $username)
    {
        $SQL = "UPDATE users SET username = ? WHERE id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("si", $username, $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePassword($user_id, $password)
    {
        $hashPass = password_hash($password, PASSWORD_DEFAULT);
        $SQL = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("si", $hashPass, $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function selectUserNotification($user_id)
    {
        $SQL = "SELECT * FROM notifications WHERE user_id = ? AND is_read = 0";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $notifications = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $notifications[] = $row;
            }
        }
        return $notifications;
    }
    public function changeNotificationRead($user_id)
    {
        $SQL = "UPDATE notifications SET is_read = TRUE WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUserProfilePicture($user_id, $profile_picture)
    {
        $sql = "UPDATE profiles SET profile_picture = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $profile_picture, $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateCompanyLogo($user_id, $company_logo)
    {
        $sql = "UPDATE employer_profiles SET company_logo = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $company_logo, $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function selectViewUserProfile($user_id)
    {
        $SQL = "SELECT COUNT(id) as view_count FROM profile_views WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return 0;
        }
    }
    // public function insertViewInUserProfile($user_id)
    // {
    //     $SQL = "
    //     INSERT INTO profile_views (user_id, view_count) 
    //     VALUES (1, 1) 
    //     ON DUPLICATE KEY UPDATE view_count = view_count + 1";
    // }
    public function selectExperience($user_id)
    {
        $SQL = "SELECT * FROM user_work_experience WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $experience = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $experience[] = $row;
            }
        }
        return $experience;
    }
    public function insertExperience($user_id, $job_title, $company_name, $work_description, $company_start_date, $company_end_date)
    {
        $SQL = "INSERT INTO user_work_experience (user_id, job_title, company_name, work_description, company_start_date, company_end_date) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("isssss", $user_id, $job_title, $company_name, $work_description, $company_start_date, $company_end_date);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteExperience($user_id)
    {
        $SQL = "DELETE FROM user_work_experience WHERE user_id =?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserResumeFile($user_id)
    {
        $sql = "SELECT * FROM workers_resume WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }
    public function deleteUserResumeFile($user_id)
    {
        $sql = "DELETE FROM workers_resume WHERE user_id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
