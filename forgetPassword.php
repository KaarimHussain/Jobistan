<?php
include("./Includes/sessionStart.php");
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password | Jobistan</title>
    <?php
    include('./Includes/db.php');
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/glassBackground.css">
    <link rel="stylesheet" href="./Styles/forgetPassword.css">
    <link rel="stylesheet" href="./Styles/register.css">
    <link rel="stylesheet" href="./Styles/main.css">
</head>

<body>
    <main>
        <form class="glass-bg py-4 px-5 rounded-3" action="./processForgetPass.php" method="post">
            <a href="login.php" class="optional-color mb-5 text-decoration-none">
                <i class="bi bi-arrow-left-short"></i><small> Go Back</small>
            </a>
            <br>
            <br>
            <h1 class="display-6 text-white">Did you forgot your Password?</h1>
            <p class="text-center optional-color">Don't worry we'll recover it for you</p>
            <?php
            if (isset($_SESSION['recover_error'])) {
            ?>
                <div class="alert alert-danger col-12" role="alert">
                    <?php
                    echo $_SESSION['recover_error'];
                    unset($_SESSION['recover_error']);
                    ?>
                </div>
            <?php
            }
            ?>
            <div class="col-12 my-5">
                <label class="text-white" for="recovery_email">Enter your Email</label>
                <input type="email" name="recovery_email" placeholder="Enter your Recovery Email" class="input-primary col-12">
            </div>
            <div class="col-12 mb-3">
                <small class="optional-color d-flex gap-2"><i class="bi bi-exclamation-circle-fill"></i> TIPS</small>
                <ul class="optional-color">
                    <li><small>You will recive an OTP through the provided email</small></li>
                    <li><small>Make sure to Check both Inbox Primary and Spam for OTP</small></li>
                    <li><small>Make sure to place the OTP correctly</small></li>
                    <li><small>Make sure to use strong Password</small></li>
                </ul>
            </div>
            <div class="col-12 mb-4">
                <button type="submit" name="forgetPassBtn" class="primary-btn col-12">Recover Password</button>
            </div>
        </form>
    </main>
    <?php
    include("./Includes/bootstrapJs.php");
    ?>
</body>

</html>