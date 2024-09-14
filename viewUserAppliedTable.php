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
    ?>
    <main class="full-h optional-bg py-5">
        <div class="container">
            <a href="./companyViewPostedJobs.php?" class="text-decoration-none secondary-color fs-5">
                <i class="bi bi-arrow-left-circle-fill"></i> Go Back
            </a>
            <h1 id="heading-gradient-background" class="text-center display-4 mb-5">Applied Users</h1>
            <div class="my-4 text-center">
                <!-- <button class="small-secondary-btn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#filterSearching" aria-controls="filterSearching">
                    <i class="bi bi-rocket-takeoff-fill"></i> Try Rocket Searching
                </button> -->
                <!-- Filter SideNav -->
                <div class="offcanvas offcanvas-start" data-bs-theme="dark" tabindex="-1" id="filterSearching"
                    aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter <i class="bi bi-funnel-fill"></i>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body py-5">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex flex-column gap-1">
                                <label>Job Title</label>
                                <input type="text" id="title" class="form-control">
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <label>Job Experience</label>
                                <input type="range" min="0" max="6" id="experience" class="form-control" value="0">
                                <span>Experience :<span id="exp_dets">Fresher</span></span>
                                <input type="hidden" class="exp_input" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
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
                    <tbody id="responseApplied" data-job-id="<?php echo $job_id; ?>">
                        <?php
                        include('./Includes/db.php');
                        include('./Classes/PostedJobs.php');
                        $postedJobs = new PostedJobs($conn);
                        $job = $postedJobs->selectAppliedJobUsers($job_id);
                        $base = new Select($conn);
                        $jobTitle = $base->SelectJobsForScheduleInterView($job_id);
                        if (!empty($job)) {
                            $index = 1;
                            foreach ($job as $jobs) {
                                $interviewStatus = $postedJobs->checkInterviewStatus($job_id, $jobs['user_id']);
                                if ($interviewStatus != 'interview_on') {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $index; ?></th>
                                        <td><?php echo htmlspecialchars($jobs['username']); ?></td>
                                        <td><?php echo htmlspecialchars($jobs['email']); ?></td>
                                        <td class="d-flex flex-lg-row flex-md-column flex-colum gap-2 justify-content-end">
                                            <a href="./tempUserProfile.php?user_id=<?php echo htmlspecialchars($jobs['user_id']) ?>&job_id=<?php echo $job_id; ?>"
                                                class="small-primary-btn text-nowrap text-decoration-none">View Details</a>
                                            <a class="small-secondary-btn text-nowrap text-decoration-none cursor-pointer"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal<?php echo $jobs['user_id']; ?>">Schedule Interview</a>
                                            <a href="./deleteUserSelectedTable.php?user_id=<?php echo htmlspecialchars($jobs['user_id']) ?>&job_id=<?php echo $job_id; ?>"
                                                class="small-optional-btn text-nowrap text-decoration-none">Reject</a>
                                        </td>
                                    </tr>
                                    <!-- User Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $jobs['user_id']; ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel<?php echo $jobs['user_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel<?php echo $jobs['user_id']; ?>">
                                                        Schedule Interview</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form class="modal-body p-0" method="post" action="processInterview.php">
                                                    <div class="container mb-5">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <input type="hidden" name="user_id"
                                                                    value="<?php echo htmlspecialchars($jobs['user_id']); ?>">
                                                                <input type="hidden" name="job_id"
                                                                    value="<?php echo htmlspecialchars($jobs['job_id']); ?>">
                                                                <input type="hidden" name="username"
                                                                    value="<?php echo htmlspecialchars($jobs['username']); ?>">
                                                                <input type="hidden" name="email"
                                                                    value="<?php echo htmlspecialchars($jobs['email']); ?>">
                                                                <label for="job_title">Job Title</label>
                                                                <input type="text" required
                                                                    value="<?php echo htmlspecialchars($jobTitle[0]['title']) ?? htmlspecialchars($jobTitle['title']); ?>"
                                                                    class="form-control" name="job_title" readonly>
                                                            </div>
                                                            <div class="col-12 my-2">
                                                                <label for="description">Interview Description</label>
                                                                <textarea type="text" required class="form-control"
                                                                    name="description"
                                                                    placeholder="Write a brief description..."></textarea>
                                                            </div>
                                                            <div class="col-12 my-2">
                                                                <label for="date">Interview Date</label>
                                                                <input type="date" required name="date" class="form-control"
                                                                    id="interviewDate">
                                                            </div>

                                                            <script>
                                                                var today = new Date().toISOString().split('T')[0];
                                                                document.getElementById("interviewDate").setAttribute('min', today);
                                                            </script>

                                                            <div class="col-12 my-2">
                                                                <label for="time">Interview Time</label>
                                                                <input type="time" required name="time" class="form-control">
                                                            </div>
                                                            <div class="col-12 my-2">
                                                                <button type="submit" name="sendInterviewRequestBtn"
                                                                    class="btn btn-primary col-12">Confirm
                                                                    Interview <i class="bi bi-send-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo "";
                                }
                            }
                            $index++;
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
    include('./Includes/jQuery.php');
    include('./Includes/bootstrapJs.php');
    ?>
    <!-- <script src="./Scripts/appliedUsers.js?v=<?php echo time(); ?>"></script> -->
    <!-- <script>
        $(document).ready(function () {
            var exp_dets = $('#exp_dets');
            var range = $('#experience');
            var exp_input = $('.exp_input');
            $(range).on('input', function () {
                switch ($(this).val()) {
                    case "0":
                        exp_dets.text('Fresher');
                        exp_input.val('fresher');
                        break;
                    case "1":
                        exp_dets.text('Less than 1 Year');
                        exp_input.val('0.5');
                        break;
                    case "2":
                        exp_dets.text('1+ Years');
                        exp_input.val('1');
                        break;
                    case "3":
                        exp_dets.text('3+ Years');
                        exp_input.val('3');
                        break;
                    case "4":
                        exp_dets.text('5+ Years');
                        exp_input.val('5');
                        break;
                    case "5":
                        exp_dets.text('10+ Years');
                        exp_input.val('10');
                        break;
                    case "6":
                        exp_dets.text('15+ Years');
                        exp_input.val('15');
                        break;
                    default:
                        exp_dets.text('Fresher');
                        exp_input.val('fresher');
                        break;
                }
            })
        });
    </script> -->
</body>

</html>