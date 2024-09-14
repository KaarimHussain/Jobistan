<?php
include ('./Includes/sessionStart.php');

if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sender_id = $_SESSION['logged']['id'];
    $receiver_id = $_POST['receiver_id'];
    include ('./Includes/db.php');
    include ('./Classes/Chatting.php');
    $chat = new Chatting($conn);
    $response = $chat->getCompanyMessage($sender_id, $receiver_id);
    // print_r($response);
    if (!empty($response)) {
        foreach ($response as $row) {
            $mes = (string) $row['messages'];
            $row['created_at'] = strtotime($row['created_at']);
            $datetime = date('d, Y \a\t h:i A', $row['created_at']);
            if ($row['sender_id'] == $sender_id) {
                // Message sent by the current user
                ?>
                <div class="col-12 mb-3 d-flex justify-content-start">
                    <div class="myMessage py-3 align-items-center">
                        <div class="d-flex flex-column">
                            <div class="text-start">
                                <span>
                                    <?php
                                    echo nl2br(htmlspecialchars($mes));
                                    ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <small class="secondary-color text-start">
                                    <?php echo $datetime; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else if ($row['sender_id'] == $receiver_id) {
                // Message sent by the recipient
                ?>
                    <div class="col-12 mb-3 d-flex justify-content-end">
                        <div class="friendMessage py-3 align-items-center">
                            <div class="d-flex flex-column">
                                <div class="text-start">
                                    <span>
                                        <?php
                                        echo nl2br(htmlspecialchars($mes));
                                        ?>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <small class="optional-color text-end">
                                    <?php echo $datetime; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php
            }
        }
    } else {
        $role = $_SESSION['logged']['role'];
        echo "
        <h6 class='text-center text-white'> <i class='bi bi-info-circle-fill'></i> No Response Found yet!</h6>";
        if ($role === 'worker') {
            ?>
            <small class='text-center optional-color'>Once the recruiters has scheduled you for an interview you will see recruiter
                responses.</small>
            <?php
        } else if ($role === 'recruiter') {
            ?>
                <small class='text-center optional-color'>There is no Response from the Worker!</small>
            <?php
        } else {
            echo "<small class='text-center optional-color'>No Message Found</small>";
        }
    }
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>