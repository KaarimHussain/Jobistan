<h1?php include('./Includes/sessionStart.php'); if (!isset($_SESSION['logged'])) { header("Location: index.php"); exit(); } if ($_SESSION['logged']['role']=='worker' ) { header("Location: profile.php"); exit(); } include("./Includes/db.php"); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Job Post - Jobistan</title>
        <?php
        include("./Includes/bootstrapCss.php");
        include("./Includes/Icons.php");
        ?>
        <link rel="stylesheet" href="Styles/main.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="Styles/createJobPost.css?v=<?php echo time(); ?>">
    </head>

    <body>
        <main class="full-h gradient-primary-bg py-5">
            <div class="container">
                <a href="profile.php" class="text-white text-decoration-none fs-3"><i class="bi bi-arrow-left-circle-fill"></i> Go Back</a>
                <h1 class="display-5 text-center text-white my-5">Create Post</h1>
                <form method="post" action="./processJobListing.php" class="row">
                    <div class="col-12 mb-5">
                        <input type="text" required placeholder="Job Title..." name="job-title" class="postJobInput col-12 fs-2">
                    </div>
                    <div class="col-12 mb-5">
                        <input type="text" required placeholder="Job Description..." name="job-description" class="postJobInput col-12 fs-4">
                    </div>
                    <div class="col-12 mb-5">
                        <input type="text" required placeholder="Job Requirement..." name="job-requirement" class="postJobInput col-12 fs-4">
                    </div>
                    <div class="col-12 mb-5">
                        <select name="location" required class="postJobInput col-md-6 fs-4 text-white" data-bs-theme="white">
                            <option selected disabled>Select Location</option>
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
                    <div class="col-12 mb-5 d-flex gap-3 mb-4 align-items-center">
                        <label for="JobType" class="text-secondary fs-4">Job Type</label>
                        <br>
                        <div>
                            <small class="text-white fs-6">Full Time</small>
                            <input type="radio" required checked name="jobType" class="form-check-input" value="full-time">
                        </div>
                        <div>
                            <small class="text-white fs-6">Part Time</small>
                            <input type="radio" required name="jobType" class="form-check-input" value="part-time">
                        </div>
                        <div>
                            <small class="text-white fs-6">Remote</small>
                            <input type="radio" required name="jobType" class="form-check-input" value="remote">
                        </div>
                        <div>
                            <small class="text-white fs-6">Hybird</small>
                            <input type="radio" required name="jobType" class="form-check-input" value="hybird">
                        </div>
                        <div>
                            <small class="text-white fs-6">Intern</small>
                            <input type="radio" required name="jobType" class="form-check-input" value="hybird">
                        </div>
                    </div>
                    <div class="col-12 mb-5">
                        <input type="text" required name="experience" class="postJobInput fs-4 col-12" placeholder="Job Experience...">
                    </div>
                    <div class="col-12 mb-5">
                        <input type="number" required name="salary" class="postJobInput fs-4 col-12" placeholder="Salary...">
                    </div>
                    <div class="col-12 mb-5">
                        <textarea name="tags" required placeholder="Additional Tags..." class="postJobInput fs-4 col-12"></textarea>
                    </div>
                    <button name="createJobPostBtn" class="primary-btn col-12" type="submit">Create Job Post</button>
                </form>
            </div>
        </main>
    </body>

    </html>