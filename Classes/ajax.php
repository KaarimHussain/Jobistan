<?php
include ('./Includes/db.php');
include ('./Includes/sessionStart.php');

class SideScripts
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getNotificationCount($user_id)
    {
        $sql = "SELECT count(id) as notification_count from notifications where is_read = false and user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id); // Use bind_param to avoid SQL injection
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['notification_count']; // Return the count value directly
    }
}
