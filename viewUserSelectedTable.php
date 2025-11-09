<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
if ($_SESSION['logged']['role'] != 'recruiter') {
    header('Location: home.php');
    exit();
}
if (!isset($_GET['job_id'])) {
    header('Location: companyViewPostedJobs.php');
    exit();
}
$job_id = $_GET['job_id'];
include('./Includes/db.php');
include('./Classes/PostedJobs.php');
include('./Classes/hireRequest.php');
$hire = new HireRequest($conn);
$postedJobs = new PostedJobs($conn);
$job = $postedJobs->selectAllSchedulesInterViews($job_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applied Users - Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include('./navbar.php');
    $base = new Select($conn);
    $jobTitle = $base->SelectJobsWithCompanyWithID($job_id);
    ?>
    <main class="full-h optional-bg py-5">
        <div class="container">
            <a href="./companyViewPostedJobs.php?" class="text-decoration-none secondary-color">
                <i class="bi bi-arrow-left-circle-fill"></i> Go Back
            </a>
            <h1 id="heading-gradient-background" class="text-center display-4 mb-5">Selected Users</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email Address</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($job)) {
                            $index = 1;
                            foreach ($job as $jobs) {
                                $interviewStatus = $postedJobs->checkInterviewStatus($job_id, $jobs['user_id']);
                                if (!$hire->ifUserHiredExist($job_id, $jobs['user_id'])) {
                                    if ($interviewStatus  = 'interview_on') {


                        ?>


                                        <tr>
                                            <th scope="row"><?php echo $index; ?></th>
                                            <td><?php echo htmlspecialchars($jobs['interviewedUser']); ?></td>
                                            <td><?php echo htmlspecialchars($jobs['interviewedEmail']); ?></td>
                                            <td class="d-flex flex-lg-row flex-md-column flex-colum gap-2 justify-content-end">
                                                <a data-bs-toggle="modal" href="#"
                                                    data-bs-target="#hireModal<?php echo $jobs['user_id']; ?>"
                                                    class="small-secondary-btn text-nowrap text-decoration-none">Hire Him</a>
                                                <a href="./companyInbox.php?user_id=<?php echo htmlspecialchars($jobs['user_id']) ?>"
                                                    class="small-secondary-btn text-nowrap text-decoration-none">Send Message</a>
                                                <a href="./tempUserProfile.php?user_id=<?php echo htmlspecialchars($jobs['user_id']) ?>&job_id=<?php echo $job_id; ?>"
                                                    class="small-primary-btn text-nowrap text-decoration-none">View Details</a>
                                                <a href="./deleteUserSelectedTable.php?user_id=<?php echo htmlspecialchars($jobs['user_id']) ?>&job_id=<?php echo $job_id; ?>"
                                                    class="small-optional-btn text-nowrap text-decoration-none">Reject</a>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="hireModal<?php echo $jobs['user_id']; ?>" tabindex="-1"
                                            aria-labelledby="hireModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title fw-light fs-3" id="heading-gradient-background">Confirm
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body secondary-color">
                                                        Are your sure you want to hire
                                                        <b>
                                                        <?php echo htmlspecialchars($jobs['interviewedUser']); ?>                                                        </b>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="small-secondary-btn"
                                                            data-bs-dismiss="modal">Cancel</button>

                                                        <form action="./processSendHireRequest.php" method="post">
                                                            <input type="hidden" name="worker_id"
                                                                value="<?php echo $jobs['user_id']; ?>">
                                                            <input type="hidden" name="emp_id"
                                                                value="<?php echo $_SESSION['logged']['id']; ?>">
                                                            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                                                            <button type="submit" class="small-primary-btn"
                                                                id="confirmDeleteBtn">Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- User Modal -->
                            <?php
                                    } else {
                                        continue;
                                    }
                                    $index++;
                                }
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4" class="text-center fw-bold fs-5">
                                    No Selected User Found
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php
    include('./footer.php');
    include('./Includes/bootstrapJs.php');
    include('./Includes/jQuery.php');
    $conn->close();
    ?>
</body>

</html>