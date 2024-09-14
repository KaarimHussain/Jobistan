<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    $_SESSION['register_error'] = "You need to create an account or login first";
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include("./navbar.php");
    ?>
    <main class="full-h">
        <div class="container mb-3 py-5">
            <h1 class="text-start display-6 fw-bold">Hello! <span id="heading-gradient-background" class="fw-light"><?php echo $_SESSION['logged']['username']; ?></span>,
            </h1>
            <p class="secondary-color">
                <i class="bi bi-info-circle-fill"></i> We're here to help
            </p>
        </div>
        <div class="primary-bg py-5">
            <div class="container">
                <h5 class="optional-color fw-semibold">Recommended Help</h5>
                <div class="accordion my-5" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <a class="accordion-button collapsed text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                How to Change or Update Username or Password?
                            </a>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                To update your credentials, navigate to the Settings Page and select the General Tab. Here, you can update your necessary information.
                                <br>
                                <strong>
                                    <small>
                                        Note: Before changing your password, ensure you remember your current password.
                                    </small>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <a class="accordion-button collapsed text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Jobistan Public Profile Visiblity
                            </a>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                To manage the visibility of your profile, navigate to the Settings page and select the Privacy tab. Here, you will find a switch labeled "Profile Visibility." Use this switch to toggle your profile visibility on or off as needed.
                                <br>
                                <strong>
                                    <small>
                                        Note: Profile visibility is enabled by default.
                                    </small>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <a class="accordion-button collapsed text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Apply for Jobs on Jobistan
                            </a>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                We strive to make your job search experience seamless and efficient. Simply visit our Job page to explore all available opportunities. Use our advanced filtration feature to refine your search and find jobs that match your criteria.
                                <br>
                                Click the "Details" button on a job listing to view comprehensive information, including job descriptions and qualifications. If you find a job that interests you, click "Apply." Once you submit your application, we will handle the rest, ensuring your request is forwarded to the respective company.
                                <br>
                                <strong>
                                    <small>
                                        Please note: You need to log in before searching for jobs.
                                    </small>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="secondary-bg py-5">
            <div class="container">
                <h5 class="optional-color fw-semibold">Suggested Articals</h5>
                <div class="row my-5">
                    <div class="col-12 mb-5">
                        <p class="text-white">Resume Builder</p>
                        <hr class="primary-color">
                        <small class="optional-color">
                            Firstly, navigate to the Settings Page. Then, locate and click on the App Settings tab. This will expand to show additional options. Among these options, you will find the link or button to build your resume. Click on it to be directed to a new page where you can create your resume and choose from one of our provided <b>(ATS Friendly)</b> templates. Fill in the necessary information to create an appealing resume, then click the finish button. Your resume will be ready for download and can also be uploaded to the website.
                        </small>
                    </div>
                    <div class="col-12 mb-5">
                        <p class="text-white">Community</p>
                        <hr class="primary-color">
                        <small class="optional-color">
                            In the provided navigation bar, you will find a tab labeled <b>"Community"</b>. Click on it to navigate to the Community page, where you can view, like, create, update, and delete posts. The Community page features posts from both workers and companies. Visit it often, as you may find useful information related to your job or profession.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="optional-bg py-5">
            <div class="container">
                <h1 class="fw-bold secondary-text text-center">Frequently Asked Questions (FAQ's)</h1>
                <div class="row my-5">
                    <!-- Add the Content of Frequently Asked Questions from the DOCX file provided by Ubaid -->
                    <div class="col-12 mb-4">
                        <h3 class="secondary-text">General Questions</h3>
                    </div>
                    <hr>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">What is Jobistan?</h4>
                        <p class="secondary-color">
                            Jobistan.pk is a comprehensive job platform designed to connect job seekers with employers across Pakistan. We provide a wide range of job listings, resume-building tools, and career resources to help you find the perfect job.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">How do I create an account on Jobistan.pk?</h4>
                        <p class="secondary-color">
                            To create an account, click on the "Sign Up" button at the top right corner of the homepage. Fill in your details and follow the instructions to complete the registration process.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">Is Jobistan.pk free to use?</h4>
                        <p class="secondary-color">
                            Yes, Jobistan.pk is free for job seekers. You can browse job listings, apply for jobs, and use our resume-building tools without any cost.
                        </p>
                    </div>
                    <!--  -->
                    <hr>
                    <div class="col-12 mb-4">
                        <h3 class="secondary-text">Job Applications</h3>
                    </div>
                    <hr>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">How do I apply for a job?</h4>
                        <p class="secondary-color">
                            To apply for a job, log in to your account, browse the job listings, and click on the job you are interested in. Follow the instructions on the job posting to submit your application.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">Can I track the status of my job application?</h4>
                        <p class="secondary-color">
                            Yes, you can track the status of your job application by logging into your account and visiting the "My Applications" section.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">What should I do if I encounter issues while applying for a job?</h4>
                        <p class="secondary-color">
                            If you face any issues while applying for a job, please contact our support team at support@jobistan.pk for assistance.
                        </p>
                    </div>
                    <!--  -->
                    <hr>
                    <div class="col-12 mb-4">
                        <h3 class="secondary-text">Resume Building</h3>
                    </div>
                    <hr>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">How do I create a resume on Jobistan.pk?</h4>
                        <p class="secondary-color">
                            To create a resume, log in to your account and navigate to the "Setting" section and after that click on the Tab called App Settings. Follow the prompts to enter your information and build your professional resume.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">Can I download my resume after creating it?</h4>
                        <p class="secondary-color">
                            Yes, you can download your resume in .docx format after creating it. This allows you to share it with potential employers easily.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">Are there resume templates available?</h4>
                        <p class="secondary-color">
                            Yes, we offer a variety of professional resume templates for you to choose from. You can select a template that best suits your career goals and customize it with your information.
                        </p>
                    </div>
                    <!--  -->
                    <hr>
                    <div class="col-12 mb-4">
                        <h3 class="secondary-text">Employer Questions</h3>
                    </div>
                    <hr>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">How can I post a job on Jobistan.pk?</h4>
                        <p class="secondary-color">
                            To post a job, you need to create an recuiter account. Once registered, log in and navigate to the "Company Profile" and then you will find the button called create Post. Click on it. Fill in the job details and submit your posting for review.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">What are the costs associated with posting a job?</h4>
                        <p class="secondary-color">
                            Money is not required for posting jobs. You just need to publish the jobs with the details. Not a single penny is required
                        </p>
                    </div>
                    <hr>
                    <div class="col-12 mb-4">
                        <h3 class="secondary-text">Technical Support</h3>
                    </div>
                    <hr>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">I forgot my password. How can I reset it?</h4>
                        <p class="secondary-color">
                            To reset your password, click on the "Forgot Password" link on the login page. Enter your registered email address, and follow the instructions sent to your email to reset your password.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">How can I contact customer support?</h4>
                        <p class="secondary-color">
                            You can contact our customer support team by emailing jobistan.karachi.pk@gmail.com or calling us at +92-123-4567890 during our office hours.
                        </p>
                    </div>
                    <hr>
                    <div class="col-12 mb-4">
                        <h3 class="secondary-text">Miscellaneous</h3>
                    </div>
                    <hr>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">How do I update my profile information?</h4>
                        <p class="secondary-color">
                            To update your profile information, log in to your account and go to the "Profile" section. Make the necessary changes and save your updated information.
                        </p>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="semibold secondary-text">How can I unsubscribe from email notifications?</h4>
                        <p class="secondary-color">
                            To unsubscribe from email notifications, click on the "Unsubscribe" link at the bottom of any email you receive from us or adjust your email preferences in the "Settings" section of your account.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("./footer.php");
    include("./Includes/bootstrapJs.php");
    include("./Includes/jQuery.php");
    ?>
</body>

</html>