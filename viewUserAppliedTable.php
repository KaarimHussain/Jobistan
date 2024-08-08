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
$postedJobs = new PostedJobs($conn);
$job = $postedJobs->selectAppliedJobUsers($job_id);
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
            <h1 id="heading-gradient-background" class="text-center display-4 mb-5">Applied Users</h1>
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
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $index; ?></th>
                                    <td><?php echo htmlspecialchars($jobs['username']); ?></td>
                                    <td><?php echo htmlspecialchars($jobs['email']); ?></td>
                                    <td class="d-flex flex-lg-row flex-md-column flex-colum gap-2 justify-content-end">
                                        <a href="./tempUserProfile.php?user_id=<?php echo htmlspecialchars($jobs['user_id']) ?>" class="small-primary-btn text-nowrap text-decoration-none">View Details</a>
                                        <a href="#" class="small-secondary-btn text-nowrap text-decoration-none" data-bs-toggle="modal" data-bs-target="#userModal<?php echo $jobs['user_id']; ?>">Schedule Interview</a>
                                        <a href="#" class="small-optional-btn text-nowrap text-decoration-none">Reject</a>
                                    </td>
                                </tr>
                                <!-- User Modal -->
                                <div class="modal fade" id="userModal<?php echo $jobs['user_id']; ?>" tabindex="-1" aria-labelledby="userModalLabel<?php echo $jobs['user_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="fw-light fs-4" id="heading-gradient-background">Schedule Interview</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form class="modal-body p-0" method="post" action="processInterview.php">
                                                <div class="container mb-5">
                                                    <div class="row">
                                                        <div class="col-12 my-2">
                                                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($jobs['email']); ?>">
                                                            <label for="job_title">Job Title</label>
                                                            <input type="text" required value="<?php echo htmlspecialchars($jobTitle[0]['title']); ?>" class="form-control" name="job_title" readonly id="">
                                                        </div>
                                                        <div class="col-12 my-2">
                                                            <label for="description">Interview Description</label>
                                                            <textarea type="text" required class="form-control" name="description" placeholder="Write an brief Description..."></textarea>
                                                        </div>
                                                        <div class="col-12 my-2">
                                                            <label for="date">Interview Date</label>
                                                            <input type="date" required name="date" class="form-control">
                                                        </div>
                                                        <div class="col-12 my-2">
                                                            <label for="time">Interview Time</label>
                                                            <input type="time" required name="time" class="form-control">
                                                        </div>
                                                        <div class="col-12 my-2">
                                                            <button type="submit" class="primary-btn col-12">Conform Interview <i class="bi bi-send-fill"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $index++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4" class="text-center fw-bold fs-5">
                                    No Applied User Found
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
    ?>
</body>

</html>