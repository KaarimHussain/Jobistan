<?php
include("./Includes/sessionStart.php");
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    header("Location: index.php");
    exit();
}
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_GET['showUserDetailsForCompany'])) {
    header("Location: companyHome.php");
    exit();
}
include("./Includes/db.php");
include("./Classes/workersViewCompany.php");
$workerData = new WorkerForCompany($conn);
$job_id = $_GET['post_user_id'];
$workerData->checkWorkerViewExistWithCompanyID($_SESSION['logged']['id'], $job_id);
$basicInfo = $workerData->fetchWorkerWithID($job_id);
$additionalInfo = $workerData->fetchUserAdditionalInfo($job_id);
$experience = $workerData->fetchWorkerExperience($job_id);
$skills = $workerData->fetchWorkerSkills($job_id);
$projectLinks = $workerData->fetchWorkerProjectLinks($job_id);
$portfolioLink = $workerData->fetchWorkerPortfolioLink($job_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Details | Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include('./navbar.php');
    ?>
    <main class="full-h optional-bg">
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex gap-4 align-items-center">
                        <div>
                            <img src="<?php echo $basicInfo['profile_picture'] ?>" height="140px" width="140px" class="rounded-circle object-fit-cover object-position-center" alt="">
                        </div>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="d-flex flex-column">
                                <!-- User Name -->
                                <h1 class="fw-bold"><?php echo $basicInfo['username']; ?></h1>
                                <!-- User Main Profession -->
                                <h5 class="fw-semibold"><?php echo $additionalInfo['user_main_profession']; ?></h5>
                                <!-- User Email -->
                                <a href="mailto:<?php echo $basicInfo['email']; ?>" class="secondary-color text-decoration-none"><i class="bi bi-envelope-fill" data-bs-toggle="tooltip" data-bs-title="Email Address" data-bs-placement="bottom"></i> <?php echo $basicInfo['email']; ?></a>
                                <!-- User Interest -->
                                <small class="fw-normal"><i class="bi bi-lightbulb-fill" data-bs-toggle="tooltip" data-bs-title="Interest" data-bs-placement="bottom"></i> <?php echo $additionalInfo['user_interest']; ?>
                                </small>
                                <!-- User Hobby -->
                                <small class="fw-normal"><i class="bi bi-joystick" data-bs-toggle="tooltip" data-bs-title="Hobby" data-bs-placement="bottom"></i> <?php echo $additionalInfo['user_hobbies']; ?>
                                </small>
                                <!-- User Portfolio -->
                                <?php
                                if (!empty($portfolioLink)) {
                                    echo '<a href="' . $portfolioLink . '" class="badge text-bg-dark">View Portfolio</a>';
                                }
                                ?>
                            </div>
                            <div>
                                <a target="_blank" href="#" class="primary-btn text-decoration-none">View Resume</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
                    <h3 class="fw-bold">Description</h3>
                    <p><?php echo $additionalInfo['user_description']; ?></p>
                </div>
                <div class="col-12 my-2 bg-white py-3 px-4 rounded-3">
                    <h3 class="fw-bold">Experience</h3>
                    <?php
                    if (!empty($experience)) {
                        foreach ($experience as $exp) {
                    ?>
                            <div class="my-3">
                                <h6 class="fw-semibold"><?php echo $exp['company_name']; ?></h6>
                                <p><?php echo $exp['work_description']; ?></p>
                                <small><i><?php $exp['company_start_date']; ?> - <?php echo $exp['company_end_date']; ?></i></small>
                            </div>
                            <hr class="primary-color">
                    <?php
                        }
                    } else {
                        echo "<p>No Experience.</p>";
                    }
                    ?>
                </div>
                <div class="col-12 my-2 bg-white py-3 px-4 rounded-3">
                    <h3 class="fw-bold">Projects Links</h3>
                    <?php
                    if (!empty($experience)) {
                        foreach ($projectLinks as $pro) {
                    ?>
                            <div class="my-3">
                                <p class="fw-semibold"><?php echo $pro['project_name']; ?></p>
                                <small class="fw-light"><?php echo $pro['project_description']; ?></small>
                                <a href="<?php echo $pro['project_link']; ?>" target="_blank" class="text-decoration-none primary-color">View Project</a>
                            </div>
                            <hr class="primary-color">
                    <?php
                        }
                    } else {
                        echo "<p>No Projects.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    include('./footer.php');
    include('./Includes/bootstrapJs.php');
    ?>
</body>

</html>