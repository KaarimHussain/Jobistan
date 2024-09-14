<?php
include("./Includes/sessionStart.php");
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
}
if (!isset($_COOKIE['user_id'])) {
    $_SESSION['register_error'] = "Failed to Fetch your ID. Please try again or Later!";
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Comparison</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    // include("./Includes/tailwindCss.php");
    ?>
    <link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/forgetPassword.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/register.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <main>
        <form class="glass-bg py-4 px-5 rounded-3" action="./processForgetPass.php" method="post">
            <a href="login.php" class="optional-color mb-5 text-decoration-none">
                <i class="bi bi-arrow-left-short"></i><small> Go Back</small>
            </a>
            <br>
            <br>
            <h1 class="display-6 text-white text-center">Compare your Image</h1>
            <?php
            if (isset($_COOKIE['user_id'])) {
            ?>
                <input name="user_id" type="hidden" value="<?php echo $_COOKIE['user_id']; ?>">
            <?php
                setcookie($_COOKIE['user_id'], '', time() - 1600);
            }
            ?>
            <div class="col-12 my-5">
                <label class="text-white" for="image1">Insert your Image</label>
                <input type="file" accept="image/jpeg, image/jpg, image/png" name="image1" id="image1" placeholder="Enter your Recovery Email" class="input-primary col-12">
            </div>
            <div class="col-12 mb-4">
                <button type="submit" name="forgetPassBtn" class="primary-btn col-12">Recover Password</button>
            </div>
        </form>
    </main>
    <?php
    include("./Includes/bootstrapJs.php");
    ?>
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Upload Images to Compare</h2>
        <form action="Compare.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <?php
            if (isset($_COOKIE['user_id'])) {
            ?>
                <input name="user_id" type="hidden" value="<?php echo $_COOKIE['user_id']; ?>">
            <?php
                setcookie($_COOKIE['user_id'], '', time() - 1600);
            }
            ?>
            <div>
                <label for="image1" class="block text-sm font-medium text-gray-700">Select first image:</label>
                <input accept="image/jpeg, image/jpg, image/png" type="file" name="image1" id="image1" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="text-center">
                <input type="submit" value="Upload and Compare" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            </div>
        </form>
    </div>
</body>

</html>