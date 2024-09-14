<?php
include ("./Includes/sessionStart.php");
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
    include ("./Includes/bootstrapCss.php");
    include ("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/register.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="py-4 px-3 bg-white rounded-3 col-lg-4 col-md-6 col-sm-9 col-12">
        <div class="container">
            <form method="post" action="./loginProcessImage.php" class="row" enctype="multipart/form-data">
                <a href="login.php" class="text-secondary text-decoration-none"><i
                        class="bi bi-arrow-left-short"></i><small> Go Back</small></a>
                <div class="col-12 mb-3 text-center">
                    <h1 class="pt-3 display-6 text-center">
                        Login
                    </h1>
                    <small>Login through Image</small>
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
                    <label for="email">Email Address</label>
                    <input name="email" type="email" class="col-12 input-primary"
                        placeholder="Enter your Email Address ...">
                </div>
                <div class="col-12 mb-3">
                    <label for="password">Registered Image</label>
                    <input name="image" required type="file" accept="image/jpg, image/jpeg, image/png"
                        class="col-12 input-primary">
                </div>
                <div class="mb-4">
                    <button type="submit" class="primary-btn col-12">Login <i class="bi bi-door-open-fill"></i></button>
                </div>
            </form>
            <small class="d-flex justify-content-end">
                <a href="./signup.php" class="primary-color text-decoration-none">Don't have an account?</a>
            </small>
        </div>
    </div>
    <?php
    include ("./Includes/bootstrapJs.php");
    ?>
</body>

</html>