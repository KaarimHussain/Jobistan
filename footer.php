<footer class="secondary-bg py-5">
    <div class="container">
        <div class="row my-5">
            <div class="col-12 col-lg-3 col-md-6 col-sm-6 mb-3">
                <img src="Resources/JOBISTANLOGO/trans_logo3.png" alt="JOBISTAN.pk" height="100" width="100">
            </div>
            <?php
            if (isset($_SESSION['logged']) && $_SESSION['logged']['role'] == 'worker') {
                ?>
                <div class="col-12 col-lg-3 col-md-6 col-sm-6 mb-3">
                    <div class="d-flex flex-column gap-2">
                        <p class="fw-bold text-white">For Job Seekers</p>
                        <a href="./home.php" class="nav-link">
                            <small class="optional-color">Jobs</small>
                        </a>
                        <a href="#" class="nav-link">
                            <small class="optional-color">Resume Builder</small>
                        </a>
                        <a href="#" class="nav-link">
                            <small class="optional-color">Companies</small>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-6 mb-3">
                    <div class="d-flex flex-column gap-2">
                        <p class="fw-bold text-white">User</p>
                        <a href="./profile.php" class="nav-link">
                            <small class="optional-color">Profile</small>
                        </a>
                        <a href="./setting.php" class="nav-link">
                            <small class="optional-color">Settings</small>
                        </a>
                        <a href="./chattingArea.php" class="nav-link">
                            <small class="optional-color">Messages</small>
                        </a>
                    </div>
                </div>
                <?php
            } else if (isset($_SESSION['logged']) && $_SESSION['logged']['role'] == 'recruiter') {
                ?>
                    <div class="col-12 col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="d-flex flex-column gap-2">
                            <p class="fw-bold text-white">For Employers</p>
                            <a href="#" class="nav-link">
                                <small class="optional-color">Events</small>
                            </a>
                            <a href="#" class="nav-link">
                                <small class="optional-color">Recrutment</small>
                            </a>
                            <a href="#" class="nav-link">
                                <small class="optional-color">Talent Pool</small>
                            </a>
                        </div>
                    </div>
                <?php
            }
            ?>
            <div class="col-12 col-lg-3 col-md-6 col-sm-6 mb-3">
                <div class="d-flex flex-column gap-2">
                    <p class="fw-bold text-white">About Jobistan</p>
                    <a href="./aboutUs.php" class="nav-link">
                        <small class="optional-color">About Us</small>
                    </a>
                    <a href="./userGuild.php" class="nav-link">
                        <small class="optional-color">User Guide</small>
                    </a>
                    <a href="./termsAndServices.php" class="nav-link">
                        <small class="optional-color">Terms & Services</small>
                    </a>
                    <a href="./ContactUs.php" class="nav-link">
                        <small class="optional-color">Contact Us</small>
                    </a>
                </div>
            </div>
            <hr class="text-white my-5">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="optional-color">Copyright © 2024 Jobistan</small>
                </div>
                <div class="d-flex gap-3">
                    <a href="./termsAndServices.php" class="nav-link text-white">User Agreement</a>
                    <a href="./privacyPolicy.php" class="nav-link text-white">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>