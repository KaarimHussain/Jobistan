<?php
include ("./Includes/sessionStart.php");
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Jobistan</title>
    <?php
    include ("./Includes/bootstrapCss.php");
    include ("./Includes/bootstrapJs.php");
    include ("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/register.css?v=<?php echo time(); ?>">
</head>

<body class="py-5">
    <div class="container-lg">
        <div class="row justify-content-center align-items-center full-h">
            <div class="col-lg-6 col-md-8 col-sm-12 col-12">
                <div class="RegisterBox bg-white shadow p-md-4 p-sm-3 rounded-3">
                    <a href="index.php" class="text-secondary text-decoration-none"><i
                            class="bi bi-arrow-left-short"></i><small> Go Back</small></a>
                    <h1 class="text-center fw-bold">Sign Up</h1>
                    <?php
                    if (isset($_SESSION['register_error'])) {
                        ?>
                        <div class="alert alert-danger" data-bs-theme="light" role="alert">
                            <?php
                            echo $_SESSION['register_error'];
                            unset($_SESSION['register_error']);
                            ?>
                        </div>
                        <?php
                    }
                    if (isset($_SESSION['info_sucessfull'])) {
                        ?>
                        <div class="alert alert-success" data-bs-theme="light" role="alert">
                            <i class="bi bi-info-circle-fill"></i>
                            <?php
                            echo $_SESSION['info_sucessfull'];
                            unset($_SESSION['info_sucessfull']);
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <form method="post" action="signupProcess.php" enctype="multipart/form-data">
                        <div class="row my-3">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                <div class="col-12 mb-2">
                                    <label for="username" class="primary-text fw-bold">Username</label>
                                </div>
                                <div class="col-12 mb-2 justify-content-center">
                                    <input type="text" name="username" required class="input-primary col-12 shadow-sm"
                                        placeholder="Enter your Username...">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                <div class="col-12 mb-2">
                                    <label for="email" class="primary-text fw-bold">Email</label>
                                </div>
                                <div class="col-12 mb-2 justify-content-center">
                                    <input type="email" name="email" required class="input-primary col-12 shadow-sm"
                                        placeholder="Enter your Email...">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="col-12 mb-2">
                                    <label for="username" class="primary-text fw-bold">Password</label>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="passwordIconWrapper shadow-sm d-flex">
                                        <input name="password" type="password" id="passwordInput" required
                                            placeholder="Enter your Password...">
                                        <button class="btn primary-bg rounded-circle btn-sm text-white" type="button"
                                            id="eyeBtn"><i class="bi bi-eye-fill" id="eyeIcon"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="roles" class="text-center fw-bold col-12">Describe your Role</label>
                            </div>
                            <div class="col-12 mb-2 d-flex justify-content-between gap-3">
                                <button type="button" id="workerBtn" class="btn rolesBtnActive col mb-3 fw-bold"
                                    data-roles="worker">
                                    <i class="bi bi-person-fill"></i> Job Seeker

                                </button>
                                <button type="button" id="recruiterBtn" class="btn rolesBtn col mb-3 fw-bold"
                                    data-roles="recruiter">
                                    <i class="bi bi-building-fill"></i> Recruiter
                                </button>
                            </div>
                            <a href="./login.php" class="primary-color text-decoration-none py-3">Already have an
                                account?</a>
                            <!-- Role Choice are here -->
                            <input type="hidden" name="roleChoice" id="rolesChoice">
                            <!--  -->
                            <div id="choiceInput" class="row">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="Scripts\register.js?v=<?php echo time(); ?>"></script>
</body>

</html>