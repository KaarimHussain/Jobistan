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
    <title>Change Password | Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/recoverPassword.css?v=<?php echo time(); ?>">
</head>

<body>
    <main>
        <form class="glass-bg py-4 px-4 rounded-3" method="post" action="./processChangePassword.php">
            <h1 class="display-6 text-center text-white">Recover your Password</h1>
            <div class="col-12 my-5">
                <lable for="password" class="text-white">New Password</lable>
                <br>
                <input type="password" name="password" class="form-control">
            </div>
            <div>
                <small class="optional-color"><i class="bi bi-exclamation-circle-fill"></i> Tips</small>
                <ul>
                    <li class="optional-color"><small>Make sure to use Strong Password & Easy to Remember for
                            you</small></li>
                    <li class="optional-color"><small>Always use special Characters in your Password</small>
                    </li>
                    <li class="optional-color"><small>Make sure your Password is long enough</small></li>
                </ul>
            </div>

            <button type="submit" class="btn primary-btn col-12">Change Password</button>
        </form>
    </main>
</body>

</html>