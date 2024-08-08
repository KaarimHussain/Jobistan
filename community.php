<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
date_default_timezone_set('Asia/Karachi');
include('./Includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community | Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/community.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include('./navbar.php');
    $base = new Select($conn);
    $myData;
    $main_profession;
    if ($_SESSION['logged']['role'] == 'recruiter') {
        $myData = $base->selectCompanyForProfilesWithID($_SESSION['logged']['id']);
    } else if ($_SESSION['logged']['role'] == 'worker') {
        $myData = $base->SelectAllUsersWithProfile($_SESSION['logged']['id']);
        $main_profession = $base->getUserAdditionInfoByID($_SESSION['logged']['id']);
    }
    // print_r($myData);
    ?>
    <main class="full-h optional-bg py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12 col-12 mb-4">
                    <!-- Quick Profile View -->
                    <div class="bg-white p-3 rounded-2">
                        <div class="d-flex justify-content-center">
                            <?php
                            if ($_SESSION['logged']['role'] == 'recruiter') {
                            ?>
                                <img src="<?php echo $myData['company_logo'] ?>" height="60px" width="60px" class="rounded-circle object-fit-cover object-position-center border border-dark" alt="Profile Picture">
                            <?php
                            } else if ($_SESSION['logged']['role'] == 'worker') {
                            ?>
                                <img src="<?php echo $myData[0]['profile_picture'] ?>" height="60px" width="60px" class="rounded-circle object-fit-cover object-position-center border border-dark" alt="Profile Picture">
                            <?php
                            }
                            ?>
                        </div>
                        <hr>
                        <a href="#" class="my-2 d-flex flex-column align-items-center text-decoration-none secondary-color">
                            <span class="text-center fw-bold"><?php echo $_SESSION['logged']['username']; ?></span>
                            <small class="text-center"><?php echo $main_profession['user_main_profession'] ?? ''; ?></small>
                        </a>
                    </div>
                    <!--  -->
                    <div class="my-3">
                        <button class="primary-btn col-12 fs-4 fw-bolder" data-bs-toggle="modal" data-bs-target="#addPostModal">
                            <i class="bi bi-patch-plus-fill"></i> POST
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-12 mb-4">
                    <!-- Main Content -->
                    <div class="bg-white p-3 rounded-2 d-flex gap-3 mb-4">
                        <!-- Create Post Box -->
                        <?php
                        if ($_SESSION['logged']['role'] == 'recruiter') {
                        ?>
                            <div>
                                <img src="<?php echo $myData['company_logo'] ?>" height="60px" width="60px" class="rounded-circle object-fit-cover object-position-center border border-dark" alt="Profile Picture">
                            </div>
                        <?php
                        } else if ($_SESSION['logged']['role'] == 'worker') {
                        ?>
                            <div>
                                <img src="<?php echo $myData[0]['profile_picture'] ?>" height="60px" width="60px" class="rounded-circle object-fit-cover object-position-center border border-dark" alt="Profile Picture">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="py-2 w-100">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#addPostModal" class="col-12 border border-secondary px-3 text-dark rounded-pill h-100 d-flex align-items-center text-decoration-none optional-bg">
                                <small class="fw-bold">Create a Post...</small>
                            </a>
                        </div>
                        <!--  -->
                    </div>
                    <div class="col-12 my-3">
                        <?php
                        if (isset($_SESSION['community_error'])) {
                        ?>
                            <div class="alert alert-danger col-12" role="alert">
                                <?php echo $_SESSION['community_error'];
                                unset($_SESSION['community_error']);
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="row" id="postResponseBox">
                        <!-- Fetching Post Through AJAX -->
                    </div>
                    <!--  -->
                </div>
                <div class="d-lg-block d-md-none d-none col-lg-3 col-0 col-md-0">
                    <!-- Advertisement Board -->
                    <div class="rounded-2">
                        <img src="./Resources/Backgrounds/blackBackground.png" class="object-fit-cover object-position-center img-fluid rounded-2" style="height:500px;" alt="Advertisement Board">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal for Adding Post -->
    <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="./communityInsertPost.php" method="post" enctype="multipart/form-data" class="modal-body">
                    <h4 class="fw-bold">Write a Content</h4>
                    <textarea name="postContent" required rows="7" style="resize: none;" placeholder="What do you want to talk about?" class="form-control col-12 my-3" id="postContent resize-none"></textarea>
                    <div class="my-3 px-3">
                        <img src="" class="image-preview img-fluid rounded-3 object-position-center object-fit-cover">
                    </div>
                    <div class="d-flex gap-3">
                        <label class="primary-btn" for="imageFile"><i class="bi bi-plus-square-fill"></i></label>
                        <input type="file" name="imageFile" class="form-control h-100 d-none" accept="image/png, image/jpg, image/jpeg" id="imageFile">
                        <button type="submit" class="primary-btn" name="addPostButton" id="addPost">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include('./footer.php');
    include('./Includes/bootstrapJs.php');
    include('./Includes/jQuery.php');
    ?>
    <script src="./Scripts/community.js?v=<?php echo time(); ?>"></script>
</body>

</html>