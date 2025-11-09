<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
include ('./Includes/db.php');
include ('./Classes/Startup.php');
$startup = new Startup($conn);
if ($startup->checkAdditionalInfoExist($_SESSION['logged']['id'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Additional Info - Jobistan</title>
    <?php
    include ('./Includes/bootstrapCss.php');
    include ('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/input.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- processAddAdditionalInfo.php -->
    <?php
    include ('./AI.php');
    ?>
    <main class="full-h optional-bg py-5">
        <h1 id="heading-gradient-background" class="display-5 text-center">Provide Addition Information</h1>
        <div class="d-flex justify-content-center">
            <small class="text-center text-body-secondary">
                The Provided Information will be used to provide you a better User Experience
            </small>
        </div>
        <div class="container">
            <form action="./processAddAdditionalInfo.php" method="post" class="row py-5">
                <div class="col-12 mb-4 d-flex align-items-center flex-column">
                    <label for="user_main_profession">Main Profession</label>
                    <textarea data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-bs-title="This is the field through which companies will search for you. You can always change it later!"
                        name="user_main_profession" placeholder="Enter your Main Profession..."
                        class="resize-none input-primary bg-white col-md-7"></textarea>
                </div>
                <div class="col-12 mb-4 d-flex align-items-center flex-column">
                    <label for="user_description">Description</label>
                    <textarea name="user_description" placeholder="Enter your Description..."
                        class="resize-none input-primary bg-white col-md-7"></textarea>
                </div>
                <div class="col-12 mb-4 d-flex align-items-center flex-column">
                    <label for="user_interest">Interest</label>
                    <textarea name="user_interest" placeholder="Enter your Interest..."
                        class="resize-none input-primary bg-white col-md-7"></textarea>
                </div>
                <div class="col-12 mb-4 d-flex align-items-center flex-column">
                    <label for="user_hobbies">Hobbies</label>
                    <textarea name="user_hobbies" placeholder="Enter your Hobbies..."
                        class="resize-none input-primary bg-white col-md-7"></textarea>
                </div>
                <div class="col-12 mb-4 d-flex align-items-center flex-column">
                    <button class="primary-btn col-md-7">Add Info</button>
                </div>
            </form>
        </div>
    </main>
    <?php
    include ('./Includes/bootstrapJs.php');
    include ('./Includes/jQuery.php');
    include ('./Includes/chatbot.php');
    ?>
</body>

</html>