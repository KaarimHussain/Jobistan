<?php
include("./Includes/sessionStart.php");
if (isset(($_SESSION['logged']))) {
    header("Location: home.php");
    exit();
}
if (isset($_SESSION['adminLogged'])) {
    header("Location: adminPanel.php");
    exit();
}
include("./Includes/db.php");
include("./Classes/Base.php");
$postSelect = new Select($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakistan First Ever Job Portal - Jobistan.pk</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    // include("");
    ?>
    <link rel="stylesheet" href="Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/index.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include("./AI.php");
    include("./navbar.php");
    ?>
    <main id="index-main" class="half-h py-5 px-3">
        <div class="container position-relative">
            <img class="position-absolute z-1" id="cube1" height="60" width="60" src="./Illustrations/box.svg"></img>
            <img class="position-absolute z-1" id="cube2" height="70" width="70" src="./Illustrations/box.svg"></img>
            <div style="height: 100vh;"
                class="my-5 h-100 d-flex flex-column align-items-center justify-content-center gap-3">
                <br><br>
                <p class="primary-color fw-bold">#1 JOB PORTAL</p>
                <h1 class="fw-bolder mainHeading text-center">Pakistan's first ever <br>
                    <span id="heading-gradient-background" class="fw-light">Job Portal</span>
                </h1>
                <p class="text-secondary fw-bold fs-lg-5 fs-6 fs-sm-6 text-center">Discover your next career move
                    with
                    confidence
                    and
                    ease</p>
                <div class="d-flex gap-2">
                    <a href="./loginthroughPassword.php" class="btn primary-btn">Search Jobs</a>
                </div>
            </div>
        </div>
    </main>
    <!--  -->
    <section class="primary-bg py-5">
        <h1 class="text-center fw-bolder text-white"><span id="heading-gradient-background2" class="fw-light">Getting
                Job</span> has
            never been
            <div class="d-flex justify-content-center align-items-center gap-2 flex-column my-5">
                <div class="searchBarDesign shadow d-flex justify-content-between align-items-center position-relative">
                    Search Jobs
                    <i class="bi bi-search"></i>
                    <i class="bi bi-cursor-fill position-absolute"></i>
                </div>
                <div class="d-flex flex-column rounded-3 shadow-lg searchBarResultsDesign ">
                    Designer
                    <hr>
                    Doctor
                    <hr>
                    Engineer
                </div>
            </div>
            this easier
        </h1>
    </section>
    <!--  -->
    <section class="optional-bg py-5">
        <h1 class="text-center my-5 display-5 fw-semibold"><span class="fw-light"
                id="heading-gradient-background">Jobs</span>
            picked for you</h1>
        <div class="container">
            <div class="row">
                <?php
                $response = $postSelect->fetchPostSalaryGreaterThan20k();
                foreach ($response as $row) {
                    $createdAt = new DateTime($row['created_at']);
                    $formattedDate = $createdAt->format('F j, Y, g:i a');
                    ?>
                    <div class="col-md-6 col-sm-12 col-12 mb-3">
                        <div class="pickedJobsCard shadow border-custom bg-light">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex gap-2">
                                    <div>
                                        <!-- Add the Company Logo -->
                                        <img height="40" width="40"
                                            class="rounded-circle object-fit-cover object-position-center"
                                            src="<?php echo $row['company_logo']; ?>" alt="">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h5 class="fw-bold"><?php echo $row['title']; ?></h5>
                                        <small><?php echo strtoupper($row['job_type']); ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4 mx-2">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-building-fill text-secondary"></i>
                                        <small class="text-dark"><?php echo $row['company_name']; ?></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-geo-alt-fill text-secondary"></i>
                                        <small class="text-dark"><?php echo $row['location']; ?></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-coin text-secondary"></i>
                                        <small
                                            class="text-dark"><?php echo number_format(($row['salary_range']), 0, '.', ',') . " PKR"; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4">
                                <hr>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2 mx-3">
                                <p class="primary-color fw-semibold"><?php echo $formattedDate; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (empty($response)) {
                    echo "<h6 class='text-center fw-bold'>No Currently Avaliable Jobs</h6>";
                }
                ?>
                <div class="col-12 my-5 text-center">
                    <a href="./home.php" class="primary-btn text-decoration-none" style="cursor:pointer;">
                        More Opportunities
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <section class="bg-white py-5">
        <h1 class="my-4 text-center display-5 fw-semibold">Latest Job <span id="heading-gradient-background"
                class="fw-light">Opportunities</span></h1>
        <div class="container">
            <div class="row">
                <?php
                $response = $postSelect->fetchPostLatestJob();
                foreach ($response as $row) {
                    ?>
                    <div class="col-md-4 col-sm-12 col-12 mb-3">
                        <div class="pickedJobsCard shadow border-custom bg-light">
                            <div class="d-flex gap-2 align-items-center justify-content-between">
                                <div class="d-flex gap-2 justify-content-between">
                                    <div>
                                        <!-- Add the Company Logo -->
                                        <img height="40" width="40"
                                            class="rounded-circle object-fit-cover object-position-center"
                                            src="<?php echo $row['company_logo']; ?>"
                                            alt="<?php echo $row['company_name']; ?>">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h5 class="fw-bold"><?php echo $row['title']; ?></h5>
                                        <small><?php echo $row['company_name']; ?></small>
                                    </div>
                                </div>
                                <!-- In this button add a event listner to remove or save the saved jobs from the table -->
                            </div>
                            <div class="px-4">
                                <hr>
                            </div>
                            <div class="d-flex flex-column my-1 mx-3">
                                <small class="primary-color fw-semibold">Job avaliable</small>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (empty($response)) {
                    echo "<h6 class='text-center fw-bold'>No Currently Avaliable Jobs</h6>";
                }
                ?>

            </div>
        </div>
    </section>
    <!--  -->
    <section class="primary-bg py-5 full-h">
        <div class="container">
            <h1 class="fw-semibold display-5 text-center text-white my-4 mb-5">Why choose <span
                    id="heading-gradient-background2" class="fw-light">Jobistan?</span></h1>
            <div class="row justify-content-center">
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-kanban secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Comprehensive Job Search and Management
                        </h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-phone-landscape-fill secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">User-Friendly Experience</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-fingerprint secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Secure and Private</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-layers secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Personalized Services</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-chat-left-quote secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Effective Communication</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-bar-chart-line-fill secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Analytics and Insights</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-key secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Integration and Accessibility</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-buildings secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Innovation and Future-readiness</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-telephone-outbound-fill secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Support and Feedback</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-5 mb-4">
                    <div class="aboutUsCard rounded-3 border-custom shadow bg-white p-4">
                        <div class="d-flex my-2 justify-content-center">
                            <i class="bi bi-building-fill secondary-color fs-1"></i>
                        </div>
                        <h4 class="primary-color text-center fw-semibold">Company Values and Culture</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <?php
    include('./footer.php');
    include('./Includes/bootstrapJs.php');
    include('./Includes/jQuery.php');
    include("./Includes/chatbot.php");
    ?>
</body>

</html>