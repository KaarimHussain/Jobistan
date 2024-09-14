<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_GET['job_id'])) {
    header("Location: home.php");
    exit();
}
include("./Includes/db.php");
$job_id = $_GET['job_id'];
$user_id = $_SESSION['logged']['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details | Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    include('./Includes/swiperCss.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/viewPost.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include('./navbar.php');
    $base = new Select($conn);
    $jobStatus = $base->showJobStatus($job_id);

    $jobData = $base->SelectJobsWithCompanyWithIDForViewPost($job_id);
    $getSavedPostRatio = $base->getSavedPostRatio($user_id, $job_id);
    // $jobData = $jobData[0];
    $recommendedJobsData = $base->getMoreSimilarJobs($jobData['title']);
    $checkAppliedRatio = $base->checkAppliedRatio($user_id, $job_id);
    if (!$jobData) {
        echo "Error: No job data found.";
        exit();
    }
    ?>
    <main>
        <div class="container my-5">
            <div class="d-flex gap-3 align-items-center">
                <img src="<?php echo $jobData['company_logo'] ?? './Resources/JOBISTANLOGO/default-profile-picture.png'; ?>"
                    height="140px" width="140px"
                    class="image-fluid rounded-circle object-fit-cover object-position-none">
                <div
                    class="d-flex align-items-center justify-content-lg-between justify-content-md-center justify-content-center w-100 flex-lg-row flex-md-column flex-column">
                    <div
                        class="d-flex flex-column justify-content-center align-items-lg-start align-items-md-center align-items-center mb-3">
                        <h4 class="fw-semibold"><?php echo $jobData['company_name'] ?? 'N/A'; ?></h4>
                        <h2 class="fw-bold"><?php echo $jobData['title'] ?? 'N/A'; ?></h2>
                        <small>
                            <i class="bi bi-suitcase-lg-fill"></i>
                            <?php echo strtoupper(str_replace("-", " ", $jobData['job_type'])) ?? 'N/A'; ?>
                        </small>
                        <small class="fw-bold"><i class="bi bi-cash-stack"></i>
                            <?php echo number_format($jobData['salary_range']) . ' PKR' ?>
                        </small>
                        <small class="fw-bold"><i class="bi bi-geo-alt-fill"></i>
                            <?php echo $jobData['location']; ?>
                        </small>
                    </div>
                    <div class="d-flex gap-2 flex-column">
                        <div class="d-flex flex-column gap-2">
                            <span class="rounded-pill bg-dark py-2 px-3 text-white">
                                Status:
                                <?php
                                echo strtoupper($jobStatus['job_status']);
                                ?>
                            </span>
                            <b class="py-2 px-3 rounded-2 bg-dark text-white">
                                <small>
                                    Required Candidate :
                                    <?php
                                    echo $jobStatus['required_candidate'];
                                    ?>
                                </small>
                            </b>
                        </div>

                        <div class="d-flex gap-2">
                            <?php
                            if (!empty($getSavedPostRatio)) {
                                ?>
                                <form action="./deletePost.php" method="post">
                                    <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                                    <button type="submit" class="checkBookedMarkBtn"><i
                                            class="bi bi-bookmark-fill"></i></button>
                                </form>
                                <?php
                            } else {
                                ?>
                                <form action="./savePost.php" method="post">
                                    <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                                    <button type="submit" class="checkBookedMarkBtn"><i class="bi bi-bookmark"></i></button>
                                </form>
                                <?php
                            }
                            if ($checkAppliedRatio) {
                                ?>
                                <button class="primary-btn" type="button">
                                    <i class="bi bi-check2"></i>
                                    Applied
                                </button>
                                <?php
                            } else {
                                if ($jobStatus['required_candidate'] <= 0 || $jobStatus['job_status'] == 'close') {
                                    ?>
                                    <div
                                        class="primary-bg rounded-2 d-flex align-items-center justify-content-center text-white fw-semibold py-2 px-3">
                                        No Seats Left
                                    </div>
                                    <?php
                                } else if ($jobStatus['required_candidate'] > 0) {
                                    ?>
                                        <form action="./handleApplyJob.php" method="post">
                                            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                                            <input type="hidden" name="company_id"
                                                value="<?php echo $jobData['employer_profile_id']; ?>">
                                            <button class="primary-btn" name="handleApplyJobsBtn">
                                                <i class="bi bi-lightning-charge-fill"></i>
                                                Apply
                                            </button>
                                        </form>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="primary-color">
            <div class="row my-4">
                <div class="col-12">
                    <h5 class="fw-semibold">
                        Job Description
                    </h5>
                </div>
                <div class="col-12 my-2">
                    <p><?php echo nl2br(htmlspecialchars($jobData['description'], ENT_QUOTES, 'UTF-8')) ?? 'N/A'; ?></p>
                </div>
                <hr class="primary-color">
                <div class="col-12">
                    <h5 class="fw-semibold">
                        Job Requirements
                    </h5>
                </div>
                <div class="col-12 my-2">
                    <p><?php echo nl2br(htmlspecialchars($jobData['requirements'], ENT_QUOTES, 'UTF-8')) ?? 'N/A'; ?>
                    </p>
                </div>
                <hr class="primary-color">
                <div class="col-12">
                    <h5 class="fw-semibold">
                        Company Culture
                    </h5>
                </div>
                <div class="col-12 my-2">
                    <p><?php echo nl2br(htmlspecialchars($jobData['company_culture'], ENT_QUOTES, 'UTF-8')) ?? 'N/A'; ?>
                    </p>
                </div>
                <hr class="primary-color">
                <div class="col-12">
                    <h5 class="fw-semibold">
                        Company Benefits
                    </h5>
                </div>
                <div class="col-12 my-2">
                    <p><?php echo nl2br(htmlspecialchars($jobData['company_benefits'], ENT_QUOTES, 'UTF-8')) ?? 'N/A'; ?>
                    </p>
                </div>
                <hr class="primary-color">
                <div class="col-12">
                    <h5 class="fw-semibold">
                        Tags
                    </h5>
                </div>
                <div class="col-12 my-2">
                    <div class="d-flex gap-2">
                        <?php
                        $tags = explode(',', $jobData['tags']);
                        foreach ($tags as $tag) {
                            echo "<span class='badge bg-primary text-white'>" . trim($tag) . "</span> ";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <hr class="primary-color">
            <h1 class="text-center my-4" id="heading-gradient-background">Suggested Jobs</h1>

            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php
                    if (!empty($recommendedJobsData)) {
                        foreach ($recommendedJobsData as $row) {
                            if ($row['job_id'] != $job_id) {
                                $createdAt = new DateTime($row['created_at']);

                                ?>
                                <div class="swiper-slide">
                                    <div class="suggestedJobsCard">
                                        <div class="jobCardsContainer">
                                            <div class="jobCardInnerTop bg-cool1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="py-2 px-3 text-center bg-white rounded-pill text-dark">
                                                        <small class="fw-bold">
                                                            <?php echo $formattedDate = $createdAt->format('F j, Y, g:i a'); ?>
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <small class="fw-bold"><?php echo $row['company_name']; ?></small>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="fw-light"><?php echo $row['title']; ?></h4>
                                                        <?php
                                                        if (!empty($row['company_logo'])) {
                                                            echo "<img src='" . $row['company_logo'] . "' alt='" . $row['company_name'] . "' height='40' width='40'>";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <div>
                                                        <small
                                                            class="text-nowrap fw-semibold"><?php echo strtoupper($row['job_type']); ?>
                                                            | </small>
                                                        <small class="text-nowrap fw-semibold"><?php echo $row['location']; ?>
                                                            | </small>
                                                        <small class="text-wrap fw-semibold"><?php echo $row['tags'] ?>
                                                            |
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="jobCardInnerBottom px-3 py-3 d-flex justify-content-between align-items-center">
                                                <div class="d-flex flex-column">
                                                    <p class="fw-bolder">
                                                        <?php echo number_format($row['salary_range']) . " PKR"; ?>
                                                    </p>
                                                    <small
                                                        class="text-secondary fw-semibold"><?php echo $row['location']; ?></small>
                                                </div>
                                                <form method="get"
                                                    action="./viewPostDetails.php?job_id=<?php echo htmlspecialchars($row['job_id']); ?>">
                                                    <input type="hidden" name="job_id"
                                                        value="<?php echo htmlspecialchars($row['job_id']); ?>">
                                                    <button type="submit" name="showDetailPostBtn"
                                                        class="primary-btn">Details</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                        }
                        ?>
                        <div class="swiper-pagination"></div>
                        <?php
                    } else {
                        ?>
                        <h1 class="fw-bold text-center">There are no Jobs Related to this field</h1>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--  -->
        </div>
    </main>
    <?php
    include('./footer.php');
    include('./Includes/bootstrapJs.php');
    include('./Includes/swiperJs.php');
    ?>
    <script src="./Scripts/viewJobDetails.js"></script>
</body>

</html>