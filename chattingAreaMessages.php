<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_GET['reciver_id'])) {
    header("Location: chattingArea.php");
    exit();
}
include ('./Includes/db.php');
include ('./Classes/Base.php');

$receiver_id = $_GET['reciver_id'];
$sender_id = $_SESSION['logged']['id'];
$receiverInfo = new Select($conn);

$receiverInfo = $receiverInfo->SelectUserWithID($receiver_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's Chat - Jobistan</title>
    <?php
    include ('./Includes/bootstrapCss.php');
    include ('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/glassBackground.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/messaging.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/input.css?v=<?php echo time(); ?>">
</head>

<body>
    <main class="mainBackground">
        <div class="col-md-10 glass-bg py-4 rounded-3">
            <div class="py-2 border-bottom d-flex flex-column">
                <a href="./chattingArea.php" class="px-3 text-decoration-none optional-color">
                    <small><i class="bi bi-arrow-left-circle-fill"></i> Contacts</small>
                </a>
                <small class="text-center optional-color">You are texting</small>
                <h4 class="fw-bold optional-color text-center col-12"><?php echo $receiverInfo['username']; ?></h4>
            </div>
            <div style="height: 60vh;" class="overflow-y-auto overflow-x-hidden px-3 py-2">
                <div class="row" id="messageBoxResponse">
                </div>
            </div>
            <div>
                <div class="p-4 d-flex justify-content-between gap-3">
                    <input type="text" id="messageInput" class="input-primary w-100" placeholder="Type a message...">
                    <button class="primary-btn" id="sendMessageBtn"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </div>
    </main>
    <?php
    include ('./Includes/bootstrapJs.php');
    include ('./Includes/jQuery.php');
    ?>
    <script>
        $(document).ready(function () {
            let fetchInterval;
            // Get the data-userid attribute value
            var userId = <?php echo $receiver_id; ?>;
            console.log(userId);
            // Fetch messages immediately
            fetchMessage(userId);
            // Set an interval to fetch messages every 0.5 seconds
            fetchInterval = setInterval(function () {
                fetchMessage(userId);
            }, 500);
            // Send message on Enter key press
            $('#messageInput').on('keyup', function (event) {
                if (event.key === 'Enter') {
                    sendMessage($(this).val(), userId);
                    $(this).val('');
                }
            })
            $('#sendMessageBtn').click(function () {
                sendMessage($('#messageInput').val(), userId);
                $('#messageInput').val('');
            })



            function fetchMessage(user_id) {
                // console.log("Fetching message");
                $.ajax({
                    type: "post",
                    url: "./fetchMessages.php",
                    data: {
                        reciver_id: user_id,
                        sender_id: <?php echo $sender_id; ?>
                    },
                    dataType: "html",
                    success: function (response) {
                        $('#messageBoxResponse').empty();
                        $('#messageBoxResponse').html(response);
                    }
                });
            }
            function sendMessage(message, userId) {
                $.ajax({
                    type: "post",
                    url: "./sendMessage.php",
                    data: {
                        message: message,
                        sender_id: <?php echo $_SESSION['logged']['id']; ?>,
                        receiver_id: userId
                    },
                    dataType: "bool",
                    success: function (response) {
                        console.log(response);
                        return true;
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(status);
                        return false;
                    }
                });
            }
        });
    </script>
</body>

</html>