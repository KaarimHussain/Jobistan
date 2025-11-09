<?php include("./Includes/sessionStart.php");
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Jobistan</title>
    <?php
    include("./Includes/Icons.php");
    include("./Includes/bootstrapCss.php");
    include("./Includes/bootstrapJs.php");
    ?>
    <!-- <link rel="stylesheet" href="./Styles/register.css"> -->
    <link rel="stylesheet" href="./Styles/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/register.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="py-4 px-3 bg-white rounded-3 col-lg-4 col-md-6 col-sm-9 col-12">
        <div class="container">
            <div class="row">
                <a href="index.php" class="text-secondary text-decoration-none"><i class="bi bi-arrow-left-short"></i><small> Go Back</small></a>
                <div class="col-12 mb-5 text-center">
                    <h1 class="pt-3 fw-bold h2 text-center">
                        Login Options
                    </h1>
                    <small>Choose the Login Option</small>
                </div>
                <div class="col-12 mb-3 d-flex justify-content-between px-5">
                    <a href="./loginthroughPassword.php" class="primary-btn text-decoration-none">Password</a>
                    <a href="./loginthroughImage.php" class="primary-btn text-decoration-none">Image</a>
                </div>
                <small class="secondary-color fw-bold">
                    <i class="bi bi-exclamation-circle-fill"></i> Note
                </small>
                <small class="secondary-color">
                    <span>Click on the Image button only if you have setup Image Detection in your Account</span>
                </small><br>

            </div>
            <hr>
        </div>
        <small class="d-flex justify-content-end">
            <!-- <a href="./forgetPassword.php" class="primary-color text-decoration-none">Forget
                    Password?</a> -->
            <a href="./signup.php" class="primary-color text-decoration-none">Don't have an account?</a>
        </small>
    </div>
    </div>
</body>

</html>