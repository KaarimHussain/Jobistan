<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION["logged"])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] != 'recruiter') {
    header("Location: home.php");
    exit();
}
if (!isset($_GET['user_id'])) {
    header("Location: companyHome.php");
    exit();
}
include("./Includes/db.php");
include("./Classes/workersViewCompany.php");
include("./Classes/advanceClass.php");

$advanceClass = new advanceClass($conn);
$workerData = new WorkerForCompany($conn);
$job_id = $_GET['user_id'];
$workerData->checkWorkerViewExistWithCompanyID($_SESSION['logged']['id'], $job_id);
$basicInfo = $workerData->fetchWorkerWithID($job_id);
$additionalInfo = $workerData->fetchUserAdditionalInfo($job_id);
$experience = $advanceClass->selectExperience($job_id);
$getUserResume = $advanceClass->getUserResumeFile($job_id);
$skills = $workerData->fetchWorkerSkills($job_id);
$projectLinks = $workerData->fetchWorkerProjectLinks($job_id);
$portfolioLink = $workerData->fetchWorkerPortfolioLink($job_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - Jobistan</title>
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
                <div class="col-12 my-3">
                    <a class="secondary-color text-decoration-none" href="./companyViewPostedJobs.php"><i
                            class="bi bi-arrow-left-circle-fill"></i> Go Back</a>
                </div>
                <div class="col-12">
                    <div class="d-flex gap-4 align-items-center">
                        <div>
                            <img src="<?php echo $basicInfo['profile_picture'] ?>" height="140px" width="140px"
                                class="rounded-circle object-fit-cover object-position-center" alt="">
                        </div>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="d-flex flex-column">
                                <!-- User Name -->
                                <h1 class="fw-bold"><?php echo $basicInfo['username'] ?? ''; ?></h1>
                                <!-- User Main Profession -->
                                <h5 class="fw-semibold"><?php echo $additionalInfo['user_main_profession'] ?? ''; ?>
                                </h5>
                                <!-- User Email -->
                                <a href="mailto:<?php echo $basicInfo['email']; ?>"
                                    class="secondary-color text-decoration-none"><i class="bi bi-envelope-fill"
                                        data-bs-toggle="tooltip" data-bs-title="Email Address"
                                        data-bs-placement="bottom"></i> <?php echo $basicInfo['email'] ?? ''; ?></a>
                                <!-- User Interest -->
                                <?php if (!empty($additionalInfo['user_interest'])) { ?>
                                    <small class="fw-normal"><i class="bi bi-lightbulb-fill" data-bs-toggle="tooltip"
                                            data-bs-title="Interest" data-bs-placement="bottom"></i>
                                        <?php echo $additionalInfo['user_interest'] ?? ''; ?>
                                    </small>
                                <?php } ?>
                                <!-- User Hobby -->
                                <?php if (!empty($additionalInfo['user_hobbies'])) { ?>
                                    <small class="fw-normal"><i class="bi bi-joystick" data-bs-toggle="tooltip"
                                            data-bs-title="Hobby" data-bs-placement="bottom"></i>
                                        <?php echo $additionalInfo['user_hobbies']; ?>
                                    </small>
                                <?php } ?>
                                <!-- User Portfolio -->
                                <?php
                                if (!empty($portfolioLink)) {
                                    echo '<a href="' . $portfolioLink . '" class="badge text-bg-dark">View Portfolio</a>';
                                }
                                ?>
                            </div>
                            <div class="d-flex flex-column gap-2 justify-content-center">
                                <?php
                                if (!empty($getUserResume)) {
                                    if (!$getUserResume['visibility']) {
                                        ?>
                                        <a href="#" class="primary-btn text-decoration-none">The User Resume is Hidden</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a target="_blank" href="<?php echo $getUserResume['resume_file']; ?>"
                                            class="primary-btn text-decoration-none text-center">View Resume</a>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <a href="#" class="text-decoration-none primary-btn">? No Resume Uploaded</a>
                                    <?php
                                }
                                ?>
                                <!-- <a href="./deleteUserSelectedTable.php?user_id=<?php echo $_GET['user_id'] ?>&job_id=<?php echo $_GET['job_id']; ?>"
                                    class="btn btn-dark text-decoration-none text-center">Reject</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
                    <h3 class="fw-bold">Description</h3>
                    <p><?php echo nl2br(htmlspecialchars($additionalInfo['user_description'] ?? '', ENT_QUOTES, 'UTF-8')); ?>
                    </p>
                </div>
                <div class="col-12 my-2">
                    <h3 class="fw-bold">Experience</h3>
                </div>
                <?php
                // Make Logic of Fetching User Experience and printing it through the loop
                if (!empty($experience)) {
                    foreach ($experience as $row) { ?>
                        <div class="col-12 bg-white py-3 px-4 rounded-3 mb-3 d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bold"><?php echo $row['job_title']; ?></h3>
                                <h6 class="fw-semibold"><?php echo $row['company_name']; ?></h6>
                                <p class="text-muted"><?php echo $row['company_start_date']; ?> -
                                    <?php if ($row['company_end_date'] == '0000-00-00') {
                                        echo "(Continued)";
                                    } else {
                                        echo $row['company_end_date'];
                                    } ?>
                                </p>
                                <p class="text-body-secondary">
                                    <?php
                                    echo nl2br(htmlspecialchars($row['work_description']));
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php }
                } else {
                    ?>
                    <div class="col-12 bg-white py-3 px-4 rounded-3 mb-3 d-flex align-items-center justify-content-center">
                        <div>
                            <h3 class="fw-bold">No Experience Found</h3>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="col-12 my-2 bg-white py-3 px-4 rounded-3">
                    <h3 class="fw-bold">Projects Links</h3>
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