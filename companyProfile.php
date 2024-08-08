<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'worker') {
    header("Location: profile.php");
    exit();
}
if (!isset($_SESSION['logged']['id']) || empty($_SESSION['logged']['id'])) {
    header("Location: login.php");
    exit();
}
// Including the Class and the database connection
include("./Includes/db.php");
include("./Classes/advanceClass.php");
// ===============================================
$user_id = $_SESSION['logged']['id'];
$select = new advanceClass($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
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
    $base = new Select($conn);
    $basicData = $base->selectCompanyForProfilesWithID($user_id);
    ?>
    <main class="full-h light-dark-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 my-4 text-center">
                    <h2 class="display-3 mt-5 text-white profileHeading">
                        Profile
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
                            if (isset($basicData['company_logo']) && !empty($basicData['company_logo'])) {
                            ?>
                                <div class="position-relative primary-bg rounded-circle">
                                    <img class="image-fluid object-fit-cover object-position-center rounded-circle border border-primary glow-back" height="150px" width="150px" src="<?php echo $basicData['company_logo']; ?>" alt="<?php echo $_SESSION['logged']['username']; ?>">
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
                                            <form action="./uploadCompanyLogo.php" method="post" enctype="multipart/form-data">
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
                                <h2 class="text-dark display-6"><?php echo $basicData['company_name']; ?></h2>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="text-dark">Create Post</span>
                                        <a href="createJobListing.php" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Create Post">
                                            <i class="bi bi-file-post fs-3 text-dark"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start gap-5 flex-lg-row flex-md-column flex-column mt-3">
                                <div class="d-flex flex-column justify-content-center">
                                    <p class="text-dark fs-5 fw-bold text-center">
                                        <span class="fw-light text-dark fs-6 d-flex gap-3 justify-content-lg-start justify-content-md-center justify-content-center">
                                            Email Address
                                        </span>
                                        <?php echo $_SESSION['logged']['email']; ?>
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
                        <!-- <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                            <div class="primary-bg d-flex align-items-center justify-content-between rounded-3 py-3 px-3">
                                <h3 class="text-white">
                                    Profile Viewed
                                </h3>
                                <h2 class="fw-bolder text-white secondary-font">
                                    <?php #print_r($totalViewUserProfile); 
                                    ?>
                                </h2>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("./Includes/bootstrapJs.php");
    include("./Includes/jQuery.php");
    ?>
</body>

</html>