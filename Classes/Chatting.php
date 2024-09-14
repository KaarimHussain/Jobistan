<?php
include ('./Includes/sessionStart.php');
include ('./Includes/db.php');
include ('./Classes/Base.php');
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
    public function getCompanyMessage($sender_id, $receiver_id)
    {
        $SQL = "SELECT * FROM UsersInbox WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $chats = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $chats[] = $row;
            }
        }
        return $chats;
    }
    // timestamp to a human-readable format
    public function formatDateTime($datetime)
    {
        $strDate = strtotime($datetime);
        return date('l, F d, Y \a\t h:i A', $strDate);
    }
    // timestamp that formats only the date
    public function formatDate($datetime)
    {
        $strDate = strtotime($datetime);
        return date('d, Y \a\t h:i A', $strDate);
    }
    public function isAllowToMessage($sender_id, $receiver_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM UsersInbox WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)");
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function insertIntoInboxMessage($message, $receiver_id, $sender_id)
    {
        $seenVal = 1;
        if ($_SESSION['logged']['role'] == 'recruiter') {
            $seenVal = 0; // If it's a recruiter, mark the message as seen by default.
            // Add your logic to handle different roles here if needed. For example, if a recruiter receives a message, mark the message as seen by default for all other users in the company.
        }
        $SQL = "INSERT INTO UsersInbox(messages,sender_id,receiver_id,seen) VALUES(?, ?, ?, $seenVal)";
        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("sii", $message, $sender_id, $receiver_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // In your Select class
    public function checkForNewMessages($user_id, $sender_id)
    {
        $stmt = $this->conn->prepare("
        SELECT COUNT(*) AS new_messages 
        FROM UsersInbox 
        WHERE (receiver_id = ? AND sender_id = ?) AND seen = 0
    ");
        $stmt->bind_param("ii", $user_id, $sender_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['new_messages'];
    }

    public function markMessagesAsSeen($sender_id, $receiver_id)
    {
        $stmt = $this->conn->prepare("
        UPDATE UsersInbox 
        SET seen = 1 
        WHERE ((sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)) AND seen = 0
    ");
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
        $stmt->execute();
        $stmt->close();
    }



}
