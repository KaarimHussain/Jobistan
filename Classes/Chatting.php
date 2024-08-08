<?php
include('./Includes/sessionStart.php');
include('./Includes/db.php');
include('./Classes/Base.php');
class Chatting
{
    private $conn;
    public string $encKey = "JetEngine";
    private $ciphering = "AES-128-CTR";
    private $options = 0;
    private $iv = "1234567891011121";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function SelectAllUserWithProfile()
    {
        $sql = "
        SELECT users.id, users.username, users.email, users.role, users.account_visibility, profiles.profile_picture
        FROM users
        INNER JOIN profiles
        where users.id = profiles.user_id
        ";
        $stmt = $this->conn->prepare($sql);
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
    public function SelectAllUserWithProfileForAJAX($searchInput)
    {
        $filterQuery = "";
        $paramType = "";
        $paramValues = [];

        if (!empty($searchInput)) {
            $filterQuery = "AND (users.username LIKE ?)";
            $paramType .= "s";
            $paramValues[] = '%' . $searchInput . '%';
        }

        // Prepare the final SQL statement
        $sql = "SELECT users.id, users.username, users.email, users.role, users.account_visibility, profiles.profile_picture
        FROM users
        INNER JOIN profiles ON users.id = profiles.user_id
        WHERE 1=1 $filterQuery";

        // Prepare and execute the statement
        $stmt = $this->conn->prepare($sql);

        // Check if there are any parameters to bind
        if (!empty($paramValues)) {
            $stmt->bind_param($paramType, ...$paramValues);
        }
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

    public function getRecentMessage($sender_id, $receiver_id)
    {
        $SQL = "SELECT * FROM messages 
            WHERE (sender_id = ? AND receiver_id = ?) 
               OR (sender_id = ? AND receiver_id = ?) 
            ORDER BY id DESC 
            LIMIT 1";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $sender_id, $receiver_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function encryptMessage($data)
    {

        $encrypt = openssl_encrypt($data, $this->ciphering, $this->encKey, $this->options, $this->iv);
        return $encrypt;
    }

    public function decryptMessage($encryptedData)
    {
        $decrypt = openssl_decrypt($encryptedData, $this->ciphering, $this->encKey, $this->options, $this->iv);
        return $decrypt;
    }
}
