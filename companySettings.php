<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'worker') {
    header('Location: home.php');
    exit();
}
include("./Classes/advanceClass.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Settings - Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/register.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/setting.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include('./navbar.php');
    $user_id = $_SESSION['logged']['id'];
    // Making Class Object
    $base = new Select($conn);
    $select = new advanceClass($conn);
    // Using Object to fetch Methods and Assinging it to the Variable
    $accountVisibility = $base->getUserAccountVisibility($user_id);
    $resumeVisibility = $base->getUserResumeVisibility($user_id);
    $user_info = $base->selectCompanyWithIDSettings($user_id);
    ?>
    <section class="full-h light-dark-bg">
        <main class="container py-5">
            <h1 class="display-2 text-center heading optional-color py-4">Settings</h1>
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12 my-3">
                    <?php
                    if (isset($_SESSION['generalSuccess'])) {
                        echo "<div class='alert alert-primary' data-bs-theme='dark'>" . $_SESSION['generalSuccess'] . "</div>";
                        unset($_SESSION['generalSuccess']);
                    }
                    if (isset($_SESSION['generalError'])) {
                        echo "<div class='alert alert-danger' data-bs-theme='dark'>" . $_SESSION['generalError'] . "</div>";
                        unset($_SESSION['generalError']);
                    }
                    if (isset($_SESSION['generalNotifcationSuccess'])) {
                        echo "<div class='alert alert-primary' data-bs-theme='dark'>" . $_SESSION['generalNotifcationSuccess'] . "</div>";
                        unset($_SESSION['generalNotifcationSuccess']);
                    }
                    if (isset($_SESSION['generalNotifcationError'])) {
                        echo "<div class='alert alert-danger' data-bs-theme='dark'>" . $_SESSION['generalNotifcationError'] . "</div>";
                        unset($_SESSION['generalNotifcationError']);
                    }
                    ?>
                </div>
                <div class="col-md-8 col-sm-12 mb-3">
                    <!-- General -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a class="settingTabs col-12 text-decoration-none d-flex gap-3" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                            <div class="generalTab tabsIconBox">
                                <i class="bi bi-grid-fill fs-4"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fw-light optional-color">General</span>
                                <small class="text-secondary">Company Name, Password</small>
                            </div>
                        </a>
                    </div>
                    <div class="collapse my-1" id="collapseExample1">
                        <div class="card card-body greenBackground">
                            <form action="./generalProcess.php" method="post" class="container">
                                <div class="row justify-content-center">
                                    <h4 class="fw-semibold text-center text-white">Update Info</h4>
                                    <div class="col-md-7 col-12 mb-3">
                                        <div class="col-12">
                                            <label for="username" class="text-white">Company Name</label>
                                        </div>
                                        <div class="input-group mb-3 passwordIconWrapper shadow-sm d-flex">
                                            <input type="text" id="username" value="<?php echo $user_info['company_name']; ?>" name="username" class="form-control input-primary" placeholder="Enter your username..." disabled>
                                            <button class="btn primary-bg rounded-circle btn-sm text-white" style="height:40px ; width: 40px;" type="button" id="editUsername">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </div>
                                        <div class="mt-3">
                                            <a class="text-decoration-none optional-color" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Change Password
                                            </a>
                                        </div>
                                        <div class="collapse bg-transparent mt-3" id="collapseExample">
                                            <div class="card card-body bg-transparent border-0 p-0 m-0">
                                                <div class="">
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 mb-3">
                                                            <label for="current_password" class="text-white">Current
                                                                Password</label>
                                                            <div class="passwordIconWrapper shadow-sm d-flex">
                                                                <input name="current_password" type="password" id="currentPasswordInput" class="form-control col-12" placeholder="Enter your Current Password...">
                                                                <button class="btn primary-bg rounded-circle btn-sm text-white" type="button" id="currentEyeBtn">
                                                                    <i class="bi bi-eye-fill" id="currentEyeIcon"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="new_password" class="text-white">New
                                                                Password</label>
                                                            <div class="passwordIconWrapper shadow-sm d-flex">
                                                                <input name="new_password" type="password" id="newPasswordInput" class="form-control col-12" placeholder="Enter your New Password...">
                                                                <button class="btn primary-bg rounded-circle btn-sm text-white" type="button" id="newEyeBtn">
                                                                    <i class="bi bi-eye-fill" id="newEyeIcon"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <a href="generalforgetpass.php" class="text-decoration-none optional-color">Forget
                                                            Password</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('editUsername').addEventListener('click', function() {
                                            var usernameInput = document.getElementById('username');
                                            usernameInput.disabled = !usernameInput.disabled;
                                            if (!usernameInput.disabled) {
                                                usernameInput.focus();

                                            }
                                        });

                                        document.getElementById('editEmail').addEventListener('click', function() {
                                            var emailInput = document.getElementById('email');
                                            emailInput.disabled = !emailInput.disabled;
                                            if (!emailInput.disabled) {
                                                emailInput.focus();
                                            }
                                        });
                                    </script>
                                    <div class="col-md-7 col-12 mb-3">
                                        <button class="white-btn col-12">Update Info</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Privacy -->
                    <!--  -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a class="settingTabs col-12 text-decoration-none d-flex gap-3" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                            <div class="notificationTab tabsIconBox">
                                <i class="bi bi-shield-fill fs-4"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fw-light optional-color">Privacy</span>
                                <small class="text-secondary">Company Profile Visiblity</small>
                            </div>
                        </a>
                    </div>
                    <div class="collapse my-1" id="collapseExample2">
                        <div class="card card-body purpleBackground">
                            <h4 class="text-white fw-semibold text-center">Privacy</h4>
                            <form action="processUpdatePrivacy.php" method="post">
                                <div class="my-2 col-12 d-flex justify-content-between">
                                    <label for="visibilityCheck" class="fw-light text-white">Profile Visibility</label>
                                    <div class="form-check form-switch">
                                        <?php
                                        if ($accountVisibility == 1) {
                                        ?>
                                            <input name="visibilityAccount" checked class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <?php
                                        } else {
                                        ?>
                                            <input name="visibilityAccount" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <button type="submit" class="col-12 primary-btn my-3">Update Changes</button>
                            </form>
                        </div>
                    </div>
                    <!-- App Setting -->
                    <!--  -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a class="settingTabs col-12 text-decoration-none d-flex gap-3" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                            <div class="appTab tabsIconBox">
                                <i class="bi bi-terminal-fill fs-4"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fw-light optional-color">App Setting</span>
                                <small class="text-secondary">Total Job Post</small>
                            </div>
                        </a>
                    </div>
                    <div class="collapse my-1" id="collapseExample3">
                        <div class="card card-body orangeBackground">
                            <div class="d-flex flex-column gap-2">
                                <label for="" class="text-white">View your Posted Job</label>
                                <a href="./companyViewPostedJobs.php" class="white-btn text-decoration-none text-center">
                                    Posted Jobs
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Help Center -->
                    <!--  -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a href="./helpCenter.php" class="settingTabs col-12 text-decoration-none d-flex gap-3" role="button" aria-expanded="false">
                            <div class="helpTab tabsIconBox">
                                <i class="bi bi-question-circle-fill fs-4"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fw-light optional-color">Help Center</span>
                                <small class="text-secondary">FAQ's, Contact Support, Report an Issue</small>
                            </div>
                        </a>
                    </div>
                    <!-- Logout -->
                    <!--  -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a class="settingTabs col-12 text-decoration-none d-flex gap-3" href="./logout.php">
                            <div class="logoutTab tabsIconBox">
                                <i class="bi bi-door-open-fill fs-4"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-light optional-color">Log out</span>
                            </div>
                        </a>
                    </div>
                    <!-- Danger Zone -->
                    <!--  -->
                    <div class="text-center">
                        <hr class="dangerZoneLine">
                        <p class="fw-light dangerZoneColor fs-4">Danger Zone</p>
                        <hr class="dangerZoneLine">
                    </div>
                    <!-- Delete Account -->
                    <!--  -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a href="./delete_account.php" class="settingTabs col-12 text-decoration-none d-flex gap-3">
                            <div class="deleteTab tabsIconBox">
                                <i class="bi bi-trash3-fill fs-4"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-light optional-color">Delete Account</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </main>
    </section>
    <?php
    include("./Includes/bootstrapJs.php");
    include("./Includes/jQuery.php");
    ?>
    <script src="./Scripts/setting.js?v=<?php echo time(); ?>"></script>
</body>

</html>