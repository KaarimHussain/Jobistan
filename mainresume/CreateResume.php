<?php
include ('../Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build your Own Resume usign Jobistan Resume Builder - Jobistan</title>
    <?php
    include ('../Includes/bootstrapCss.php');
    include ('../Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="../Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Styles/resume.css?v=<?php echo time(); ?>">

</head>

<body>
    <main class="overflow-y-none full-h optional-bg d-flex align-items-center justify-content-center position-relative">
        <a href="../home.php"
            class="text-decoration-none secondary-color position-absolute top-0 start-0 p-3 d-flex align-items-center gap-3"><i
                class="bi bi-arrow-left-circle-fill fs-1"></i> <span class="fs-4">Go Back</span></a>
        <section class="container position-relative text-center">
            <h1 class="display-4 mainHeading text-center">
                <!-- Karachi-Islamabad-Lahore-Peshawar-Gilgit-Kashmir -->
                !@#asd934nasdK0LoaOd!#!@
            </h1>
            <p id="parahTag" class="text-center primary-color fw-bold" style="opacity: 0;line-height:0px;">With Multiple
                Resume
                Layout to Choose From!</p><br>
            <button class="my-4 primary-btn fs-4 shadow-lg" style="opacity: 0;" id="buildNowBtn">Let's Goo <i
                    class="bi bi-airplane-engines-fill"></i></button>
            <img class="position-absolute" id="cube1" height="60" width="60" src="../Illustrations/box.svg"></img>
            <img class="position-absolute" id="cube2" height="70" width="70" src="../Illustrations/box.svg"></img>
        </section>
        <section id="overScreen" class="d-flex justify-content-center align-items-center">
            <img src="../Resources/JOBISTANLOGO/trans_logo1.png" height="300px" width="300px"
                class="object-fit-cover object-position-center" alt="">
        </section>
    </main>
    <?php
    include ('../Includes/bootstrapJs.php');
    include ('../Includes/jQuery.php');
    include ('../Includes/gsap.php');
    ?>
    <script src="../Scripts/buildResume.js?v=<?php echo time(); ?>"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buildNowBtn = document.getElementById('buildNowBtn');
            buildNowBtn.addEventListener('click', displayNewPage);
            function displayNewPage() {
                // console.log("Called");
                gsap.to('#overScreen', {
                    duration: 2,
                    top: "100%",
                    left: "0",
                    ease: 'ease',
                    onComplete: () => {
                        // console.log("Done");
                        window.location.href = '../Resume/Default_Resume/resume1.php';
                    }
                })
            }

        })
    </script>
</body>

</html>