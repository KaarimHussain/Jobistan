<?php
include("./Includes/sessionStart.php");
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
if ($_SESSION['logged']['role'] != 'recruiter') {
    header('Location: home.php');
    exit();
}
if (!isset($_GET['job_id'])) {
    header('Location: companyViewPostedJobs.php');
    exit();
}
$job_id = $_GET['job_id'];
include('./Includes/db.php');
include('./Classes/hireRequest.php');
$hireData = new HireRequest($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Hired Users from Jobs - Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include('./navbar.php');
    $hires = $hireData->selectHiringHistoryForView($_SESSION['logged']['id'], $job_id);
    ?>
    <main class="full-h optional-bg py-5">
        <div class="container">
            <a href="./companyViewPostedJobs.php" class="text-decoration-none secondary-color">
                <i class="bi bi-arrow-left-circle-fill"></i> Go Back
            </a>
            <h1 id="heading-gradient-background" class="text-center display-4 mb-5">Hired Users</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Job Title</th>
                            <th scope="col">Hired At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($hires)) {
                            $index = 1;
                            foreach ($hires as $hire) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $index; ?></th>
                                    <td><?php echo htmlspecialchars($hire['user_username']); ?></td>
                                    <td><?php echo htmlspecialchars($hire['user_email']); ?></td>
                                    <td><?php echo htmlspecialchars($hire['job_title']); ?></td>
                                    <td><?php echo htmlspecialchars($hire['hired_at']); ?></td>
                                </tr>
                                <?php
                                $index++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" class="text-center fw-bold fs-5">
                                    No Hired Employee Found
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php
    include('./footer.php');
    include('./Includes/bootstrapJs.php');
    include('./Includes/jQuery.php');
    $conn->close();
    ?>
</body>

</html>