<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide | Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/userGuide.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include('./navbar.php');
    ?>
    <main class="optional-bg full-h py-5">
        <img id="followImage" src="" alt="">
        <div class="container">
            <div class="col-12 text-center">
                <span class="text-center display-5"><span id="greetTag" class="fw-bolder"></span>!
                    <span class="fw-light" id="heading-gradient-background"> Welcome to User Guide</span>
                </span>
            </div>
            <div class="row my-5">
                <div class="col-12 mb-5">
                    <p class="fw-semibold text-center">
                        This comprehensive guide provides step-by-step instructions on how to
                        effectively navigate and utilize all features of our website. Whether you're a new user or
                        familiar with the platform, you'll find valuable insights and tips to make the most out of your
                        experience.
                    </p>
                </div>
                <hr>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        1) User Authentication and Profiles
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">1.1) User Registration and Login</h5>
                    <ul class="">
                        <li>Learn how to create a secure account, whether you’re a job seeker or employer.</li>
                        <li>Utilize social media logins such as LinkedIn or Google for a quicker sign-up process.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">1.2) Managing Your Profile</h5>
                    <ul>
                        <li><b>For Job Seekers: </b>Set up your detailed profile with a resume, skills, work experience,
                            and education history.</li>
                        <li><b>For Employers: </b>Create a company profile showcasing your organization’s culture,
                            benefits, and job openings.</li>
                        <li><b>Privacy Settings: </b>Control the visibility of your profile to keep your job search
                            discreet.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        2) Job Search and Listings
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">2.1) Advanced Job Search</h5>
                    <ul class="">
                        <li>Use filters to narrow down jobs by location, industry, job type (e.g., full-time, part-time,
                            remote), experience level, and salary range.</li>
                        <li>Use keyword searches and sort job listings by relevance, date, or other criteria.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">2.2) Exploring Job Listings</h5>
                    <ul class="">
                        <li>Discover detailed job postings with clear descriptions, requirements, and application
                            procedures.</li>
                        <li>Utilize job tags and categories to explore similar opportunities quickly.
                        </li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        3) Application Management
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">3.1) Application Tracking</h5>
                    <ul class="">
                        <li>Job seekers can track their application status directly from their dashboard.</li>
                        <li>Employers can manage their job postings and review applications in an organized manner.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">3.2) Job Alerts</h5>
                    <ul class="">
                        <li>Set up personalized job alerts and receive email notifications for new jobs matching your
                            profile.</li>
                        <li>Save your search criteria and get recommendations based on your preferences.
                        </li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        4) Communication Tools
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">4.1) Messaging System</h5>
                    <ul class="">
                        <li>Use our built-in messaging system to communicate directly with potential employers or
                            candidates.</li>
                        <li>All messages are encrypted to ensure secure communication.</li>
                        <li>Receive email notifications when you have new messages.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        5) Additional Features
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">5.1) Resume Builder</h5>
                    <ul class="">
                        <li>Access our easy-to-use resume builder with customizable templates and tips.</li>
                        <li>Save and update your resume directly from your dashboard.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">5.2) Interview Scheduler (Upcoming Feature) </h5>
                    <ul class="">
                        <li>Employers and job seekers will soon be able to schedule interviews directly on our platform.
                        </li>
                        <li>Features like calendar sync and reminders will help you stay on track.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">5.3) Dashboards for Personalized Management</h5>
                    <ul class="">
                        <li>
                            <b>For Job Seekers: </b>
                            Manage your profile, applications, and saved jobs from your personal dashboard.
                        </li>
                        <li><b>For Employers: </b>Post new job openings, manage listings, and review candidate
                            applications seamlessly.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        6) Security and Privacy
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">6.1) Data Security</h5>
                    <ul class="">
                        <li>Your data is securely stored with encryption and regular security updates.</li>
                        <li>We follow industry best practices to ensure your information is protected.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">6.2) Privacy Controls </h5>
                    <ul class="">
                        <li>Customize the visibility of your profile and control who can see your information.</li>
                        <li>Review our privacy policy and manage your consent preferences.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">6.3) Advanced Security Authentication</h5>
                    <ul class="">
                        <li>
                            All users benefit from two-factor authentication, including email OTP verification.
                        </li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        7) User Experience
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">7.1) Responsive Design</h5>
                    <ul class="">
                        <li>Enjoy a seamless experience whether you’re using a desktop, tablet, or mobile device.</li>
                        <li>Experience quick load times and user-friendly navigation.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">7.2) Feedback and Support</h5>
                    <ul class="">
                        <li>Share your feedback on job listings and the overall experience.</li>
                        <li>We continually improve based on user input and provide prompt support. </li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        8) Analytics and Reporting
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">8.1) Analytics Dashboard</h5>
                    <ul class="">
                        <li>Both job seekers and employers can access valuable insights and analytics.</li>
                        <li>Employers can track application rates and other key metrics.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">8.2) Reports</h5>
                    <ul class="">
                        <li>Generate customized reports to track recruitment trends or monitor application progress.
                        </li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        9) Integration and APIs (Upcoming Features)
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">9.1) Job's Data from Different Portals</h5>
                    <ul class="">
                        <li>Soon, you’ll be able to integrate with popular job portals like LinkedIn and Indeed.</li>
                        <li>Developers will have access to our API for custom integrations.</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <h2 class="fw-light" id="heading-gradient-background">
                        10) AI-Powered Features
                    </h2>
                </div>
                <div class="col-12 mb-3">
                    <h5 class="fw-bold secondary-color">10.1) AI Image Detection</h5>
                    <ul class="">
                        <li>Benefit from advanced AI-powered image detection tools integrated into our platform for a
                            more secure and professional experience.</li>
                    </ul>
                    <h5 class="fw-bold secondary-color">10.2) AI ChatBot</h5>
                    <ul class="">
                        <li>Generating Summary, Content, Description, etc have never been this easier with out Jet Bot
                            with easy to use interface with No Cost</li>
                    </ul>
                </div>
                <hr>
                <div class="col-12 my-5 text-center">
                    <small class="text-center secondary-text">By following this guide, you’ll be well-equipped to
                        navigate and utilize all the powerful features of <b>JOBISTAN</b>, whether you’re looking to
                        find your dream job or hire top talent. If you need further assistance, our support team is here
                        to help!
                    </small>
                </div>
            </div>
        </div>
    </main>
    <?php
    include('./footer.php');
    include("./Includes/bootstrapJs.php");
    include("./Includes/jQuery.php");
    ?>
    <script>
        $(document).ready(function () {
            // Function to set a random greeting
            randomGreetings();
            function randomGreetings() {
                var randomGreetArry = [
                    "Hello",
                    "Bonjor",
                    "Hola",
                    "Ciao",
                    "Guten Tag",
                    "Good morning",
                    "Salve",
                ];
                var greetTag = document.getElementById('greetTag');
                var randomGreet = Math.floor(Math.random() * randomGreetArry.length);
                greetTag.textContent = randomGreetArry[randomGreet];
            }

            const headingTags = document.querySelectorAll('#heading-gradient-background');
            const imgElement = document.getElementById('followImage');

            // Image paths for each heading
            const imagePaths = {
                "1) User Authentication and Profiles": "./ScreenShots/login.png",
                "2) Job Search and Listings": "./ScreenShots/home.png",
                "3) Application Management": "./ScreenShots/settings.png",
                "4) Communication Tools": "./ScreenShots/messaging-send-message.png",
                "5) Additional Features": "./ScreenShots/company-posted-jobs.png",
                "6) Security and Privacy": "./ScreenShots/login-through-img.png",
                "7) User Experience": "./ScreenShots/index.png",
                "8) Analytics and Reporting": "./ScreenShots/analytics.png",
                "9) Integration and APIs (Upcoming Features)": "./ScreenShots/upcoming.jpeg",
                "10) AI-Powered Features": "./ScreenShots/chatbot.png"
            };

            headingTags.forEach(heading => {
                heading.addEventListener("mouseenter", function () {
                    // Get the heading text content and trim it to match the key in imagePaths
                    const headingText = heading.textContent.trim();

                    // Set the image source based on the heading
                    if (imagePaths[headingText]) {
                        imgElement.src = imagePaths[headingText];
                    }
                    // Make the image visible
                    imgElement.style.opacity = 1;
                });
                heading.addEventListener("mouseleave", function () {
                    // Hide the image when the mouse leaves
                    imgElement.style.opacity = 0;
                });
            });

            // Update the image position to follow the mouse cursor
            document.addEventListener('mousemove', (event) => {
                imgElement.style.left = event.pageX + 'px';
                imgElement.style.top = event.pageY + 'px';
            });
        });
    </script>


</body>

</html>