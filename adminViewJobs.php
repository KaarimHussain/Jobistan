<?php include("./Includes/sessionStart.php");
if (!isset($_SESSION['adminLogged'])) {
    header("LocationL index.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pakistan First Ever Job Portal | Jobistan</title>
    <?php
    include('./Includes/bootstrapCss.php');
    include('./Includes/Icons.php');
    include('./Includes/db.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/adminView.css?v=<?php echo time(); ?>">
</head>

<body>

    <main class="optional-bg full-h postition-relative">
        <div class="me-1">
            <div class="row">
                <div class="col-xl-3 col-lg-5 col-md-12">
                    <?php
                    include('./adminNav.php')
                    ?>
                </div>
                <div class="col-xl-9 col-lg-7 col-md-12">
                    <div class="container">
                        <div class="py-4 border-bottom border-primary">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h1 class="display-6 fw-bold">View Jobs</h1>
                                    <small><i class="bi bi-star-fill"></i> In this section you will be able to view through the Jobs that are posted by Companies from the Database</small>
                                </div>
                                <div>
                                    <a href="adminLogout.php" class="primary-btn"><i class="bi bi-door-open-fill"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <table class="mainTable">
                                    <thead>
                                        <tr class="secondary-bg">
                                            <th class="secondary-bg optional-color">#</th>
                                            <th class="secondary-bg optional-color">Title</th>
                                            <th class="secondary-bg optional-color">Salary</th>
                                            <th class="secondary-bg optional-color">Create At</th>
                                            <th class="secondary-bg optional-color">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Fetching Jobs Data -->
                                        <?php
                                        include('./Classes/adminData.php');
                                        $AdminData = new AdminData($conn);
                                        $userData = $AdminData->getAllJobs();
                                        if (!empty($userData)) {
                                            $index = 1;
                                            foreach ($userData as $row) {
                                                $formatedDate = new DateTime($row['created_at']);
                                                $formatedDate = $formatedDate->format('F j, Y, g:i a');
                                                $formatedSalary = number_format($row['salary_range'], 0, '', ',');
                                        ?>
                                                <tr>
                                                    <td class="secondary-font"><?php echo $index; ?></td>
                                                    <td class="text-nowrap"><?php echo $row['title']; ?></td>
                                                    <td class="secondary-font text-nowrap"><?php echo 'RS ' . $formatedSalary; ?></td>
                                                    <td class="secondary-font text-nowrap"><?php echo $formatedDate ?></td>
                                                    <td class="d-flex gap-1">
                                                        <form action="adminEditUser.php" method="post">
                                                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                                            <button href="#" class="action-edit-btn">Edit</button>
                                                        </form>
                                                        <form action="adminDeleteUser.php" method="post">
                                                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                                            <button href="#" class="action-delete-btn">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                                $index++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center'>No Jobs Found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Collapse Button -->
        <div class="position-fixed bottom-0 start-0 pb-4 ps-4">
            <button class="d-lg-none primary-btn optional-color rounded-circle d-flex justify-content-center align-items-center fs-3" type="button" style="height: 50px;width:50px;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive"><i class="bi bi-list"></i></button>
        </div>
        <!--  -->
    </main>
    <?php
    include('./Includes/bootstrapJs.php');
    ?>
</body>

</html>