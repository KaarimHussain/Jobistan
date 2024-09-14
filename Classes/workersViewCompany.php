<?php
include ('./Includes/db.php');
include ('./Includes/sessionStart.php');
include ('./Interfaces/Workers.php');
class WorkerForCompany implements IWorker
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function fetchWorkerWithID($user_id)
    {
        $SQL = "SELECT 
        profiles.*,
        users.*
        FROM profiles
        INNER JOIN users
        ON profiles.user_id = users.id
        WHERE users.id = ?
        ";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function fetchWorkerSkills($user_id)
    {
        $SQL = "SELECT * FROM user_skills WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function fetchWorkerProjectLinks($user_id)
    {
        $SQL = "SELECT * FROM user_projects_links WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function fetchWorkerExperience($user_id)
    {
        $SQL = "SELECT * FROM user_work_experience WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function fetchWorkerPortfolioLink($user_id)
    {
        $SQL = "SELECT * FROM user_portfolio_links WHERE user_id =?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function fetchUserAdditionalInfo($user_id)
    {
        $SQL = "SELECT * FROM users_additional_info WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function checkWorkerViewExistWithCompanyID($company_id, $user_id)
    {
        $SQL = "SELECT * FROM profile_views WHERE company_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $company_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return false;
        } else {
            $SQL = "INSERT INTO profile_views (company_id, user_id) VALUES(?,?)";
            $stmt = $this->conn->prepare($SQL);
            $stmt->bind_param("ii", $company_id, $user_id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}
