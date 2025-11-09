<?php
include ("./Includes/db.php");
include ("./Includes/sessionStart.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Jobistan</title>
    <?php
    include ("./Includes/bootstrapCss.php");
    include ("./Includes/Icons.php");
    include ("./Includes/bootstrapJs.php");
    ?>
    <link rel="stylesheet" href="./Styles/aboutUs.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include ('./navbar.php');
    ?>
    <main class="mainAboutPage">
        <div class="container">
            <div class="row py-5 align-items-center">
                <div class="col-lg-6 col-md-12 col-12 mb-4 text-center">
                    <h1 class="fw-light display-3" id="heading-gradient-background">
                        About Us
                    </h1>
                    <hr class="primary-color fw-bold">
                    <small class="fw-semibold">
                        Welcome to Jobistan.pk, your number one source for all job opportunities in Pakistan. We're
                        dedicated to providing you the very best of job listings, with a focus on reliability,
                        transparency, and user satisfaction.
                    </small>
                </div>
                <div class="col-lg-6 col-md-12 col-12 mb-4">
                    <img src="./Illustrations/OfficeWork.svg" class="image-fluid">
                </div>
            </div>
        </div>
    </main>
    <section class="full-h secondary-bg d-flex align-items-center">
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="border border-secondary p-5 rounded-3">
                        <div class="d-flex gap-3 align-items-center">
                            <h1 class="fw-light display-1 primary-color">01</h1>
                            <div class="vr text-white my-4"></div>
                            <h1 class="fw-bold primary-color">Our Mission</h1>
                        </div>
                        <hr class="text-white">
                        <div class="optional-color">
                            At Jobistan.pk, our mission is to bridge the gap between job seekers and employers, creating
                            a
                            seamless and efficient platform where opportunities and talent meet. We aim to empower
                            individuals by providing them with the tools and resources they need to find their dream
                            jobs
                            and advance their careers.
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="border border-secondary p-5 rounded-3">
                        <div class="d-flex gap-3 align-items-center">
                            <h1 class="fw-light display-1 primary-color">02</h1>
                            <div class="vr text-white my-4"></div>
                            <h1 class="fw-bold primary-color">Our Vision</h1>
                        </div>
                        <hr class="text-white">
                        <div class="optional-color">
                            We envision a future where everyone has access to meaningful employment opportunities. By
                            leveraging technology and innovation, we strive to build a community where job seekers can
                            find not just any job, but the right job that matches their skills, aspirations, and
                            lifestyle.
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="border border-secondary p-5 rounded-3">
                        <div class="d-flex gap-3 align-items-center">
                            <h1 class="fw-light display-1 primary-color">03</h1>
                            <div class="vr text-white my-4"></div>
                            <h1 class="fw-bold primary-color">What We Offer</h1>
                        </div>
                        <hr class="text-white">
                        <div class="optional-color">
                            <ul>
                                <li><b>Comprehensive Job Listings: </b>We provide a wide range of job opportunities
                                    across various industries and locations within Pakistan. Whether you're a fresh
                                    graduate or an experienced professional, you'll find numerous opportunities to
                                    explore.</li>
                                <li><b>Easy Application Process: </b>Our user-friendly platform allows you to apply for
                                    jobs effortlessly. With just a few clicks, you can submit your application and track
                                    its progress.</li>
                                <li><b>Real Resume Building Tools: </b> Create a professional resume with our
                                    easy-to-use resume builder. Stand out to potential employers with a well-crafted CV.
                                </li>
                                <li><b>Career Resources: </b>Access valuable resources such as interview tips, career
                                    advice, and industry insights to help you navigate your job search and career
                                    development.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="border border-secondary p-5 rounded-3">
                        <div class="d-flex gap-3 align-items-center">
                            <h1 class="fw-light display-1 primary-color">04</h1>
                            <div class="vr text-white my-4"></div>
                            <h1 class="fw-bold primary-color">Our Commitment</h1>
                        </div>
                        <hr class="text-white">
                        <div class="optional-color">
                            We are committed to maintaining the highest standards of integrity and professionalism. Our
                            team works tirelessly to ensure that all job listings are accurate and up-to-date, providing
                            you with the best possible experience.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="half-h optional-bg py-4 d-flex justify-content-center flex-column gap-3">
        <h1 class="display-2 fw-light text-center" id="heading-gradient-background">
            Join Us
        </h1>
        <div class="container">
            <p class="fw-semibold text-center">Become a part of our growing community. Whether you're looking for your
                first job, seeking a career
                change,
                or wanting to stay updated with the latest job trends, Jobistan.pk is here to support you every step of
                the
                way.
                Thank you for choosing Jobistan.pk. We look forward to helping you achieve your career goals.
            </p>
        </div>
    </section>
    <?php
    include ('./footer.php');
    ?>
</body>

</html>