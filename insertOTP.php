<?php
include('./Includes/sessionStart.php');
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
    <title>Verify OTP | Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/setUpDetection.css?v=<?php echo time(); ?>">
</head>

<body>
    <form action="./processOTP.php" method="post" class="glass-bg py-3 px-4 rounded-3 col-md-5">
        <div class="row">
            <a href="./login.php" class="text-white text-decoration-none mb-3"><i class="bi bi-arrow-left-short"></i><small> Go Back</small></a>
            <div class="col-12 text-center mb-4">
                <h1 class="fw-light text-white">Verify OTP</h1>
            </div>
            <div class="col-12 my-2">
                <label for="recover_otp" class="optional-color">Enter your OTP</label><br>
                <input name="recover_otp" type="number" class="col-12 form-control" placeholder="Enter your OTP...">
            </div>
            <div class="col-12 my-4 d-flex">
                <button class="btn primary-btn col-12">Check OTP</button>
            </div>
        </div>
    </form>
    <?php
    include("./Includes/bootstrapJs.php");
    ?>
</body>

</html>