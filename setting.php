<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'recruiter') {
    header("Location: companyHome.php");
    exit();
}
include("./Classes/advanceClass.php");
// include ("./Classes/Base.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/register.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/glassBackground.css?v=<?php echo time(); ?>">
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
    $user_info = $select->selectUserBasicInfo($user_id);
    $additionalInfo = $base->getUserAdditionInfoByID($user_id);
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
                                <small class="text-secondary">Username, Password</small>
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
                                            <label for="username" class="text-white">Username</label>
                                        </div>
                                        <div class="input-group mb-3 passwordIconWrapper shadow-sm d-flex">
                                            <input type="text" id="username" value="<?php echo $user_info['username']; ?>" name="username" class="form-control input-primary" placeholder="Enter your username..." disabled>
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
                    <!--  -->
                    <!-- Additional General Info -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a class="settingTabs col-12 text-decoration-none d-flex gap-3" data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">
                            <div class="additionalInfo tabsIconBox">
                                <i class="bi bi-book-fill fs-4"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span class="fw-light optional-color">Additional Info</span>
                                <small class="text-secondary">
                                    Main Profession, Description, Hobbies, Interest</small>
                            </div>
                        </a>
                    </div>
                    <div class="collapse my-1" id="collapseExample4">
                        <div class="card card-body pinkBackground">
                            <h4 class="fw-bold text-center optional-color">Additional Info</h4>
                            <div class="container">
                                <form action="updateUserAdditionalInfo.php" method="post" class="row">
                                    <!-- Main Profession -->
                                    <div class="col-12 my-2">
                                        <label for="main_profession" class="text-white mb-2">Main Profession</label>
                                        <div class="d-flex justify-content-between align-items-center gap-3">
                                            <input type="text" id="main_profession" name="main_profession" class="w-100 input-primary" placeholder="Your Main Profession..." value="<?php echo $additionalInfo['user_main_profession'] ?? ""; ?>">
                                            <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Companies will going to search you through the main profession or by your experience" class="rounded-circle d-flex justify-content-center align-items-center primary-bg" style="height:40px;width:40px;">
                                                <i class="bi bi-info-circle-fill fs-6 optional-color"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <!-- Description -->
                                    <div class="col-12 my-2">
                                        <label for="user_description" class="text-white mb-2">Description</label>
                                        <textarea id="user_description" name="user_description" class="col-12 input-primary resize-none" placeholder="Define your Self..."><?php echo $additionalInfo['user_description'] ?? "" ?></textarea>
                                    </div>
                                    <!--  -->
                                    <!-- Hobbies -->
                                    <div class="col-12 my-2">
                                        <label for="hobbies" class="text-white mb-2">Hobbies</label>
                                        <input id="hobbies" name="hobbies" class="col-12 input-primary" value="<?php echo $additionalInfo['user_hobbies'] ?? "" ?>" placeholder="Your Hobbies...">
                                    </div>
                                    <!--  -->
                                    <!-- Interest -->
                                    <div class="col-12 my-2">
                                        <label for="interest" class="text-white mb-2">Interest</label>
                                        <input id="interest" name="interest" class="col-12 input-primary" value="<?php echo $additionalInfo['user_interest'] ?? "" ?>" placeholder="What are your Interest...">
                                    </div>
                                    <!--  -->
                                    <!-- Update Info -->
                                    <button class="col-12 primary-btn" type="submit" name="updateInfoBtn">Update
                                        Info</button>
                                </form>
                            </div>
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
                                <small class="text-secondary">Profile Visiblity, Resume Visiblity, Image Detection Security</small>
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
                                <div class="col-12 my-2 d-flex justify-content-between">
                                    <?php
                                    $userResumeData = $base->getUserResumeData($user_id);
                                    if (!empty($userResumeData) || $userResumeData != null) {
                                    ?>
                                        <label for="visibilityResume" class="text-white">Resume Visibility</label>
                                        <?php
                                        if ($resumeVisibility == 1) {
                                        ?>
                                            <div class="form-check form-switch">
                                                <input name="visibilityResume" checked class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="form-check form-switch">
                                                <input name="visibilityResume" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-12 my-2 d-flex justify-content-between">
                                    <label for="ImageAuth" class="text-white">Set up Image Authentication</label>
                                    <a href="./setUpImageDetect.php" class="optional-color text-decoration-none "><small>Enable
                                            Image Detection Login</small></a>
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
                                <small class="text-secondary">Saved Job, Applied Jobs, Create/Edit Template</small>
                            </div>
                        </a>
                    </div>
                    <div class="collapse my-1" id="collapseExample3">
                        <div class="card card-body orangeBackground">
                            <div class="my-3">
                                <label for="modal" class="text-white">Upload your Own Resume</label>
                            </div>
                            <button class="white-btn" data-bs-toggle="modal" data-bs-target="#OwnResumeModal"><i class="bi bi-upload"></i> Upload your Resume</button>
                        </div>
                        <!-- Own Resume Modal -->
                        <div class="modal fade" id="OwnResumeModal" data-bs-theme="dark" tabindex="-1" aria-labelledby="#OwnResumeModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Upload your Resume</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="./uploadExternalResumeFile.php" method="post" enctype="multipart/form-data">
                                            <label for="none_builders_resume" class="text-white mb-2">Upload Resume</label>
                                            <input type="file" name="none_builders_resume" accept="image/pdf" class="form-control">
                                            <br>
                                            <label for="job_title" class="col-12 text-white mb-2">Job Title</label>
                                            <input type="text" class="col-12 form-control" name="job_title" placeholder="Your Latest Job Title">
                                            <br>
                                            <label for="exact_experience" class="mb-2 col-12 text-white">Job Experience</label>
                                            <select name="exact_experience" class="col-12 px-3 py-2 border rounded-md mb-3 form-control">
                                                <option value="fresher" selected>Fresher</option>
                                                <option value="less_1">Less then 1 Year</option>
                                                <option value="1">1+ Years</option>
                                                <option value="3">3+ Years</option>
                                                <option value="5">5+ Years</option>
                                                <option value="10">10+ Years</option>
                                                <option value="15">15+ Years</option>
                                            </select>
                                            <br>
                                            <button class="primary-btn col-12">
                                                Save Resume
                                            </button>
                                            <br>
                                            <small class="text-secondary mt-4">
                                                <strong><i class="bi bi-info-circle-fill"></i> Note</strong>
                                                <ul>
                                                    <li>
                                                        Please fill these provided inputs for advance resume searching. It will increase your chances to get hired
                                                    </li>
                                                    <li>
                                                        In the Job title input you have to write your job title which your resume is based on. Because you are not using our resume builder.
                                                    </li>
                                                </ul>
                                            </small>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                    <!-- Help Center -->
                    <!--  -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a class="settingTabs col-12 text-decoration-none d-flex gap-3" href="./helpCenter.php">
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
                    <!-- <div class="col-12 mb-2 d-flex justify-content-center">
                        <a href="#" class="settingTabs col-12 text-decoration-none d-flex gap-3">
                            <div class="deleteTab tabsIconBox">
                                <i class="bi bi-trash3-fill fs-4"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-light optional-color">Delete Account</span>
                            </div>
                        </a>
                    </div> -->
                    <div class="col-12 mb-2 d-flex justify-content-center">
                        <a href="#" class="settingTabs col-12 text-decoration-none d-flex gap-3" id="deleteAccountLink">
                            <div class="deleteTab tabsIconBox">
                                <i class="bi bi-trash3-fill fs-4"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-light optional-color">Delete Account</span>
                            </div>
                        </a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" data-bs-theme="dark" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content glass-bg">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title text-white fw-bold" id="deleteAccountModalLabel">Warning</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-white">
                                    Are you sure that you want to delete your account?
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="primary-btn" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="primary-btn" id="confirmDeleteBtn">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.getElementById('deleteAccountLink').addEventListener('click', function() {
                            var deleteAccountModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
                            deleteAccountModal.show();
                        });

                        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                            // Redirect immediately to delete_account.php
                            window.location.href = 'delete_account.php';

                            // Close the modal
                            var deleteAccountModal = bootstrap.Modal.getInstance(document.getElementById('deleteAccountModal'));
                            deleteAccountModal.hide();
                        });
                    </script>
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