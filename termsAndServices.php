<?php
include("./Includes/sessionStart.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Services | Jobistan</title>
    <?php
    include("./Includes/bootstrapCss.php");
    include("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include('./navbar.php');
    ?>
    <main class="optional-bg py-5">
        <div class="container">
            <div class="row">
                <h1 id="heading-gradient-background" class="display-5">Introduction</h1>
                <p>Welcome to Jobistan.pk. By accessing or using our website, you agree to comply with and be bound by the following terms and services. Please read these terms carefully before using our site.</p>
            </div>
        </div>
    </main>
    <section class="primary-bg py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background2" class="display-6">Use of the Site</h1>
                </div>
                <div class="col-12 my-2">
                    <ul>
                        <li class="optional-color"><b>Eligibility </b>By using our site, you represent that you are at least 18 years old and have the legal capacity to enter into these terms.</li>
                        <li class="optional-color"><b>Account Registration </b>To access certain features, you may need to create an account. You agree to provide accurate and complete information during registration and keep your account information updated.</li>
                        <li class="optional-color"><b>User Responsibility </b>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You agree to notify us immediately of any unauthorized use of your account.</li>
                    </ul>
                </div>
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background2" class="display-6">User Conduct</h1>
                </div>
                <div class="col-12 my-2">
                    <ul>
                        <li class="optional-color"><b>Prohibited Activities </b>You agree not to use the site for any unlawful purpose or in any way that could harm others or impair the functionality of the site. Prohibited activities include, but are not limited to, uploading harmful content, violating intellectual property rights, and engaging in fraudulent activities.</li>
                        <li class="optional-color"><b>Content Submission </b>When you submit content (such as job applications or resumes), you grant us a non-exclusive, royalty-free, worldwide license to use, reproduce, and distribute your content in connection with our services</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="secondary-bg py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background2">Job Listings</h1>
                </div>
                <div class="col-12 my-2">
                    <ul>
                        <li class="optional-color"><b>Accuracy of Listings</b> While we strive to provide accurate job listings, we do not guarantee the completeness or accuracy of the information. Jobistan.pk is not responsible for the content of job postings or the actions of employers.</li>
                        <li class="optional-color"><b>No Guarantee of Employment</b> Jobistan.pk does not guarantee that users will receive job offers or secure employment through the site.</li>
                    </ul>
                </div>
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background2">Intellectual Property</h1>
                </div>
                <div class="col-12 my-2">
                    <ul>
                        <li class="optional-color"><b>Ownership</b> All content and materials on the site, including text, graphics, logos, and software, are the property of Jobistan.pk or its licensors and are protected by intellectual property laws.</li>
                        <li class="optional-color"><b>Limited License</b> You are granted a limited, non-exclusive, non-transferable license to access and use the site for personal, non-commercial purposes.</li>
                    </ul>
                </div>
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background2">Privacy</h1>
                </div>
                <div class="col-12 my-2">
                    <p class="optional-color">Your use of the site is also governed by our <a class="text-decoration-none primary-color" href="./privacyPolicy.php">Privacy Policy</a>, which explains how we collect, use, and protect your personal information.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="optional-bg py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background" class="display-5">Limitation of Liability</h1>
                </div>
                <div class="col-12 my-2">
                    <p class="secondary-color">
                        To the fullest extent permitted by law, Jobistan.pk shall not be liable for any direct, indirect, incidental, special, or consequential damages arising from your use of the site or inability to use the site, even if we have been advised of the possibility of such damages.
                    </p>
                </div>
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background" class="display-5">Indemnification</h1>
                </div>
                <div class="col-12 my-2">
                    <p class="secondary-color">
                        You agree to indemnify and hold Jobistan.pk, its affiliates, and their respective officers, directors, employees, and agents harmless from any claims, liabilities, damages, losses, and expenses arising out of your use of the site or violation of these terms.
                    </p>
                </div>
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background" class="display-5">Changes to the Terms</h1>
                </div>
                <div class="col-12 my-2">
                    <p class="secondary-color">
                        We may update these terms from time to time. We will notify you of any changes by posting the new terms on this page. Your continued use of the site after any changes indicates your acceptance of the new terms.
                    </p>
                </div>
                <div class="col-12 my-2">
                    <h1 id="heading-gradient-background" class="display-5">Contact Us</h1>
                </div>
                <div class="col-12 my-2">
                    <p class="secondary-color">
                        If you have any questions about these terms, please contact us at <br>
                        <small><b>Email Address: </b><a class="text-decoration-none primary-color" href="mailto:info@jobistan.pk">jobistan.karachi.pk@gmail.com</a></small><br>
                        <small><b>or by visiting our: </b><a class="text-decoration-none primary-color" href="./ContactUs.php">Contact Us</a> page.</small><br>
                        <small><b>Address: </b> Karachi, Pakistan</small>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <?php
    include('./footer.php');
    include("./Includes/bootstrapJs.php");
    ?>
</body>

</html>