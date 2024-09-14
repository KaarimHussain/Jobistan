<?php
include ('./Includes/sessionStart.php');
include ('./Includes/db.php');
include ('./Classes/Base.php');
class AdminData extends Select
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getTotalUsers()
    {
        $sql = "SELECT COUNT(*) as totalUsers FROM users";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['totalUsers'];
    }
    public function getTotalJobs()
    {
        $sql = "SELECT COUNT(*) as totalJobs FROM job_listings";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['totalJobs'];
    }
    public function getTotalCompany()
    {
        $sql = "SELECT COUNT(*) as totalCompanies FROM employer_profiles";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['totalCompanies'];
    }
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users WHERE role = 'worker'";
        $result = $this->conn->query($sql);
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
    public function getAllJobs()
    {
        $sql = "SELECT * FROM job_listings";
        $result = $this->conn->query($sql);
        $jobs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        return $jobs;
    }
    public function getAllCompany()
    {
        $sql = "SELECT * FROM employer_profiles WHERE actions = 'approved'";
        $result = $this->conn->query($sql);
        $companies = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $companies[] = $row;
            }
        }
        return $companies;
    }
    public function getCompanyWithID($user_id)
    {
        $sql = "SELECT * FROM employer_profiles WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function getAllPendingRequests()
    {
        $sql = "SELECT employer_profiles.*,
                users.email
                FROM employer_profiles
                INNER JOIN users ON employer_profiles.user_id = users.id
                WHERE employer_profiles.actions = 'pending'";
        $result = $this->conn->query($sql);
        $companies = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $companies[] = $row;
            }
        }
        return $companies;
    }
    public function getAllbackupUsers()
    {
        $sql = "SELECT * FROM backup_profiles ";
        $result = $this->conn->query($sql);
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
    public function getAllbackupEmploye()
    {
        $sql = "SELECT * FROM backup_employer_profiles ";
        $result = $this->conn->query($sql);
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
}
