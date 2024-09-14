<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
// if (!isset($_GET['user_id'])) {
//     header("Location: companyHome.php");
//     exit();
// }
$user_id = $_GET['user_id'];
$com_id = $_SESSION['logged']['id'];
include ('./Includes/db.php');
include ('./Classes/Chatting.php');
// include ('./Classes/Base.php');
$base = new Select($conn);
$chat = new Chatting($conn);
$userData = $base->SelectUserWithID($user_id);
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
    <link rel="stylesheet" href="./Styles/messaging.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/inbox.css?v=<?php echo time(); ?>">
</head>

<body>
    <main>
        <div class="glass-bg py-3 px-4 rounded-2 col-md-7 position-relative">
            <a href="./companyViewPostedJobs.php"
                class="text-decoration-none optional-color d-flex align-items-center gap-2"><i
                    class="bi bi-arrow-left-circle-fill fs-4"></i> Go
                Back</a>
            <div class="d-flex align-items-center flex-column gap-2">
                <div class="secondary-bg py-2 px-3 rounded-pill fs-6 fw-bold optional-color">
                    <?php echo $_SESSION['logged']['username']; ?>
                </div>
                <small><i class="bi bi-arrow-down-circle-fill text-white"></i></small>
                <h4 class="fw-bold text-white">
                    <?php echo $userData['username']; ?>
                </h4>
            </div>
            <hr>
            <input type="hidden" id="emp_id" data-user-id="<?php echo $user_id; ?>">
            <div style="height: 60vh;" class="overflow-y-auto overflow-x-hidden px-3 py-2">
                <div class="row" id="messageBoxResponse">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="spinner-border text-white m-5" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="position-absolute top-100 start-50 translate-middle d-flex align-items-center gap-2 justify-content-center">
                <input type="text" class="input-primary" id="messageInput" style="width: 320px;"
                    placeholder="Write a Message...">
                <button class="primary-btn" id="sendMessageBtn"><i class="bi bi-send-fill"></i></button>
            </div>
        </div>
    </main>
    <?php
    include ('./Includes/bootstrapJs.php');
    include ('./Includes/jQuery.php');
    ?>
    <script src="./Scripts/inboxFetchMessageCompany.js?v=<?php echo time(); ?>"></script>
</body>

</html>