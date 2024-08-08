<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'recruiter') {
    header("Location: companyProfile.php");
    exit();
}
// Including the Class and the database connection
include("./Includes/db.php");
include("./Classes/advanceClass.php");
// ===============================================
$user_id = $_SESSION['logged']['id'];
$select = new advanceClass($conn);
$basicData = $select->selectUserBasicInfo($user_id);
$advanceData = $select->selectUserInfoForProfile($user_id);
$totalSavedJob = $select->selectUserSavedPost($user_id);
$totalAppliedJob = $select->selectUserAppliedPost($user_id);
$totalViewUserProfile = $select->selectViewUserProfile($user_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/swiperCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/glowingBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/glassBackground.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include("./navbar.php");
    ?>
    <main class="full-h light-dark-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 my-4 text-center">
                    <h2 class="display-3 mt-5 text-white profileHeading">
                        Profile <?php $_SESSION['logged']['id']; ?>
                    </h2>
                </div>
                <div class="col-md-12 col-sm-12 my-3">
                    <?php
                    if (isset($_SESSION['generalSuccess'])) {
                        echo "<div class='alert alert-primary' data-bs-theme='dark'><i class='bi bi-check2'></i> " . $_SESSION['generalSuccess'] . "</div>";
                        unset($_SESSION['generalSuccess']);
                    }
                    if (isset($_SESSION['generalError'])) {
                        echo "<div class='alert alert-danger' data-bs-theme='dark'><i class='bi bi-exclamation-triangle-fill'></i> " . $_SESSION['generalError'] . "</div>";
                        unset($_SESSION['generalError']);
                    }
                    ?>
                </div>
                <div class="col-12 my-5">
                    <div class="d-flex flex-lg-row flex-md-column flex-column align-items-center gap-4 text-lg-start text-md-center text-center bg-white py-5 px-5 rounded-5">
                        <div>
                            <?php
                            if (isset($basicData['profile_picture']) && !empty($basicData['profile_picture'])) {
                            ?>
                                <div class="position-relative">
                                    <img class="image-fluid object-fit-cover object-position-center rounded-circle border border-primary glow-back" height="150px" width="150px" src="<?php echo $basicData['profile_picture']; ?>" alt="<?php echo $_SESSION['logged']['username']; ?>">
                                    <button style="height:40px;width: 40px;" data-bs-toggle="modal" data-bs-target="#uploadProfilePicModal" class="btn rounded-circle border border-dark position-absolute top-100 start-0 translate-middle-x">
                                        <i class="bi bi-pencil-fill text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Update Profile Picture"></i>
                                    </button>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="border border-primary position-relative glow-back rounded-circle d-flex justify-content-center align-items-center" style="height: 150px;width:150px;">
                                    <i class="bi bi-person display-1 text-white"></i>
                                    <button style="height:40px;width: 40px;" data-bs-toggle="modal" data-bs-target="#uploadProfilePicModal" class="btn rounded-circle border border-dark position-absolute top-100 start-0 translate-middle-x">
                                        <i class="bi bi-pencil-fill text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Update Profile Picture"></i>
                                    </button>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- Updating Profile Picture Modal -->
                            <div class="modal fade" id="uploadProfilePicModal" tabindex="-1" aria-labelledby="uploadProfilePicModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content glass-bg">
                                        <div class="modal-body">
                                            <h1 class="my-2 text-center display-6 text-white">Upload Profile Picture
                                            </h1>
                                            <form action="./uploadProfilePicture.php" method="post" enctype="multipart/form-data">
                                                <div class="my-4">
                                                    <label for="profilePicture" class="form-label text-white">Choose a
                                                        profile picture</label>
                                                    <input required class="form-control rounded-pill" type="file" id="profilePicture" name="profilePicture" accept="image/*">
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" class="primary-btn col-12 optional-color">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================== -->
                        </div>
                        <div class="d-flex flex-column justify-content-lg-start text-lg-start text-md-center text-center justify-content-md-center justify-content-center w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="text-dark display-6"><?php echo $basicData['username']; ?></h2>
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <small class="text-dark">Messages</small>
                                        <a href="chattingArea.php" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Messages">
                                            <i class="bi bi-chat-right-text-fill fs-3 text-dark"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column align-items-center">
                                        <small class="text-dark">Resume Builder</small>
                                        <a href="./mainresume/CreateResume.php" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Resume Builder">
                                            <i class="bi bi-file-earmark-medical-fill fs-3 text-dark"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-start gap-5 flex-lg-row flex-md-column flex-column mt-3">
                                <?php if (!empty($advanceData['user_main_profession'])) {
                                ?>
                                    <div class="d-flex flex-column">
                                        <p class="text-dark fs-6 fw-bold text-center">
                                            <span class="fw-light text-dark fs-6 d-flex gap-3 text-center">
                                                Role
                                            </span>
                                            <?php echo $advanceData['user_main_profession']; ?>
                                        </p>
                                    </div>
                                <?php
                                } else {
                                } ?>
                                <div class="d-flex flex-column justify-content-center">
                                    <p class="text-dark fs-5 fw-bold text-center secondary-font">
                                        <span class="fw-light text-dark fs-6 d-flex gap-3 justify-content-lg-start justify-content-md-center justify-content-center">
                                            Phone Number
                                        </span>
                                        <?php echo $basicData['phone']; ?>
                                    </p>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <p class="text-dark fs-5 fw-bold text-center">
                                        <span class="fw-light text-dark fs-6 d-flex gap-3 justify-content-lg-start justify-content-md-center justify-content-center">
                                            Email Address
                                        </span>
                                        <?php echo $basicData['email']; ?>
                                    </p>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <p class="text-dark fs-5 fw-bold text-center secondary-font">
                                        <span class="fw-light text-dark fs-6 d-flex gap-3 justify-content-lg-start justify-content-md-center justify-content-center">
                                            Joined At
                                        </span>
                                        <?php echo $basicData['created_at']; ?>
                                    </p>
                                </div>
                            </div>
                            <!-- Display other profile data as needed -->
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Your Total Saved Jobs" class="primary-bg d-flex align-items-center justify-content-between rounded-3 py-3 px-3">
                                <h3 class="text-white">
                                    Saved Jobs
                                </h3>
                                <h2 class="fw-bolder text-white secondary-font">
                                    <?php echo implode("", $totalSavedJob); ?>
                                </h2>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Your Total Job that you have applied" class="primary-bg d-flex align-items-center justify-content-between rounded-3 py-3 px-3">
                                <h3 class="text-white">
                                    Applied Jobs
                                </h3>
                                <h2 class="fw-bolder text-white secondary-font">
                                    <?php echo implode("", $totalAppliedJob); ?>
                                </h2>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Profile viewed by Company" class="primary-bg d-flex align-items-center justify-content-between rounded-3 py-3 px-3">
                                <h3 class="text-white">
                                    Profile Viewed
                                </h3>
                                <h2 class="fw-bolder text-white secondary-font">
                                    <?php echo $totalViewUserProfile['view_count']; ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Display Saved Post -->
                <div class="col-12 my-5">
                    <h1 id="heading-gradient-background2">Saved Post</h1>
                    <div class="container-fluid py-3">
                        <!-- Post Data -->
                        <div class="swiper mySwiper1">
                            <div class="swiper-wrapper">
                                <?php
                                $postSelect = new Select($conn);
                                $response = $postSelect->fetchUserSavedPostByID($user_id);
                                if (!empty($response)) {
                                    foreach ($response as $row) {
                                        $created_at = new DateTime($row['created_at']);
                                        $created_at = $created_at->format('F j, Y, g:i a');
                                ?>
                                        <div class="swiper-slide">
                                            <div class="optional-bg rounded-3 p-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="fw-semibold">
                                                        <?php
                                                        echo $row['title'];
                                                        ?>
                                                    </h5>
                                                    <p class="py-2 px-3 rounded-pill bg-dark text-nowrap optional-color">
                                                        <?php echo $created_at; ?>
                                                    </p>
                                                </div>
                                                <form method="get" action="./viewPostDetails.php?job_id=<?php echo htmlspecialchars($row['job_id']); ?>">
                                                    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($row['job_id']); ?>">
                                                    <button type="submit" name="showDetailPostBtn" class="primary-btn col-12">Details</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <h4 class="fw-bold optional-color gap-3 d-flex align-items-center justify-content-center">
                                        No
                                        Saved <i class="bi bi-sign-dead-end-fill text-white fs-1"></i> Post Found</h4>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Display Applied Post -->
                <div class="col-12 my-5">
                    <h1 id="heading-gradient-background2">Applied Post</h1>
                    <div class="container-fluid py-3">
                        <!-- Post Data -->
                        <div class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                <?php
                                $savedPostSelect = new Select($conn);
                                $postResponse = $savedPostSelect->fetchUserAppliedPostByID($user_id);
                                if (!empty($postResponse)) {
                                    foreach ($postResponse as $row) {
                                        $created_at = new DateTime($row['created_at']);
                                        $created_at = $created_at->format('F j, Y, g:i a');
                                ?>
                                        <div class="swiper-slide">
                                            <div class="optional-bg rounded-3 p-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="fw-semibold">
                                                        <?php
                                                        echo $row['title'];
                                                        ?>
                                                    </h5>
                                                    <p class="py-2 px-3 rounded-pill bg-dark text-nowrap optional-color">
                                                        <?php echo $created_at; ?>
                                                    </p>
                                                </div>
                                                <form method="get" action="./viewPostDetails.php?job_id=<?php echo htmlspecialchars($row['job_id']); ?>">
                                                    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($row['job_id']); ?>">
                                                    <button type="submit" name="showDetailPostBtn" class="primary-btn col-12">Details</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <h4 class="fw-bold optional-color gap-3 d-flex align-items-center justify-content-center">
                                        No
                                        Applied <i class="bi bi-sign-dead-end-fill text-white fs-1"></i> Post Found</h4>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Display experience -->
                <hr class="primary-color">
                <div class="col-12 my-3">
                    <h2 class="fw-bold mb-5 optional-color text-center">Experiences</h2>
                    <div class="row">
                        <?php
                        // Make Logic of Fetching User Experience and printing it through the loop
                        ?>
                        <div class="col-12 bg-white py-3 px-4 rounded-3 mb-3 d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bold">JOB TITLE</h3>
                                <h6 class="fw-semibold">COMPANY NAME</h6>
                                <p class="text-muted">START DATE - END DATE</p>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad nam dicta reiciendis?</p>
                            </div>
                            <div>
                                <a href="#" class="text-decoration-none d-flex align-items-center gap-2 secondary-color"><i class="bi bi-x fs-2"></i>Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("./Includes/bootstrapJs.php");
    include("./Includes/jQuery.php");
    include("./Includes/swiperJs.php");
    ?>
    <script src="./Scripts/profileSwiper.js?v=<?php echo time(); ?>"></script>
</body>

</html>