<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION["logged"])) {
    header("Location: index.php");
    exit();
}
$user_id = $_GET['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - Jobistan</title>
</head>

<body>
    <?php echo $user_id; ?>
</body>

</html>