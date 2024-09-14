<?php
include('./Includes/sessionStart.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // sleep(2);
    include('./Includes/db.php');
    include('./Classes/Base.php');

    $searchBar = isset($_POST['searchBarVal']) ? $_POST['searchBarVal'] : '';
    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
    $jobArea = isset($_POST['jobArea']) ? $_POST['jobArea'] : '';
    $jobTitle = isset($_POST['jobTitle']) ? $_POST['jobTitle'] : '';
    $jobSalary = isset($_POST['jobSalary']) ? $_POST['jobSalary'] : '';

    $clause = 'WHERE 1=1'; // Initialize clause with a default condition

    // Handling search bar input
    if (!empty($searchBar)) {
        $searchBar = $conn->real_escape_string($searchBar); // Sanitize input
        $clause .= " AND job_listings.title LIKE '%$searchBar%'";
    }
    if (!empty($jobArea)) {
        $clause .= " AND job_listings.location LIKE '%$jobArea%'";
    }
    if (!empty($jobTitle)) {
        $clause .= " AND job_listings.title LIKE '%$jobTitle%'";
    }
    if (!empty($jobSalary)) {
        $clause .= " AND job_listings.salary_range > $jobSalary";
    }
    // Handling job type filters
    $jobTypeFilters = array_filter($filters, function ($filter) {
        return !is_numeric($filter);
    });

    if (!empty($jobTypeFilters)) {
        $jobTypeFilters = array_map([$conn, 'real_escape_string'], $jobTypeFilters); // Sanitize each filter value
        $filterClause = implode("','", $jobTypeFilters);
        $clause .= " AND job_listings.job_type IN ('$filterClause')";
    }

    $mainClass = new Select($conn);
    $jobs = $mainClass->SelectAllJobsWithCompany($clause);

    if (!empty($jobs)) {
        foreach ($jobs as $job) {
            $createdAt = new DateTime($job['created_at']);
            $formattedDate = $createdAt->format('F j, Y');
            $jobStatus = $mainClass->showJobStatus($job['job_id']);
            ?>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 col-12 mb-4">
                <div class="jobCardsContainer">
                    <div class="jobCardInnerTop bg-cool1">
                        <div
                            class="d-flex justify-content-lg-between justify-content-md-center justify-content-center flex-lg-row flex-md-column flex-column align-items-center">
                            <div class="py-2 px-3 text-center bg-white rounded-pill text-dark">
                                <small class="fw-bold">
                                    <?php echo htmlspecialchars($formattedDate); ?>
                                </small>
                            </div>
                            <div class="py-2 px-3 text-center bg-white rounded-pill text-dark">
                                <small class="fw-bold" style="font-size:12px;">
                                    Status:
                                    <?php echo $jobStatus['job_status']; ?>
                                </small>
                            </div>
                        </div>
                        <div class="my-3">
                            <small class="fw-bold"><?php echo htmlspecialchars($job['company_name']); ?></small>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-light"><?php echo htmlspecialchars($job['title']); ?></h4>
                                <img src="<?php echo htmlspecialchars($job['company_logo']); ?>"
                                    class="rounded-circle object-fit-cover object-position-center" height="70" width="70"
                                    alt="<?php echo htmlspecialchars($job['company_name']); ?>">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div>
                                <small
                                    class="text-nowrap fw-semibold text-body-secondary"><?php echo strtoupper(htmlspecialchars($job['job_type'])) ?>
                                    | </small>
                                <br>
                                <small class="text-body-secondary d-inline-flex align-items-center fw-semibold text-truncate"
                                    style="max-width:100%;">
                                    <?php echo htmlspecialchars($job['tags']); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="jobCardInnerBottom px-3 py-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <p class="fw-bolder">
                                <?php echo number_format(htmlspecialchars($job['salary_range']), 0, '.', ',') . " PKR"; ?>
                            </p>
                            <small class="text-secondary fw-semibold"><?php echo htmlspecialchars($job['location']); ?></small>
                        </div>
                        <form method="get" action="./viewPostDetails.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>">
                            <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                            <button type="submit" name="showDetailPostBtn" class="primary-btn">Details</button>
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