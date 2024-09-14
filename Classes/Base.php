<?php
include("./Includes/sessionStart.php");
include("./Includes/db.php");
// include ("./Classes/advanceClass.php");

class Select
{
    private $conn;
    protected $worker = "worker";
    protected $recruiter = "recruiter";
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function SelectAllUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
    public function SelectUserWithID($user_id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function SelectUserWithEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function SelectAllJobsPost()
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
    public function SelectAllUsersWithProfile($user_id)
    {
        $sql = "
        SELECT users.email, users.role, profiles.name, profiles.phone, profiles.address, profiles.profile_picture
        From profiles
        INNER JOIN users
        ON profiles.user_id = users.id
        WHERE users.id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
    public function SelectAllRecruitersWithProfile($user_id)
    {
        $sql = "
        SELECT users.email, users.role, employer_profiles.company_name, employer_profiles.company_logo
        From employer_profiles
        INNER JOIN users
        ON employer_profiles.user_id = users.id
        WHERE users.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
    public function SelectAllJobsWithCompany($clause = '')
    {
        $sql = "
        SELECT 
            job_listings.id AS job_id,
            job_listings.title,
            job_listings.description,
            job_listings.requirements,
            job_listings.location,
            job_listings.job_type,
            job_listings.experience_level,
            job_listings.salary_range,
            job_listings.tags,
            job_listings.created_at,
            job_listings.job_status,
            job_listings.required_candidate,
            employer_profiles.id AS employer_profile_id,
            employer_profiles.user_id,
            employer_profiles.company_name,
            employer_profiles.company_description,
            employer_profiles.company_culture,
            employer_profiles.company_benefits,
            employer_profiles.company_logo
        FROM 
            job_listings
        INNER JOIN 
            employer_profiles 
        ON 
            job_listings.employer_id = employer_profiles.user_id
        ";
        $sql .= $clause;
        $result = $this->conn->query($sql);
        if (!$result) {
            throw new mysqli_sql_exception("Error executing query: " . $this->conn->error);
        }
        $jobs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        return $jobs;
    }
    public function SelectJobsForScheduleInterView($job_id)
    {
        $sql = "
        SELECT 
            job_listings.id AS job_id,
            job_listings.title,
            job_listings.description,
            job_listings.requirements,
            job_listings.location,
            job_listings.job_type,
            job_listings.experience_level,
            job_listings.salary_range,
            job_listings.tags,
            job_listings.created_at,
            employer_profiles.id AS employer_profile_id,
            employer_profiles.user_id,
            employer_profiles.company_name,
            employer_profiles.company_description,
            employer_profiles.company_culture,
            employer_profiles.company_benefits,
            employer_profiles.company_logo
        FROM 
            job_listings
        INNER JOIN 
            employer_profiles 
        ON 
            job_listings.employer_id = employer_profiles.user_id
        WHERE 
            job_listings.id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $job = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $job[] = $row;
            }
        }
        return $job;
    }
    public function SelectJobsWithCompanyWithIDForViewPost($job_id)
    {
        $sql = "
        SELECT 
            job_listings.id AS job_id,
            job_listings.title,
            job_listings.description,
            job_listings.requirements,
            job_listings.location,
            job_listings.job_type,
            job_listings.experience_level,
            job_listings.salary_range,
            job_listings.tags,
            job_listings.created_at,
            employer_profiles.id AS employer_profile_id,
            employer_profiles.user_id,
            employer_profiles.company_name,
            employer_profiles.company_description,
            employer_profiles.company_culture,
            employer_profiles.company_benefits,
            employer_profiles.company_logo
        FROM 
            job_listings
        INNER JOIN 
            employer_profiles 
        ON 
            job_listings.employer_id = employer_profiles.user_id
        WHERE 
            job_listings.id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function SelectJobsWithCompanyWithID($user_id)
    {
        $sql = "
        SELECT 
            job_listings.id AS job_id,
            job_listings.title,
            job_listings.description,
            job_listings.requirements,
            job_listings.location,
            job_listings.job_type,
            job_listings.experience_level,
            job_listings.salary_range,
            job_listings.tags,
            job_listings.created_at,
            employer_profiles.id AS employer_profile_id,
            employer_profiles.user_id,
            employer_profiles.company_name,
            employer_profiles.company_description,
            employer_profiles.company_culture,
            employer_profiles.company_benefits,
            employer_profiles.company_logo
        FROM 
            job_listings
        INNER JOIN 
            employer_profiles 
        ON 
            job_listings.employer_id = employer_profiles.user_id
        WHERE 
            employer_profiles.user_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $job = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $job[] = $row;
            }
        }
        return $job;
    }
    public function FilterJobsBySalary($salaryFilters)
    {
        $salaryClauses = [];
        foreach ($salaryFilters as $salary) {
            $salaryClauses[] = "salary_range >= " . intval($salary) * 1000;
        }
        $salaryClause = implode(" OR ", $salaryClauses);
        $sql = "SELECT * FROM job_listings JOIN employer_profiles ON job_listings.id = employer_profiles.id WHERE ($salaryClause)";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    public function InsertWorker($username, $email, $password, $role, $phone, $address, $picture)
    {
        if ($this->InsertUsers($username, $email, $password, $role)) {
            $profilePicturePath = $this->handleFileUpload($picture);
            if ($profilePicturePath === false) {
                $_SESSION['register_error'] = "Failed to upload profile picture.";
                return false;
            }

            $sql = "INSERT INTO profiles (user_id, name, phone, address, profile_picture, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $this->conn->prepare($sql);
            $userId = $this->conn->insert_id; // Get the last inserted user ID
            $stmt->bind_param("issss", $userId, $username, $phone, $address, $profilePicturePath);
            if ($stmt->execute()) {
                return true;
            } else {
                $_SESSION['register_error'] = "Failed to Insert Profile Data. Please try again!";
                return false;
            }
        } else {
            return false;
        }
    }
    public function insertMainProfession($user_id, $mainProfession)
    {
        $sql = "INSERT INTO users_additional_info (user_id, user_main_profession) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $mainProfession);
        if ($stmt->execute()) {
            return true;
        } else {
            $_SESSION['register_error'] = "Error: " . $stmt->error();
            return false;
        }
    }
    public function InsertCompany($username, $email, $password, $role, $company_name, $company_culture, $company_description, $company_benefits, $company_logo)
    {
        if ($this->InsertUsersForCompany($username, $email, $password, $role)) {
            $companyLogoPath = $this->handleFileUpload($company_logo);
            if ($companyLogoPath === false) {
                $companyLogoPath = null; // Set to null if the upload fails or no file is uploaded
            }

            $sql = "INSERT INTO employer_profiles (user_id, company_name, company_description, company_culture, company_benefits, company_logo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $userId = $this->conn->insert_id; // Get the last inserted user ID
            $stmt->bind_param("isssss", $userId, $company_name, $company_description, $company_culture, $company_benefits, $companyLogoPath);

            if ($stmt->execute()) {
                return true;
            } else {
                $_SESSION['register_error'] = mysqli_error($stmt);
                return false;
            }
        } else {
            $_SESSION['register_error'] = "Failed to Insert Company Information";
            return false;
        }
    }
    public function InsertUsersForCompany($username, $email, $password, $role)
    {
        if ($this->IfUserExist($email) == false) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password, role, created_at) VALUES (?,?,?,?,NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
            if ($stmt->execute()) {
                include('./Classes/mailing.php');
                $mail = new Mailing($conn);
                $mail->sendMailToSenderForApproval('JOBISTAN', $email, 'Jobistan Approval Team');
                $_SESSION['info_sucessfull'] = 'Your account will be verified within two business days. You will be notified via the email address you provided!';
                $stmt->close();
                return true;
            } else {
                $_SESSION['register_error'] = mysqli_error($stmt);
                $stmt->close();
                return false;
            }
        } else {
            $_SESSION['register_error'] = "This email is already exist. Please try another one!";
            return false;
        }
    }
    public function InsertUsers($username, $email, $password, $role)
    {
        if ($this->IfUserExist($email) == false) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password, role, created_at) VALUES (?,?,?,?,NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
            if ($stmt->execute()) {
                $_SESSION['logged'] = array(
                    'id' => $stmt->insert_id,
                    'username' => $username,
                    'email' => $email,
                    'role' => $role
                );
                $stmt->close();
                return true;
            } else {
                $_SESSION['register_error'] = mysqli_error($stmt);
                $stmt->close();
                return false;
            }
        } else {
            $_SESSION['register_error'] = "This email is already exist. Please try another one!";
            return false;
        }
    }
    public function IfUserExist($email)
    {
        $existUser = null;
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $existUser = true;
        } else {
            $existUser = false;
        }
        $stmt->close();
        return $existUser;
    }
    public function handleFileUpload($file)
    {
        $_SESSION['loggedFile'] = $file || "No File was reached";
        // Check for empty file upload
        if (empty($file["name"])) {
            return null; // Or some default value if no file uploaded
        }
        if ($targetDir = "UserUploads/") {
            if ($filename = basename($file["name"])) {
                if ($targetFile = $targetDir . $filename) {
                    if ($tmpFile = $file['tmp_name']) {
                        if (move_uploaded_file($tmpFile, $targetFile)) {
                            return $targetFile;
                        } else {
                            $_SESSION['loggedFileError'] = "Could not move file to upload directory";
                            return false;
                        }
                    } else {
                        $_SESSION['loggedFileError'] = "Couldn't set temporary file name";
                        return false;
                    }
                } else {
                    $_SESSION['loggedFileError'] = "Couldn't able to set file target directory";
                    return false;
                }
            } else {
                $_SESSION['loggedFileError'] = "Couldn't able to fetch file name";
                return false;
            }
        } else {
            $_SESSION['loggedFileError'] = "Could not find the target directory to upload";
            return false;
        }
    }
    public function fetchPostSalaryGreaterThan20k()
    {
        $sql = "
            SELECT 
                job_listings.id AS job_id,
                job_listings.title,
                job_listings.description,
                job_listings.requirements,
                job_listings.location,
                job_listings.job_type,
                job_listings.experience_level,
                job_listings.salary_range,
                job_listings.tags,
                job_listings.created_at,
                employer_profiles.id AS employer_profile_id,
                employer_profiles.user_id,
                employer_profiles.company_name,
                employer_profiles.company_description,
                employer_profiles.company_culture,
                employer_profiles.company_benefits,
                employer_profiles.company_logo
            FROM 
                job_listings
            INNER JOIN 
                employer_profiles 
            ON 
                job_listings.employer_id = employer_profiles.user_id
            WHERE salary_range >= 20000 LIMIT 4
        ";
        $result = $this->conn->query($sql);
        $jobs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        return $jobs;
    }
    public function fetchPostLatestJob()
    {
        $sql = "
            SELECT 
                job_listings.id AS job_id,
                job_listings.title,
                job_listings.description,
                job_listings.requirements,
                job_listings.location,
                job_listings.job_type,
                job_listings.experience_level,
                job_listings.salary_range,
                job_listings.tags,
                job_listings.created_at,
                employer_profiles.id AS employer_profile_id,
                employer_profiles.user_id,
                employer_profiles.company_name,
                employer_profiles.company_description,
                employer_profiles.company_culture,
                employer_profiles.company_benefits,
                employer_profiles.company_logo
            FROM 
                job_listings
            INNER JOIN 
                employer_profiles 
            ON 
                job_listings.employer_id = employer_profiles.user_id
            ORDER BY created_at DESC LIMIT 3
        ";
        $result = $this->conn->query($sql);
        $jobs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        return $jobs;
    }
    public function forgetPasswordRecover($recovery_email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $recovery_email);
        try {
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
            } else {
                $_SESSION['recover_error'] = "This email is not exist";
                return false;
            }
        } catch (Exception $e) {
            $_SESSION['recover_error'] = $e->getMessage();
            return false;
        }
    }
    public function getUserAccountVisibility($user_id)
    {
        $SQL = "SELECT account_visibility FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['account_visibility'];
    }
    public function changeUserAccountVisibility($user_id, $visibility)
    {
        $sql = "UPDATE users SET account_visibility = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $visibility, $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserResumeVisibility($user_id)
    {
        $SQL = "SELECT visibility FROM workers_resume WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['visibility'] ?? FALSE;
    }
    public function changeUserResumeVisibility($user_id, $visibility)
    {
        $sql = "UPDATE workers_resume SET visibility = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $visibility, $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserResumeData($user_id)
    {
        $sql = "SELECT * FROM workers_resume WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getWorkerForCompany()
    {
        $SQL =
            "SELECT users.id as user_id,
            profiles.name, profiles.profile_picture
            FROM users
            INNER JOIN profiles
            ON users.id = profiles.user_id
            WHERE users.role = 'worker'";
        $result = $this->conn->query($SQL);
        $jobs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        return $jobs;
    }
    public function getWorkerForCompanyWithAJAX($filterQuery)
    {
        $SQL =
            "SELECT users.id as user_id, profiles.name, users_additional_info.user_main_profession, profiles.profile_picture
            FROM users
            INNER JOIN profiles
            ON users.id = profiles.user_id
            INNER JOIN users_additional_info 
            ON users.id = users_additional_info.user_id
            WHERE users.role = 'worker'
            " . $filterQuery;
        $result = $this->conn->query($SQL);
        $jobs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        return $jobs;
    }
    public function getCompanyForWorker($filters)
    {

        $SQL = "SELECT * FROM employer_profiles " . $filters;
        $stmt = $this->conn->prepare($SQL);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getCompaniesWithNameAJAX($companyName)
    {
        $filteredCompanyName = '';
        if (!empty($companyName)) {
            $filteredCompanyName = " WHERE company_name LIKE '%$companyName%'";
        }
        $SQL = "SELECT * FROM employer_profiles" . $filteredCompanyName;
        $result = $this->conn->query($SQL);
        $jobs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        return $jobs;
    }
    public function selectCompanyWithProfiles($user_id)
    {
        $SQL = "SELECT employer_profiles.id as company_id, employer_profiles.company_name, employer_profiles.company_description, employer_profiles.company_logo, employer_profiles.company_benefits, employer_profiles.company_culture, users.id as user_id, users.username,users.created_at
        FROM employer_profiles
        INNER JOIN users
        ON employer_profiles.user_id = users.id
        WHERE employer_profiles.user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function selectCompanyForProfilesWithID($user_id)
    {
        $SQL = "SELECT employer_profiles.id as company_id, employer_profiles.company_name, employer_profiles.company_description, employer_profiles.company_logo, employer_profiles.company_benefits, employer_profiles.company_culture, users.id as user_id, users.username,users.created_at
        FROM employer_profiles
        INNER JOIN users
        ON employer_profiles.user_id = users.id
        WHERE employer_profiles.user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function selectCompanyWithIDSettings($user_id)
    {
        $SQL = "SELECT employer_profiles.id as company_id, employer_profiles.company_name, employer_profiles.company_description, employer_profiles.company_logo, employer_profiles.company_benefits, employer_profiles.company_culture, users.id as user_id, users.created_at
        FROM employer_profiles
        INNER JOIN users
        ON employer_profiles.user_id = users.id
        WHERE employer_profiles.user_id = ?
        ";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function insertDataIntoJobListing($user_id, $title, $description, $requirement, $location, $jobType, $experience, $salary, $tags, $required_candidate)
    {
        $SQL = "INSERT INTO job_listings(employer_id, title, description, requirements,location,job_type,experience_level,salary_range,tags,created_at,job_status,required_candidate) VALUES
        (?,?,?,?,?,?,?,?,?,NOW(), 'open',?) ";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("isssssssss", $user_id, $title, $description, $requirement, $location, $jobType, $experience, $salary, $tags, $required_candidate);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getSavedPostRatio($user_id, $job_id)
    {
        $SQL = "SELECT * FROM savedpost WHERE user_id = ? AND job_listing_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ii", $user_id, $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function handleCompaniesAppliedJobs($user_id, $job_id)
    {
        $SQL = "INSERT INTO applied_jobs (user_id, job_id,applied_at) VALUES (?,?,NOW())";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ii", $user_id, $job_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function insertIntoAppliedJobs($user_id, $job_id)
    {
        $SQL = "INSERT INTO applied_jobs (user_id,job_id) VALUES (?,?)";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ii", $user_id, $job_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getMoreSimilarJobs($job_title)
    {
        $SQL = "SELECT 
                job_listings.id AS job_id,
                job_listings.title,
                job_listings.description,
                job_listings.requirements,
                job_listings.location,
                job_listings.job_type,
                job_listings.experience_level,
                job_listings.salary_range,
                job_listings.tags,
                job_listings.created_at,
                employer_profiles.id AS employer_profile_id,
                employer_profiles.user_id,
                employer_profiles.company_name,
                employer_profiles.company_description,
                employer_profiles.company_culture,
                employer_profiles.company_benefits,
                employer_profiles.company_logo
            FROM 
                job_listings
            INNER JOIN 
                employer_profiles 
            ON 
                job_listings.employer_id = employer_profiles.user_id
            WHERE job_listings.title = ?
            LIMIT 7";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("s", $job_title);
        $stmt->execute();
        $result = $stmt->get_result();
        $jobs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        return $jobs;
    }
    public function fetchUserSavedPostByID($user_id)
    {
        $SQL = "SELECT 
                job_listings.id AS job_id,
                job_listings.title,
                job_listings.description,
                job_listings.requirements,
                job_listings.location,
                job_listings.job_type,
                job_listings.experience_level,
                job_listings.salary_range,
                job_listings.tags,
                job_listings.created_at,
                savedpost.id AS saved_post_id,
                savedpost.job_listing_id,
                savedpost.user_id
            FROM
                job_listings
            INNER JOIN
                savedpost
            ON 
                job_listings.id = savedpost.job_listing_id
            WHERE savedpost.user_id = ?
                ";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $post = [];
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $post[] = $row;
            }
        }
        return $post;
    }
    public function fetchUserAppliedPostByID($user_id)
    {
        $SQL = "SELECT
                job_listings.id AS job_id,
                job_listings.title,
                job_listings.description,
                job_listings.requirements,
                job_listings.location,
                job_listings.job_type,
                job_listings.experience_level,
                job_listings.salary_range,
                job_listings.tags,
                job_listings.created_at,
                applied_jobs.id AS applied_job_id,
                applied_jobs.user_id,
                applied_jobs.job_id,
                applied_jobs.applied_at,
                employer_profiles.company_logo,
                employer_profiles.company_name,
                employer_profiles.user_id
            FROM
                job_listings
            INNER JOIN
                applied_jobs
            INNER JOIN
                employer_profiles
            ON
                job_listings.id = applied_jobs.job_id
            AND employer_profiles.user_id = job_listings.employer_id
            WHERE applied_jobs.user_id = ?
                ";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $post = [];
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $post[] = $row;
            }
        }
        return $post;
    }
    public function getUserAdditionInfoByID($user_id)
    {
        $SQL = "SELECT * FROM users_additional_info WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    public function updateMainProfession($user_id, $main_profession)
    {
        $SQL = "UPDATE users_additional_info SET user_main_profession = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("si", $main_profession, $user_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updateHobby($user_id, $hobby)
    {
        $SQL = "UPDATE users_additional_info SET user_hobbies = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("si", $hobby, $user_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updateInterest($user_id, $interest)
    {
        $SQL = "UPDATE users_additional_info SET user_interest = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("si", $interest, $user_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updateDescription($user_id, $description)
    {
        $SQL = "UPDATE users_additional_info SET user_description = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("si", $description, $user_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function timeAgo($date)
    {
        // Set the timezone to be consistent
        $timezone = new DateTimeZone('Asia/Karachi'); // or replace with your desired timezone
        // Create DateTime objects with the same timezone
        $created_at = new DateTime($date, $timezone);
        $now = new DateTime('now', $timezone);

        $interval = $now->diff($created_at);

        if ($interval->y > 0) {
            return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
        } elseif ($interval->m > 0) {
            return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
        } elseif ($interval->d > 0) {
            return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
        } elseif ($interval->h > 0) {
            return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
        } elseif ($interval->i > 0) {
            return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
        } else {
            return $interval->s . ' second' . ($interval->s > 1 ? 's' : '') . ' ago';
        }
    }
    public function checkAppliedRatio($user_id, $job_id)
    {
        $SQL = "SELECT * FROM applied_jobs WHERE user_id = ? AND job_id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ii", $user_id, $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function showJobStatus($job_id)
    {
        $SQL = "SELECT * FROM job_listings WHERE id = ?";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
}
