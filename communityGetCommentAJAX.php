<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include ('./Includes/db.php');
    $id = $_POST['comm_id'];
    include ('./Classes/Community.php');
    include ('./Classes/Base.php');
    $base = new Select($conn);
    $comData = new Community($conn);
    $comment = $comData->fetchCommentsWithUserDataForPostWithID($id);
    if (!empty($comment)) {
        foreach ($comment as $comm) {
            ?>
            <div class="col-12 d-flex gap-2 mb-3">
                <?php
                if (!empty($comm['profile_picture']) || $comm['profile_picture'] != null) {
                    echo '<img src="' . $comm['profile_picture'] . '" height="40px" width="40px" class="rounded-circle object-fit-cover object-position-center">';
                } else if (!empty($comm['company_logo']) || $comm['company_logo'] != null) {
                    echo '<img src="' . $comm['company_logo'] . '" height="40px" width="40px" class="rounded-circle object-fit-cover object-position-center">';
                }
                ?>
                <div class="optional-bg rounded-2 p-3 w-100">
                    <div class="d-flex flex-column pb-2 pt-1">
                        <span class="fw-bold"><?php echo $comm['username']; ?></span>
                        <smallcclass= class="text-muted"><?php echo $base->timeAgo($comm['created_at']); ?> <i
                                class="bi bi-globe-americas"></i></small>
                    </div>
                    <small><?php echo nl2br(htmlspecialchars($comm['comment_text'])); ?></small>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <h4 class="fw-bold optional-color text-center">No Comment Avaliable</h4>
        <?php
    }
} else {
    header("Location: index.php");
    exit();
}
