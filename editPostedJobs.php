<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_GET['job_id'])) {
    header("Location: index.php");
    exit();
}
$job_id = $_GET['job_id'];
include ('./Includes/db.php');
include ('./Classes/PostedJobs.php');
$JobData = new PostedJobs($conn);
$jobs = $JobData->fetchAllJobPostWithID($job_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit your Job Post - Jobistan</title>
    <?php
    include ('./Includes/bootstrapCss.php');
    include ('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/input.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include ('./navbar.php');
    ?>
    <main class="optional-bg py-5">
        <div class="container">
            <h1 id="heading-gradient-background" class="text-center">Edit your Job</h1>
            <form method="post" action="./processEditPostedJobs.php" class="row">
                <input type="hidden" name="job_id" value="<?php echo $jobs[0]['id']; ?>">
                <div class="col-12 mb-3 d-flex align-items-center flex-column">
                    <div class="col-md-6">
                        <label for="title" class="col-12">Job Title</label>
                        <input type="text" name="title" placeholder="Job Title..."
                            value="<?php echo $jobs[0]['title']; ?>" required class="input-primary bg-white col-12">
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex align-items-center flex-column">
                    <div class="col-md-6">
                        <label for="description" class="col-12">Job Description</label>
                        <textarea rows="4" name="description" placeholder="Job Description..." required
                            class="resize-none input-primary bg-white col-12"><?php echo $jobs[0]['description']; ?></textarea>
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex align-items-center flex-column">
                    <div class="col-md-6">
                        <label for="requirement" class="col-12">Job Requirements</label>
                        <input type="text" name="requirement" placeholder="Job Requirement..."
                            value="<?php echo $jobs[0]['requirements']; ?>" required
                            class="input-primary bg-white col-12">
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex align-items-center flex-column">
                    <div class="col-md-6">
                        <label for="title" class="col-12">Job Location</label>
                        <div class="col-12 mb-5">
                            <select name="location" required class="input-primary bg-white col-12 text-dark"
                                data-bs-theme="white">
                                <option selected><?php echo $jobs[0]['location']; ?></option>
                                <option class="text-dark" value="Karachi">Karachi</option>
                                <option class="text-dark" value="Lahore">Lahore</option>
                                <option class="text-dark" value="Islamabad">Islamabad</option>
                                <option class="text-dark" value="Multan">Multan</option>
                                <option class="text-dark" value="Gujranwala">Gujranwala</option>
                                <option class="text-dark" value="Rawalpindi">Rawalpindi</option>
                                <option class="text-dark" value="Peshawar">Peshawar</option>
                                <option class="text-dark" value="Quetta">Quetta</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex align-items-center flex-column">
                    <div class="col-12 d-flex flex-column gap-3 align-items-center">
                        <label for="JobType" class="fs-5">Job Type</label>
                        <br>
                        <div class="d-flex gap-3">
                            <div>
                                <small class="text-dark fs-6">Full Time</small>
                                <input type="radio" required checked name="jobType" class="form-check-input"
                                    value="full-time">
                            </div>
                            <div>
                                <small class="text-dark fs-6">Part Time</small>
                                <input type="radio" required name="jobType" class="form-check-input" value="part-time">
                            </div>
                            <div>
                                <small class="text-dark fs-6">Remote</small>
                                <input type="radio" required name="jobType" class="form-check-input" value="remote">
                            </div>
                            <div>
                                <small class="text-dark fs-6">Hybird</small>
                                <input type="radio" required name="jobType" class="form-check-input" value="hybird">
                            </div>
                            <div>
                                <small class="text-dark fs-6">Intern</small>
                                <input type="radio" required name="jobType" class="form-check-input" value="hybird">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex align-items-center flex-column">
                    <div class="col-md-6">
                        <label for="experience" class="col-12">Required Experience</label>
                        <input type="text" name="experience" placeholder="Required Experience..." required
                            class="input-primary bg-white col-12" value="<?php echo $jobs[0]['experience_level']; ?>">
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex align-items-center flex-column">
                    <div class="col-md-6">
                        <label for="salary_range" class="col-12">Job Salary</label>
                        <input type="number" name="salary_range" placeholder="Job Salary..."
                            value="<?php echo $jobs[0]['salary_range']; ?>" required
                            class="input-primary bg-white col-12">
                    </div>
                </div>
                <div class="col-12 mb-3 d-flex align-items-center flex-column">
                    <div class="col-md-6">
                        <label for="tags" class="col-12">Additional Tags</label>
                        <input type="text" name="tags" placeholder="Additional Tags..."
                            value="<?php echo $jobs[0]['tags']; ?>" required class="input-primary bg-white col-12">
                    </div>
                </div>
                <div class="my-3 d-flex align-items-center flex-column">
                    <button class="primary-btn col-md-6">Edit Post</button>
                </div>
            </form>
        </div>
    </main>
    <?php
    include ('./footer.php');
    ?>
</body>

</html>