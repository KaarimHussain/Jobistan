<?php
include ('./Includes/sessionStart.php');
include ('./Includes/db.php');
class Startup
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function checkAdditionalInfoExist($user_id): bool
    {
        $sql = "SELECT * FROM users_additional_info WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id); // Use bind_param to avoid SQL injection
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function insertIntoAdditionalInfo($user_id, $description, $interest, $hobbies, $mainProfession)
    {
        $sql = "INSERT INTO users_additional_info(user_id,user_description,user_interest,user_hobbies,user_main_profession) VALUES(?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $description, $interest, $hobbies, $mainProfession);
        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }
}