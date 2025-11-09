<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['logged']['role'] == 'recruiter') {
    header("Location: companyHome.php");
    exit();
}
$user_id = $_SESSION['logged']['id'];
include ("./Classes/Chatting.php");
$chatting = new Chatting($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - Jobistan</title>
    <?php
    include ('./Includes/bootstrapCss.php');
    include ('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/inbox.css?v=<?php echo time(); ?>">
</head>

<body>
    <main>
        <div class="glass-bg rounded-2 py-3 px-4 col-md-6">
            <a href="./profile.php" class="text-decoration-none optional-color"><i
                    class="bi bi-arrow-left-circle-fill"></i> Go Back</a>
            <h1 class="text-center optional-color my-4 fw-light">Inbox</h1>
            <div class="container">
                <div class="row">
                    <?php
                    $savedPostSelect = new Select($conn);
                    $postResponse = $savedPostSelect->fetchUserAppliedPostByID($user_id);
                    if (!empty($postResponse)) {
                        foreach ($postResponse as $row) {
                            $hasNewMessages = $chatting->checkForNewMessages($row['user_id'], $user_id);
                            $created_at = new DateTime($row['created_at']);
                            $created_at = $created_at->format('F j, Y, g:i a');
                            ?>
                            <div class="col-12 mb-3">
                                <div
                                    class="white-glass text-decoration-none optional-color p-3 rounded-2 d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-2 align-items-center">
                                        <img src="<?php echo $row['company_logo']; ?>"
                                            class="rounded-circle object-fit-cover object-position-center" height="60px"
                                            width="60px" alt="">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="fw-semibold"><?php echo $row['company_name']; ?></h5>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <a href="./viewCompanyMessages.php?emp_id=<?php echo $row['user_id']; ?>"
                                            class="btn btn-dark rounded-1 position-relative">Inbox
                                            <?php if ($hasNewMessages > 0) { ?>
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-success p-2">
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <h4
                            class="fw-bold optional-color gap-3 d-flex align-items-center justify-content-center flex-column">
                            You haven't applied to any Jobs yet!
                        </h4>
                        <small class="text-center text-white">Once you applied to any of the job you will be able to see the
                            company profile</small>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>