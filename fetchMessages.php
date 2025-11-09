<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
include ('./Includes/db.php');
include ('./Classes/Chatting.php');
$chattingData = new Chatting($conn);
$reciver_id = $_POST['reciver_id'];
$sender_id = $_POST['sender_id'];

// 
$query = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('iiii', $sender_id, $reciver_id, $reciver_id, $sender_id);
$stmt->execute();
$result = $stmt->get_result();
// 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mes = (string) $row['messages'];
        $message = $chattingData->decryptMessage($mes);
        if ($row['sender_id'] == $sender_id) {
            // Message sent by the current user
            ?>
            <div class="col-12 mb-3 d-flex justify-content-start">
                <div class="myMessage">
                    <span>
                        <?php
                        echo htmlspecialchars($message);
                        ?>
                    </span>
                </div>
            </div>
            <?php
        } else if ($row['sender_id'] == $reciver_id) {
            // Message sent by the recipient
            ?>
                <div class="col-12 mb-3 d-flex justify-content-end">
                    <div class="friendMessage">
                        <span>
                            <?php
                            echo htmlspecialchars($message);
                            ?>
                        </span>
                    </div>
                </div>
            <?php
        }
    }
    $stmt->close();
    $conn->close();
} else {
    echo "<div class='col-12 py-3 optional-color fw-bold text-center'>No new messages.</div>";
}
?>