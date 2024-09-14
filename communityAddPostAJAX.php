<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include('./Classes/Community.php');
    include('./Classes/Base.php');
    include('./Includes/db.php');
    $base = new Select($conn);
    $communityData = new Community($conn);
    $community = $communityData->fetchAllCommunityPosts();
    $user_id = $_SESSION['logged']['id'];

    if (!empty($community)) {
        foreach ($community as $row) {
            $myProfilePicture = $base->SelectAllUsersWithProfile($user_id);
            $userName = $base->SelectUserWithID($row['user_id']);
            $userProfile = $base->SelectAllUsersWithProfile($row['user_id']);
            $companyProf = $base->selectCompanyForProfilesWithID($row['user_id']);
            $userMainProf = $base->getUserAdditionInfoByID($row['user_id']);
            $likesCount = $communityData->fetchLikeCount($row['id']);
            $comment_count = $communityData->fetchCommentCount($row['id']);
            // $likeState = $communityData->getLikeState($user_id, $row['id']);
            $created_at = $base->timeAgo($row['created_at']);
            ?>
            <div class="col-12 mb-4">
                <div class="bg-white rounded-2 py-3 px-4">
                    <div class="d-flex gap-2 align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <?php
                            if (!empty($userProfile) && !empty($userProfile[0]['profile_picture'])) {
                                echo '<img src="' . $userProfile[0]['profile_picture'] . '" height="40px" width="40px" class="rounded-circle object-fit-cover object-position-none">';
                            } else if (!empty($companyProf) && !empty(['company_logo'])) {
                                echo '<img src="' . $companyProf['company_logo'] . '" height="40px" width="40px" class="rounded-circle object-fit-cover object-position-none">';
                            } else {
                                // add the default profile icon of bootstrap icon
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 1 0-14 0 7 7 0 0 0 14 0z"/>
                                </svg>';
                            }
                            ?>
                            <!--                             
                            <img src="<?php echo htmlspecialchars($userProfile[0]['profile_picture']) ?>" height="60px" width="60px"
                                alt="Profile Picture"
                                class="rounded-circle object-fit-cover object-position-center border border-dark"> -->
                            <!--  -->
                            <div class="d-flex flex-column">
                                <span class="fw-bold">
                                    <?php echo htmlspecialchars($userName['username']); ?>
                                </span>
                                <?php if (isset($userMainProf['user_main_profession'])) { ?>
                                    <small
                                        class="text-muted"><?php echo htmlspecialchars($userMainProf['user_main_profession']); ?></small>
                                <?php } ?>
                                <small class="fw-light text-xs"><?php echo $created_at; ?> <i
                                        class="bi bi-globe-americas"></i></small>
                            </div>
                        </div>
                    </div>
                    <hr class="primary-color">
                    <div class="my-3">
                        <p class="fw-normal text-wrap" style="word-wrap: break-word; overflow-wrap: break-word;">
                            <?php echo nl2br(htmlspecialchars_decode(htmlspecialchars($row['post_content'], ENT_QUOTES))); ?>
                        </p>

                    </div>
                    <?php if ($row['post_image'] !== null && !empty($row['post_image'])) { ?>
                        <div class="my-1 p-1">
                            <img src="<?php echo htmlspecialchars($row['post_image']); ?>"
                                class="img-fluid rounded-3 object-fit-cover object-position-center" alt="<?php echo $row['id']; ?>">
                        </div>
                    <?php } ?>
                    <hr class="primary-color">
                    <div class="my-3 d-flex justify-content-between align-items-center">
                        <!-- <small><?php #echo $likesCount; 
                                    ?> Likes</small> -->
                        <small><?php echo $comment_count; ?> Comments</small>
                    </div>
                    <a class="d-flex align-items-center gap-2 text-decoration-none secondary-color cursor-pointer"
                        data-bs-toggle="collapse" href="#collapseComments<?php echo $row['id']; ?>" role="button"
                        aria-expanded="false" aria-controls="collapseComments<?php echo $row['id']; ?>">
                        <i class="bi bi-chat-left-quote"></i>
                        <span>Comment</span>
                    </a>
                </div>
                <div class="collapse" id="collapseComments<?php echo $row['id']; ?>">
                    <div class="card border-0 card-body">
                        <div style="height: 30vh; overflow-y: auto; overflow-x: hidden;" class="px-4">
                            <div class="row">
                                <div class="col-12 d-flex gap-2 align-items-center mb-3">
                                    <?php if (!empty($companyProf) && !empty(['company_logo'])) { ?>
                                        <img src="<?php echo htmlspecialchars($companyProf['company_logo']); ?>" height="40px"
                                            width="40px" class="rounded-circle object-fit-cover object-position-center">
                                    <?php } else if (!empty($userProfile) && !empty($userProfile[0]['profile_picture'])) { ?>
                                            <img src="<?php echo htmlspecialchars($userProfile[0]['profile_picture']); ?>" height="40px"
                                                width="40px" class="rounded-circle object-fit-cover object-position-center">
                                    <?php } ?>
                                    <input type="text" name="inputComment"
                                        class="form-control rounded-pill border border-dark optional-bg comment_input" value=""
                                        data-post-id="<?php echo $row['id']; ?>" placeholder="Write a Comment...">
                                    <button class="primary-btn" id="sendCommentBtn"><i class="bi bi-send-fill"></i></button>
                                </div>
                                <div id="responseComment<?php echo $row['id']; ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <?php
        }
        ?>
        <script src="./Scripts/getLikeRatio.js?v=<?php echo time() ?>"></script>

        <?php
    } else {
        ?>
        <div class="col-12">
            <div class="bg-white py-3 px-4 rounded-3 text-center">
                <h5 class="fw-bold">No Post Found</h5>
            </div>
        </div>
        <?php
    }
} else {
    header("Location: index.php");
    exit();
}
?>