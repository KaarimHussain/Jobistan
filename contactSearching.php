<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
include('./Classes/Chatting.php');
$chatting = new Chatting($conn);
$searchBar = $_POST['search'];
$chat = $chatting->SelectAllUserWithProfileForAJAX($searchBar);
if (!empty($chat)) {
    foreach ($chat as $row) {
        $recentMessage = $chatting->getRecentMessage($_SESSION['logged']['id'], $row['id']);
        if ($row['id'] == $_SESSION['logged']['id']) {
            continue;
        } else {
?>
            <a href="./chattingAreaMessages.php?reciver_id=<?php echo $row['id']; ?>" class="d-flex text-decoration-none gap-3 mb-3 align-items-center contact-list">
                <div>
                    <img src="<?php echo $row['profile_picture']; ?>" height="50px" width="50px" class="rounded-circle object-fit-cover object-position-center" alt="<?php echo $row['username']; ?>">
                </div>
                <div class="d-flex flex-column">
                    <h5 class="semibold text-white"><?php echo $row['username']; ?></h5>
                    <small class="optional-color">
                        <?php
                        if (!empty($recentMessage)) {
                            $decryptRecent = $chatting->decryptMessage($recentMessage['messages']);
                            echo $decryptRecent;
                        } else {
                            echo "Inbox";
                        }
                        ?>
                    </small>
                </div>
            </a>
<?php
        }
    }
} else {
    echo "<p class='text-center text-white'>No contacts found.</p>";
}
?>