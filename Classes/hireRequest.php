<?php
include('./Includes/sessionStart.php');
include('./Includes/db.php');
class HireRequest
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function selectHiringHistoryForView($emp_id, $job_id)
    {
        $sql = "SELECT
        hired_history.hired_at,
        job_listings.id AS job_id,
        job_listings.title AS job_title,
        users.username AS user_username,
        users.email AS user_email
    FROM
        hired_history
    INNER JOIN job_listings ON hired_history.job_id = job_listings.id
    INNER JOIN users ON hired_history.user_id = users.id
    WHERE
        hired_history.emp_id = ? AND hired_history.job_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $emp_id, $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $row;
    }
    public function selectHiringHistoryWithUserID($emp_id, $job_id)
    {
        $sql = 'SELECT * FROM hired_history WHERE job_id = ? AND emp_id  =?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $job_id, $emp_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }
    public function insertIntoHiredHistory($worker_id, $job_id, $emp_id)
    {
        $sql = 'INSERT INTO hired_history (user_id, job_id, emp_id, hired_at) VALUES(?,?,?,NOW())';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $worker_id, $job_id, $emp_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function ifUserHiredExist($job_id, $worker_id)
    {
        $sql = "SELECT * FROM hired_history WHERE job_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $job_id, $worker_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }
    public function changeRequiredCandidateCount($job_id)
    {
        $sql = "UPDATE job_listings SET required_candidate = required_candidate - 1 WHERE id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
