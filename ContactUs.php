<?php
include ("./Includes/db.php");
include ("./Includes/sessionStart.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Jobistan</title>
    <?php
    include ("./Includes/bootstrapCss.php");
    include ("./Includes/Icons.php");
    include ("./Includes/bootstrapJs.php");
    ?>
    <link rel="stylesheet" href="Styles\main.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include ('./navbar.php');
    ?>
    <section class="optional-bg d-flex align-items-center full-h">
        <main class="container my-5">
            <h1 class="display-2 text-center" id="heading-gradient-background">
                Contact Us
            </h1>
            <div class="d-flex justify-content-center my-2">
                <?php
                if (isset($_SESSION['contact_error'])) {
                    echo '<div class="alert alert-danger" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['contact_error'] . '</div>';
                    unset($_SESSION['contact_error']);
                }
                if (isset($_SESSION['contact_approve'])) {
                    echo '<div class="alert alert-primary" role="alert"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['contact_approve'] . '</div>';
                    unset($_SESSION['contact_approve']);
                }
                ?>
            </div>
            <div class="p-4 mt-5 rounded-3 primary-bg">
                <div class="row">
                    <form method="post" action="contactMail.php" class="col-lg-6 col-md-12 col-12 mb-3">
                        <h1 class="text-center fw-bold optional-color">
                            Get In Touch
                        </h1>
                        <hr>
                        <div class="mb-3">
                            <label for="username" class="fw-semibold optional-color">Name</label>
                            <input type="text" name="username" placeholder="Enter your Name..."
                                class="form-control py-3">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="fw-semibold optional-color">Email Address</label>
                            <input type="email" name="email" placeholder="Enter your Email Address..."
                                class="form-control py-3">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="fw-semibold optional-color">Subject</label>
                            <input type="text" name="subject" placeholder="Enter your Subject..."
                                class="form-control py-3">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="fw-semibold optional-color">Message</label><br>
                            <textarea name="message" rows="5" placeholder="Write your Message..."
                                class="rounded-3 w-100 form-control resize-none"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn primary-btn-2 col-12">Send Message <i
                                    class="bi bi-send-fill"></i></button>
                        </div>
                    </form>
                    <div class="col-lg-6 col-md-12 col-12 mb-3 py-5 px-5">
                        <h1 class="fs-4 fw-semibold text-white mb-4">Any Questions? We would be happy to help you!</h1>
                        <div class="mb-4">
                            <div class="py-3 px-3 bg-light rounded-2 fw-bold  d-flex justify-content-center gap-3">
                                <i class="bi bi-telephone-fill"></i> <a class="text-decoration-none text-dark"
                                    href="tel:+92-123-4567890">+92-123-4567890</a>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="py-3 px-3 bg-light rounded-2 fw-bold d-flex justify-content-center gap-3">
                                <i class="bi bi-envelope-fill"></i> <a href="mailto:jobistan.karachi.pk@gmail.com"
                                    class="text-decoration-none text-dark">jobistan.karachi.pk@gmail.com</a>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="py-3 px-3 bg-light rounded-2 fw-bold d-flex justify-content-center gap-3">
                                <i class="bi bi-geo-alt-fill"></i>
                                Karachi, Pakistan
                            </div>
                        </div>
                        <div class="mb-4 d-flex justify-content-around">
                            <div class="bg-white text-white rounded-circle d-flex align-items-center justify-content-center fs-4"
                                style="height:50px;width:50px;">
                                <a href="https://www.facebook.com/Jobistan Pk" target="_blank"
                                    class="text-decoration-none primary-color"><i class="bi bi-facebook"></i></a>
                            </div>
                            <div class="bg-white text-white rounded-circle d-flex align-items-center justify-content-center fs-4"
                                style="height:50px;width:50px;">
                                <a href="https://www.twitter.com" target="_blank"
                                    class="text-decoration-none primary-color"><i class="bi bi-twitter-x"></i></a>
                            </div>
                            <div class="bg-white text-white rounded-circle d-flex align-items-center justify-content-center fs-4"
                                style="height:50px;width:50px;">
                                <a href="https://www.instagram.com/jobistan_pk" target="_blank"
                                    class="text-decoration-none primary-color">
                                    <i class="bi bi-instagram"></i></a>
                            </div>
                            <div class="bg-white text-white rounded-circle d-flex align-items-center justify-content-center fs-4"
                                style="height:50px;width:50px;">
                                <a href="https://www.linkedin.com/company/Jobistan .PK" target="_blank"
                                    class="text-decoration-none primary-color"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <?php
    include ('./footer.php');
    ?>
</body>

</html>