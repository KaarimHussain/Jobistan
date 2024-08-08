<?php
include("./Includes/sessionStart.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <main class="full-h">
        <div class="container my-5">
            <h1 class="display-4 text-start" id="heading-gradient-background">Introduction</h1>
            <p class="secondary-color">Welcome to Jobistan.pk. We value your privacy and are committed to protecting your personal information. This Privacy Policy outlines the types of information we collect, how we use it, and the steps we take to ensure your data remains safe.</p>
        </div>
        <div class="primary-bg py-5">
            <div class="container">
                <h1 class="fw-bold optional-color">Information We Collect</h1>
                <p class="optional-color">We collect the following types of information:</p>
                <ul>
                    <li class="optional-color"><b>Personal Information:</b> This includes your name, email address, phone number, and other contact details when you register on our site or subscribe to our newsletter.</li>
                    <li class="optional-color"><b>Employment Information:</b> Information related to your employment history, education, skills, and other resume details when you apply for jobs through our platform.</li>
                </ul>
                <br>
                <h1 class="fw-bold optional-color">How We Use Your Information</h1>
                <p class="optional-color">We use the collected information for the following purposes:</p>
                <ul>
                    <li class="optional-color"><b>To Provide and Improve Our Services:</b> To facilitate job applications, communicate with you, and enhance your experience on our platform.</li>
                    <li class="optional-color"><b>To Personalize Your Experience:</b> To tailor the job listings and content you see based on your preferences and interactions.</li>
                    <li class="optional-color"><b>To Communicate with You:</b> To send you updates, newsletters, and other communications related to our services. You can opt out of these communications at any time.</li>
                    <li class="optional-color"><b>For Security and Compliance:</b> To protect our users and ensure compliance with legal obligations.</li>
                </ul>
            </div>
        </div>
        <div class="secondary-bg py-5">
            <div class="container">
                <h1 class="fw-bold text-start optional-color">
                    Sharing your Information
                </h1>
                <p class="optional-color">We do not sell, trade, or otherwise transfer your personal information to outside parties, except in the following circumstances:</p>
                <ul>
                    <li class="optional-color"><b>With Employers:</b> When you apply for a job, your information is shared with the prospective employer.</li>
                    <li class="optional-color"><b>Service Providers:</b> We may share your information with trusted third-party service providers who assist us in operating our website and providing our services.</li>
                    <li class="optional-color"><b>Legal Requirements:</b> If required by law, we may disclose your information to comply with legal obligations or protect our rights and the rights of others.</li>
                </ul>
                <br>
                <h1 class="fw-bold text-start optional-color">
                    Security of Your Information
                </h1>
                <p class="optional-color">We implement a variety of security measures to maintain the safety of your personal information. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee its absolute security.</p>
                <br>
                <h1 class="fw-bold text-start optional-color">
                    Your Consent
                </h1>
                <p class="optional-color">By using our site, you consent to our privacy policy.</p>
                <br>
                <h1 class="fw-bold text-start optional-color">
                    Changes to Our Privacy Policy
                </h1>
                <p class="optional-color">We may update our privacy policy from time to time. We will notify you of any changes by posting the new privacy policy on this page. We encourage you to review this policy periodically for any changes.</p>
                <hr class="primary-color">
                <h3 class="fw-bold text-start optional-color">
                    Contact Us
                </h3>
                <p class="optional-color">
                    If you have any questions regarding this privacy policy, you may contact us using the information below
                </p>
                <small class="optional-color"><b>Email Address</b><a class="primary-color text-decoration-none" href="mailto:jobistan.karachi.pk@gmail.com"> jobistan.karachi.pk@gmail.com</a></small><br>
                <small class="optional-color"><b>Address</b> Karachi, Pakistan</small>
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