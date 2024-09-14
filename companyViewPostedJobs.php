<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] != 'recruiter') {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posted Jobs - Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    include('./Includes/swiperCss.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/home.css?v=<?php echo time(); ?>">
</head>

<body>
    <audio id="notificationSound" src="./Resources/MP3/ting.wav"></audio>
    <?php
    include('./navbar.php');
    ?>
    <main class="full-h optional-bg">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="light-dark-bg col-12 rounded-4 py-5 position-relative">
                        <h1 class="display-5 fw-semibold text-center text-white">Search your Uploaded Jobs
                        </h1>
                        <div class="position-absolute top-100 start-50 translate-middle col-md-7">
                            <input type="text"
                                class="rounded-pill py-2 px-4 col-12 form-control border border-primary text-dark"
                                placeholder="Search Posted Jobs..." id="searchJobsBar">
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
                    <div class="row" id="responseBoxJobs">

                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION['changedJobStatus'])) {
            ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" data-bs-theme="dark" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto text-white">System</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-white">
                        <?php echo $_SESSION['changedJobStatus']; ?>
                    </div>
                </div>
            </div>
            <?php
            unset($_SESSION['changedJobStatus']);
        }
        ?>
    </main>

    <?php
    include('./footer.php');
    include('./Includes/bootstrapJs.php');
    // include('./Includes/swiperJs.php');
    include('./Includes/jQuery.php');
    ?>
    <script src="./Scripts/viewPostedJobs.js?v=<?php echo time(); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastLiveExample = document.getElementById('liveToast');
            const notificationSound = document.getElementById('notificationSound');
            if (toastLiveExample) {
                notificationSound.play();
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
                toastBootstrap.show();
            }
        })
    </script>
</body>

</html>