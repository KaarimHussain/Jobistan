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
    $mainClass = new Select($conn);
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
                    <div class="jobCardInnerBottom px-3 py-3 gap-2 d-flex justify-content-between align-items-center">
                        <form method="get" action="./editPostedJobs.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                            <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                            <button type="submit" name="showDetailPostBtn" class="small-primary-btn text-nowrap">Edit Job</button>
                        </form>
                        <form method="get" action="./viewUserAppliedTable.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                            <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                            <button type="submit" name="showDetailPostBtn" class="small-secondary-btn text-nowrap">View Applied
                                Users</button>
                        </form>
                        <form method="get" action="./deletePostedJobs.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                            <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                            <button type="submit" name="showDetailPostBtn" class="small-optional-btn text-nowrap">Delete Job</button>
                        </form>
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