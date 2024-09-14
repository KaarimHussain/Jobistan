<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_GET['post_company_id'])) {
    header("Location: company.php");
    exit();
}
$post_company_id = $_GET['post_company_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Company Details - Worker | Jobistan</title>
    <?php
    include ('./Includes/bootstrapCss.php');
    include ('./Includes/Icons.php');
    include ('./Includes/swiperCss.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/home.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include ('./navbar.php');
    $base = new Select($conn);
    $companyData = $base->selectCompanyWithProfiles($post_company_id);
    $companyJobPostData = $base->SelectJobsWithCompanyWithID($post_company_id);
    ?>
    <main class="full-h optional-bg">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <img src="<?php echo $companyData['company_logo']; ?>" height="140px" width="140px" alt=""
                        class="image-fluid object-fit-cover object-position-center rounded-circle">
                </div>
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <h1 class="fw-bold"><?php echo $companyData['company_name']; ?></h1>
                </div>
                <!-- Avaliable Jobs Published by the Company -->
                <div class="row">
                    <?php
                    if (!empty($companyJobPostData)) {
                        ?>
                        <div class="col-12 mb-3">
                            <h1 id="heading-gradient-background" class="my-4">Avaliable Jobs</h1>
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <?php
                                    $colorCount = 1;
                                    foreach ($companyJobPostData as $job) {
                                        $createdAt = new DateTime($job['created_at']);
                                        $formattedDate = $createdAt->format('F j, Y, g:i a');
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="jobCardsContainer">
                                                <div class="jobCardInnerTop bg-cool<?php echo $colorCount; ?>">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="py-2 px-3 text-center bg-white rounded-pill text-dark">
                                                            <small class="fw-bold">
                                                                <?php echo htmlspecialchars($formattedDate); ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="my-3">
                                                        <small
                                                            class="fw-bold"><?php echo htmlspecialchars($job['company_name']); ?></small>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h4 class="fw-light"><?php echo htmlspecialchars($job['title']); ?>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <div>
                                                            <small
                                                                class="text-nowrap fw-semibold"><?php echo strtoupper(htmlspecialchars($job['job_type'])) ?>
                                                                | </small>
                                                            <small
                                                                class="text-wrap fw-semibold"><?php echo htmlspecialchars($job['tags']); ?>
                                                                |
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="jobCardInnerBottom px-3 py-3 d-flex justify-content-between align-items-center">
                                                    <div class="d-flex flex-column">
                                                        <p class="fw-bolder">
                                                            <?php echo number_format(htmlspecialchars($job['salary_range']), 0, '.', ',') . " PKR"; ?>
                                                        </p>
                                                        <small
                                                            class="text-secondary fw-semibold"><?php echo htmlspecialchars($job['location']); ?></small>
                                                    </div>
                                                    <form method="get"
                                                        action="./viewPostDetails.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                                                        <input type="hidden" name="job_id"
                                                            value="<?php echo htmlspecialchars($job['job_id']); ?>">
                                                        <button type="submit" name="showDetailPostBtn"
                                                            class="primary-btn">Details</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($colorCount < 5) {
                                            $colorCount = 1;
                                        } else {
                                            $colorCount++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-12 mb-3">
                    <h3 class="fw-semibold">Description</h3>
                    <p><?php echo htmlspecialchars($companyData['company_description']); ?></p>
                </div>
                <div class="col-12 mb-3">
                    <h3 class="fw-semibold">Culture</h3>
                    <p><?php echo htmlspecialchars($companyData['company_culture']); ?></p>
                </div>
                <div class="col-12 mb-3">
                    <h3 class="fw-semibold">Benefits</h3>
                    <p><?php echo htmlspecialchars($companyData['company_benefits']); ?></p>
                </div>
            </div>
        </div>
    </main>
    <?php
    include ('./footer.php');
    include ('./Includes/bootstrapJs.php');
    include ('./Includes/jQuery.php');
    include ('./Includes/swiperJs.php');
    ?>
    <script src="./Scripts/companyDetailsSwiper.js?v=<?php echo time(); ?>"></script>
</body>

</html>