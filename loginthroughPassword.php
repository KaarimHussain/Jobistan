<?php
include("./Includes/sessionStart.php");
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Password - Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/register.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="py-4 px-3 bg-white rounded-3 col-lg-4 col-md-6 col-sm-9 col-12">
        <div class="container">
            <form method="post" action="./loginProcessPassword.php" class="row">
                <a href="login.php" class="text-secondary text-decoration-none"><i class="bi bi-arrow-left-short"></i><small> Go Back</small></a>
                <div class="col-12 mb-3 text-center">
                    <h1 class="pt-3 display-6 text-center">
                        Login
                    </h1>
                    <small>Login through Password</small>
                </div>
                <div class="col-12 my-2">
                    <?php
                    if (isset($_SESSION['register_error'])) {
                    ?>
                        <div class="alert alert-danger d-flex gap-3 align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                            <?php
                            echo $_SESSION['register_error'];
                            unset($_SESSION['register_error']);
                            ?>
                        </div>
                    <?php
                    }
                    if (isset($_SESSION['register_success'])) {
                    ?>
                        <div class="alert alert-primary d-flex gap-3 align-items-center" role="alert">
                            <i class="bi bi-check2 fs-4"></i>
                            <?php
                            echo $_SESSION['register_success'];
                            unset($_SESSION['register_success']);
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-12 mb-3">
                    <label for="email" class="fw-semibold">Email Address</label>
                    <input name="email" id="emailInput" required type="email" class="col-12 input-primary" placeholder="Enter your Email Address ...">
                </div>
                <div class="col-12 mb-2">
                    <label for="password" class="fw-semibold">Password</label>
                    <input name="password" required type="password" class="col-12 input-primary" placeholder="Enter your Password ...">
                </div>
                <small class="text-secondary my-2" id="errorField"><i class="bi bi-info-circle-fill"></i> Please enter your Email address & Password</small>
                <div class="mb-4 mt-2">
                    <button type="submit" class="primary-btn col-12" disabled id="submitBtn">Login <i class="bi bi-door-open-fill"></i></button>
                </div>
            </form>
            <small class="d-flex justify-content-between">
                <a href="./forgetPassword.php" class="primary-color text-decoration-none">Forget
                    Password?</a>
                <a href="./signup.php" class="primary-color text-decoration-none">Don't have an account?</a>
            </small>
        </div>
    </div>
    <?php
    include("./Includes/bootstrapJs.php");
    ?>
    <script src="./Scripts/login.js"></script>
</body>

</html>