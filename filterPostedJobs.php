<?php
include('./Includes/sessionStart.php');
header('Content-Type: application/json');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('./Includes/db.php');
    include('./Classes/Base.php');
    include('./Classes/PostedJobs.php');
    $mainClass = new Select($conn);
    $postedJobs = new PostedJobs($conn);
    $userID = $_SESSION['logged']['id'];
    $searchBar = isset($_POST['searchBarVal']) ? $_POST['searchBarVal'] : '';
    $clause = " WHERE employer_profiles.user_id = $userID";
    if (!empty($searchBar)) {
        $clause .= " AND job_listings.title LIKE '%" . $conn->real_escape_string($searchBar) . "%'";
    }
    $jobs = $mainClass->SelectAllJobsWithCompany($clause);

    if (!empty($jobs)) {
        foreach ($jobs as $job) {
            $createdAt = new DateTime($job['created_at']);
            $formattedDate = $createdAt->format('F j, Y, g:i a');
            $scheduledCount = $postedJobs->getScheduledInterviewsCount($job['job_id']);
            $appliedCount = $postedJobs->getAppliedUserCount($job['job_id']);
            $hiredCount = $postedJobs->viewHiredEmpCount($job['job_id']);
            ?>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 col-12 mb-4">
                <div class="jobCardsContainer">
                    <div class="jobCardInnerTop bg-cool1">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="py-2 px-3 text-center bg-white rounded-pill text-dark">
                                <small class="fw-bold">
                                    <?php echo htmlspecialchars($formattedDate); ?>
                                </small>
                            </div>
                        </div>
                        <div class="my-3">
                            <small class="fw-bold"><?php echo htmlspecialchars($job['company_name']); ?></small>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-light"><?php echo htmlspecialchars($job['title']); ?></h4>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div>
                                <small class="text-nowrap fw-semibold"><?php echo strtoupper(htmlspecialchars($job['job_type'])) ?>
                                    | </small>
                                <small class="text-wrap fw-semibold"><?php echo htmlspecialchars($job['tags']); ?> |
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="jobCardInnerBottom px-3 py-3 gap-2 d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex justify-content-center align-items-center gap-4">
                            <div class="d-flex flex-column gap-2">
                                <form method="get"
                                    action="./editPostedJobs.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                                    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                                    <button type="submit" name="showDetailPostBtn" class="small-primary-btn text-nowrap col-12">Edit
                                        Job</button>
                                </form>
                                <form method="get"
                                    action="./deletePostedJobs.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                                    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                                    <button type="submit" name="showDetailPostBtn"
                                        class="small-optional-btn text-nowrap col-12">Delete
                                        Job</button>
                                </form>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <form method="get"
                                    action="./viewUserSelectedTable.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                                    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                                    <button type="submit" name="showDetailPostBtn"
                                        class="position-relative small-primary-btn text-nowrap col-12">
                                        Scheduled Interviews
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                                            <?php
                                            echo $scheduledCount;
                                            ?>
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </button>
                                </form>
                                <form method="get"
                                    action="./viewUserAppliedTable.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                                    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                                    <button type="submit" name="showDetailPostBtn"
                                        class="small-optional-btn text-nowrap col-12 position-relative">View
                                        Applied
                                        Users
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                                            <?php
                                            echo $appliedCount;
                                            ?>
                                            <span class="visually-hidden">unread messages</span>
                                        </span>

                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php
                        $jobStatus = $postedJobs->getPostStatus($job['job_id']);
                        ?>
                        <div class="d-flex flex-column gap-2">
                            <a href="./companyHiringHistory.php?job_id=<?php echo $job['job_id']; ?>"
                                class="text-decoration-none small-secondary-btn text-nowrap position-relative">View Hired Employees
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                    <?php
                                    echo $hiredCount;
                                    ?>
                                    <span class="visually-hidden">unread messages</span>
                                </span></a>
                            <?php
                            if ($jobStatus == 'close') {
                                ?>
                                <form action="./statusOpenJobs.php" method="post">
                                    <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                                    <button type="submit" class="small-secondary-btn text-nowrap col-12">
                                        Status Open
                                    </button>
                                </form>
                                <?php
                            } else if ($jobStatus == 'open') {
                                ?>
                                    <form action="./statusCloseJobs.php" method="post">
                                        <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                                        <button type="submit" class="small-secondary-btn text-nowrap col-12">
                                            Status Close
                                        </button>
                                    </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<h4 class='fw-bold text-center'>No Jobs found !</h4>";
    }
    $conn->close();
} else {
    echo "Invalid request method";
}
?>