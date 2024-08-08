<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("LocationL index.php");
}
include('./Includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts | Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/messaging.css?v=<?php echo time(); ?>">
</head>
<?php
include('./Includes/db.php');
?>

<body>
    <main class="mainBackground">
        <div class="glass-bg col-md-5 col-12 rounded-3 py-3">
            <a href="./profile.php" class="optional-color text-decoration-none px-3"> <i class="bi bi-arrow-left-circle-fill"></i> Go Back</a>
            <h5 class="fw-bold text-center text-white">Select a Contact</h5>
            <div class="px-4">
                <input type="text" placeholder="Search People..." id="contactSearchInput" class="input-primary col-12">
            </div>
            <div class="row my-3">
                <div class="col-12 overflow-y-scroll p-4" style="height:50vh;" id="contactResponseBox">

                </div>
            </div>
        </div>
    </main>
    <?php
    include('./Includes/bootstrapJs.php');
    include('./Includes/jQuery.php');
    ?>
    <script src="./Scripts/contactSearch.js?v=<?php echo time(); ?>"></script>
</body>

</html>