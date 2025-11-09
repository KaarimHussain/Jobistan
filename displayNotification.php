<?php
include ('./Includes/db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Classes/advanceClass.php');
    include ('./Includes/db.php');

    $user_id = $_SESSION['logged']['id'];
    $displayNotification = new advanceClass($conn);
    $notificationData = $displayNotification->selectUserNotification($user_id);
    if (!empty($notificationData)) {
        foreach ($notificationData as $notification) {
            ?>
            <div class="col-12 my-2">
                <?php
                if (isset($notification['notification_type'])) {
                    if ($notification['notification_type'] == 'OK') {
                        ?>
                        <div class="notificationSuccess d-flex align-items-center gap-3">
                            <div id="icon">
                                <?php
                                if ($notification['message_from'] == 'System') {
                                    ?>
                                    <i class="bi bi-cpu"></i>
                                    <?php
                                }
                                if ($notification['message_from'] == 'User') {
                                    ?>
                                    <i class="bi bi-person"></i>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span><?php echo $notification['message_from']; ?></span>
                                <small class="text-white"><?php echo $notification['content']; ?></small>
                            </div>
                        </div>
                        <?php
                    } else if ($notification['notification_type'] == 'NOT OK') {
                        ?>
                            <div class="notificationError d-flex align-items-center gap-3">
                                <div id="icon">
                                    <?php
                                    if ($notification['message_from'] == 'System') {
                                        ?>
                                        <i class="bi bi-cpu"></i>
                                    <?php
                                    }
                                    if ($notification['message_from'] == 'User') {
                                        ?>
                                        <i class="bi bi-person"></i>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="d-flex justify-content-center flex-column">
                                    <span><?php echo $notification['message_from']; ?></span>
                                    <small class="text-white"><?php echo $notification['content']; ?></small>
                                </div>
                            </div>
                        <?php
                    }
                }
        }
        ?>
        </div>
        <?php
    } else {
        ?>
        <div class="col-12 my-2">
            <div class="notificationDefault d-flex flex-column align-items-center gap-3">
                <div id="icon">
                    <i class="bi bi-archive-fill text-white"></i>
                </div>

                <div class="d-flex flex-column justify-content-center">
                    <small class="text-white">No Unread Notification Found</small>
                </div>
            </div>
        </div>
        <?php
    }

} else {
    header("Location: index.php");
    exit();
}
?>