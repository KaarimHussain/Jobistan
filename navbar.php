<?php
include ('./Includes/sessionStart.php');
include ('./Includes/db.php');
include ('./Classes/ajax.php');
?>
<link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="./Styles/navbar.css?v=<?php echo time(); ?>">
<nav class="navbar navbar-expand-lg secondary-bg z-3" data-bs-theme="dark">
    <div class="container-fluid">
        <div style="width: 70px; height: 70px; overflow: hidden;">
            <a href="index.php">
                <img height="100%" width="100%" src="Resources\JOBISTANLOGO\trans_logo3.png"
                    style="object-fit: cover;object-position: center;" alt="Logo">
            </a>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarMain"
            aria-labelledby="offcanvasNavbarMainLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center gap-3 flex-grow-1">
                    <?php if (!isset($_SESSION['logged'])): ?>
                        <li class="nav-item"><a class="nav-link fw-semibold" href="./index.php">Home</a></li>
                        <li class="nav-item"><a class="vr h-100 text-white d-lg-block d-md-none d-none"></a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['logged'])): ?>
                        <?php
                        if ($_SESSION['logged']['role'] == 'worker') {
                            ?>
                            <li class="nav-item h-100 fw-semibold"><a class="nav-link" href="./home.php">Jobs</a></li>
                            <?php
                        } else if ($_SESSION['logged']['role'] == 'recruiter') {
                            ?>
                                <li class="nav-item h-100 fw-semibold"><a class="nav-link" href="./companyHome.php">Workers</a></li>
                            <?php
                        }
                        ?>

                        <li class="nav-item"><a class="vr h-100 text-white d-lg-block d-md-none d-none"></a></li>
                        <li class="nav-item"><a class="nav-link fw-semibold" href="./company.php">Companys</a></li>
                        <li class="nav-item"><a class="vr h-100 text-white d-lg-block d-md-none d-none"></a></li>
                        <li class="nav-item"><a class="nav-link fw-semibold" href="./community.php">Community</a></li>
                        <li class="nav-item"><a class="vr h-100 text-white d-lg-block d-md-none d-none"></a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="./ContactUs.php">Contact Us</a></li>
                    <li class="nav-item"><a class="vr h-100 text-white d-lg-block d-md-none d-none"></a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="./aboutUs.php">About Us</a></li>
                    <li class="nav-item"><a class="vr h-100 text-white d-lg-block d-md-none d-none"></a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="./userGuild.php">User Guide</a></li>
                </ul>
            </div>
        </div>
        <ul class="navbar-nav d-flex flex-row gap-1 justify-content-end">
            <?php if (!isset($_SESSION['logged'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">
                        <button class="primary-btn btn btn-sm btn-lg">Login</button>
                    </a>
                </li>
                <li class="nav-item"><a class="vr h-100 text-white d-lg-block d-md-none d-none"></a></li>
                <li class="nav-item">
                    <a class="nav-link" href="./signup.php">
                        <button class="primary-btn-2 btn btn-sm btn-lg">Sign Up</button>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['logged'])):
                include ("./Classes/Base.php");
                $notificationHandler = new SideScripts($conn);
                $profilePictureHandler = new Select($conn);
                $profPicture = $profilePictureHandler->SelectAllUsersWithProfile($_SESSION['logged']['id']);
                $profCompanyPicture = $profilePictureHandler->SelectAllRecruitersWithProfile($_SESSION['logged']['id']);
                $notiCount = $notificationHandler->getNotificationCount($_SESSION['logged']['id']);
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="./profile.php">
                        <?php if (empty($profPicture) && empty($profCompanyPicture)): ?>
                            <button style="height:40px;width:40px;padding:0.4rem;" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Profile"
                                class="btn btn-outline-dark text-white profilePicture rounded-circle">
                                <i class="bi bi-person-circle fs-5"></i>
                            </button>
                        <?php else: ?>
                            <?php if (!empty($profPicture)): ?>
                                <button style="height:40px;width:40px;padding:0;" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Profile"
                                    class="btn btn-outline-dark text-white profilePicture rounded-circle">
                                    <img height="100%" class="rounded-circle object-fit-cover object-position-center" width="100%"
                                        src="<?php echo htmlspecialchars($profPicture[0]['profile_picture']); ?>"
                                        alt="Profile Picture">
                                </button>
                            <?php elseif (!empty($profCompanyPicture)): ?>
                                <button style="height:40px;width:40px;padding:0;" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Profile"
                                    class="btn btn-outline-dark text-white profilePicture rounded-circle">
                                    <img height="100%" class="rounded-circle object-fit-cover object-position-center" width="100%"
                                        src="<?php echo htmlspecialchars($profCompanyPicture[0]['company_logo']); ?>"
                                        alt="Company Profile Picture">
                                </button>

                            <?php endif; ?>
                        <?php endif; ?>
                    </a>
                </li>
                <?php if ($_SESSION['logged']['role'] == 'worker'): ?>
                    <li class="nav-item">
                        <a href="./chattingArea.php" class="nav-link">
                            <button style="height:40px;width:40px;padding:0.4rem;" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Messages"
                                class="btn btn-outline-dark text-white rounded-pill">
                                <i class="bi bi-chat-right-text-fill fs-5"></i>
                            </button>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION['logged']['role'] == 'worker'): ?>
                    <li class="nav-item">
                        <a href="./mainresume/CreateResume.php" class="nav-link">
                            <button style="height:40px;width:40px;padding:0.4rem;" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Resume Builder"
                                class="btn btn-outline-dark text-white rounded-pill">
                                <i class="bi bi-file-earmark-medical-fill fs-5"></i>
                            </button>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link">
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="height:40px;width:40px;padding:0.4rem;" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" data-bs-title="Notification"
                            class="btn btn-outline-dark text-white rounded-circle position-relative">
                            <i class="bi bi-bell fs-5"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-primary">
                                <?php echo (int) $notiCount; ?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                    </a>
                </li>
                <?php if ($_SESSION['logged']['role'] == 'worker'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="setting.php">
                            <button style="height:40px;width:40px;padding:0.4rem;" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Settings"
                                class="btn btn-outline-dark text-white rounded-pill">
                                <i class="bi bi-gear fs-5"></i>
                            </button>
                        </a>
                    </li>
                <?php elseif ($_SESSION['logged']['role'] == 'recruiter'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="createJobListing.php">
                            <button style="height:40px;width:40px;padding:0.4rem;" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Create Job Post"
                                class="btn btn-outline-dark text-white rounded-pill">
                                <i class="bi bi-file-post fs-5"></i>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="companySettings.php">
                            <button style="height:40px;width:40px;padding:0.4rem;" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Settings"
                                class="btn btn-outline-dark text-white rounded-pill">
                                <i class="bi bi-gear fs-5"></i>
                            </button>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li class="nav-item d-flex align-items-center">
                <button class="navbar-toggler border py-1" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbarMain" aria-controls="offcanvasNavbarMain"
                    aria-label="Toggle navigation">
                    <i class="bi bi-list fs-2"></i>
                </button>
            </li>
        </ul>
    </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-bg">
            <div class="modal-body">
                <h1 class="my-2 text-center display-6 text-white">Notifications</h1>
                <div class="row" id="responseNotification"></div>
            </div>
            <div class="modal-footer border-0">
                <form action="./changeNotificationRead.php" method="post" class="col-12 justify-content-center d-flex">
                    <button type="submit" class="markReadButton text-decoration-none text-center col-12"><i
                            class="bi bi-check2"></i> Mark as Read</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include ('./Includes/jQuery.php');
?>
<script>
    $(document).ready(function () {
        $.ajax({
            type: "post",
            url: "./displayNotification.php",
            dataType: "html",
            success: function (response) {
                $("#responseNotification").html(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            },
        });
    });
</script>