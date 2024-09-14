<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged']) && $_SESSION['logged']['role'] != 'worker') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set up Image Detection - Jobistan</title>
    <?php
    include ('./Includes/bootstrapCss.php');
    include ('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/setUpDetection.css?v=<?php echo time(); ?>">
</head>

<body>
    <form action="./setUpDetectProcess.php" enctype="multipart/form-data" class="glass-bg py-3 px-4 rounded-3 col-md-5"
        method="post">
        <div class="row">
            <a href="setting.php" class="text-white text-decoration-none mb-3"><i
                    class="bi bi-arrow-left-short"></i><small> Go Back</small></a>
            <div class="col-12 text-center mb-4">
                <h1 class="fw-light text-white">Set up Image Detection</h1>
                <small class="optional-color">ENTER THE NEW WORLD PRIVACY</small>
            </div>
            <div class="col-12">
                <?php
                if (isset($_SESSION['generalError'])) {
                    echo "<div class='alert alert-danger' data-bs-theme='dark'><i class='bi bi-exclamation-mark'></i>" . $_SESSION['generalError'] . "</div>";
                    unset($_SESSION['generalError']);
                }
                ?>
            </div>
            <div class="col-12 d-flex flex-column align-items-center gap-3">
                <label for="image" class="text-white">Choose an Image</label>
                <input type="file" id="image" class="form-control col-md-7 rounded-pill px-3" name="imageDetection"
                    accept="image/jpg, image/jpeg, image/png" required>
            </div>
            <div class="col-12 my-4 d-flex">
                <button class="btn primary-btn col-12">Enhance Security</button>
            </div>
        </div>
    </form>
    <?php
    include ('./Includes/bootstrapJs.php');
    include ('./Includes/jQuery.php');
    ?>
</body>

</html>