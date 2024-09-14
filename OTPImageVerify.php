<?php
include ('./Includes/sessionStart.php');
if (isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_SESSION['temp_otp'])) {
    header("Location: loginthroughImage.php");
    exit();
}
if (!isset($_GET['email'])) {
    $_SESSION['register_error'] = "Cannot fetch the Email Address";
    header("Location: loginthroughImage");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP Image Authentication - Jobistan</title>
    <?php
    include ("./Includes/bootstrapCss.php");
    include ("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/setUpDetection.css?v=<?php echo time(); ?>">
</head>

<body>
    <form action="./processOTPImageVerify.php" method="post" class="glass-bg py-3 px-4 rounded-3 col-md-5">
        <div class="row">
            <a href="./loginProcessImage.php" class="text-white text-decoration-none mb-3">
                <i class="bi bi-arrow-left-short"></i><small> Go Back</small></a>
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
            <div class="col-12 text-center mb-4">
                <h1 class="fw-light text-white">Verify OTP</h1>
            </div>
            <div class="col-12 my-2">
                <label for="recover_otp" class="optional-color">Enter your OTP</label><br>
                <input name="recover_otp" type="number" class="col-12 form-control" placeholder="Enter your OTP...">
            </div>
            <div class="col-12 my-4 d-flex">
                <button class="btn primary-btn col-12">Verify OTP</button>
            </div>
        </div>
    </form>
    <?php
    include ("./Includes/bootstrapJs.php");
    ?>
</body>

</html>