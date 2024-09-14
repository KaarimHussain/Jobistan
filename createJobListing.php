<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'worker') {
    header("Location: profile.php");
    exit();
}
include("./Includes/db.php"); ?>
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
    <?php
    include('./AI.php');
    ?>
    <main class="full-h optional-bg py-5">
        <div class="container">
            <a href="profile.php" class="secondary-color text-decoration-none fs-3"><i
                    class="bi bi-arrow-left-circle-fill"></i> Go Back</a>
            <h1 class="display-5 text-center my-5" id="heading-gradient-background">Create Post</h1>
            <form method="post" action="./processJobListing.php" class="row">
                <div class="col-12 mb-5">
                    <input type="text" required placeholder="Job Title..." name="job-title"
                        class="postJobInput secondary-color col-12 fs-2">
                </div>
                <div class="col-12 mb-5">
                    <!-- <label class="col-12 mb-3">Vicancies/Canidate
                        Count</label> -->
                    <input type="number" name="required_candidate"
                        class="postJobInput secondary-color col-12 fs-4 border-0" placeholder="Required Candidate..."
                        id="numberInput" oninput="preventDecimal(this)">
                </div>
                <div class="col-12 mb-5">
                    <textarea type="text" required rows="4" placeholder="Job Description..." name="job-description"
                        class="postJobInput secondary-color col-12 fs-4 resize-none"></textarea>
                </div>
                <div class="col-12 mb-5">
                    <textarea type="text" required rows="4" placeholder="Job Requirement..." name="job-requirement"
                        class="postJobInput secondary-color col-12 fs-4 resize-none"></textarea>
                </div>
                <div class="col-12 mb-5">
                    <select name="location" required class="postJobInput secondary-color bg-none fs-3"
                        data-bs-theme="white">
                        <option selected class="text-dark" value="Karachi">Karachi</option>
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
                    <label for="JobType" class="secondary-color fs-4">Job Type</label>
                    <br>
                    <div>
                        <small class="secondary-color fs-6">Full Time</small>
                        <input type="radio" required checked name="jobType" class="form-check-input" value="full-time">
                    </div>
                    <div>
                        <small class="secondary-color fs-6">Part Time</small>
                        <input type="radio" required name="jobType" class="form-check-input" value="part-time">
                    </div>
                    <div>
                        <small class="secondary-color fs-6">Remote</small>
                        <input type="radio" required name="jobType" class="form-check-input" value="remote">
                    </div>
                    <div>
                        <small class="secondary-color fs-6">Hybird</small>
                        <input type="radio" required name="jobType" class="form-check-input" value="hybird">
                    </div>
                    <div>
                        <small class="secondary-color fs-6">Intern</small>
                        <input type="radio" required name="jobType" class="form-check-input" value="intern">
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <select name="experience" class="w-full secondary-color postJobInput fs-3">
                        <option class="text-dark" value="fresher" selected>Fresher</option>
                        <option class="text-dark" value="less_1">Less then 1 Year</option>
                        <option class="text-dark" value="1">1+ Years</option>
                        <option class="text-dark" value="3">3+ Years</option>
                        <option class="text-dark" value="5">5+ Years</option>
                        <option class="text-dark" value="10">10+ Years</option>
                        <option class="text-dark" value="15">15+ Years</option>
                    </select>
                </div>
                <div class="col-12 mb-5">
                    <input type="number" required name="salary" class="postJobInput secondary-color fs-4 col-12"
                        placeholder="Salary...">
                </div>
                <div class="col-12 mb-5">
                    <textarea name="tags" data-bs-placement="top" data-bs-title="The Length is 70"
                        data-bs-toggle="tooltip" required placeholder="Additional Tags..."
                        class="postJobInput secondary-color fs-4 col-12" maxlength="70"></textarea>
                    <br>
                    <div class="text-center">
                        <small class="secondary-color">The Maximum length of Additional Tag is 70</small>
                    </div>
                </div>
                <button name="createJobPostBtn" class="primary-btn col-12" type="submit">Create Job Post</button>
            </form>
        </div>
    </main>
    <?php
    include('./Includes/bootstrapJs.php');
    include('./Includes/jQuery.php');
    include('./Includes/chatbot.php');
    ?>
    <script>
        function preventDecimal(input) {
            // Ensure that the value is an integer by using parseInt and set the value accordingly
            input.value = input.value.replace(/[^0-9]/g, '');
        }
    </script>
</body>

</html>
