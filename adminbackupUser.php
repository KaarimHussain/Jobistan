<?php include ("./Includes/sessionStart.php");
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
    include ('./Includes/bootstrapCss.php');
    include ('./Includes/Icons.php');
    include ('./Includes/db.php');
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
                    include ('./adminNav.php')
                        ?>
                </div>
                <div class="col-xl-9 col-lg-7 col-md-12">
                    <div class="container">
                        <div class="py-4 border-bottom border-primary">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h1 class="display-6 fw-bold">View Users</h1>
                                    <small><i class="bi bi-star-fill"></i> In this section you will be able to view
                                        through the users that are registered in the Database</small>
                                </div>
                                <div>
                                    <a href="adminLogout.php" class="primary-btn"><i
                                            class="bi bi-door-open-fill"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <table class="mainTable">
                                    <thead>
                                        <tr class="secondary-bg">
                                            <th class="secondary-bg optional-color">#</th>
                                            <th class="secondary-bg optional-color">Name</th>
                                            <th class="secondary-bg optional-color">Phone</th>
                                            <th class="secondary-bg optional-color">Created At</th>
                                            <th class="secondary-bg optional-color">Deleted At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Fetching Users Data -->
                                        <?php
                                        include ('./Classes/adminData.php');
                                        $AdminData = new AdminData($conn);
                                        $userData = $AdminData->getAllbackupUsers();
                                        if (!empty($userData)) {
                                            $index = 1;
                                            foreach ($userData as $row) {
                                                $createdFormat = new DateTime($row['created_at']);
                                                $deletedFormat = new DateTime($row['deleted_at']);
                                                $createdFormat = $createdFormat->format('F j, Y, g:i a');
                                                $deletedFormat = $deletedFormat->format('F j, Y, g:i a');
                                                ?>
                                                <tr>
                                                    <td class="secondary-font"><?php echo $index; ?></td>
                                                    <td class="text-nowrap"><?php echo $row['name']; ?></td>
                                                    <td class="text-nowrap"><?php echo $row['phone']; ?></td>
                                                    <td class="text-nowrap"><?php echo $createdFormat; ?></td>
                                                    <td class="text-nowrap"><?php echo $deletedFormat; ?></td>
                                                </tr>
                                                <?php
                                                $index++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center'>No User Found</td></tr>";
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
            <button
                class="d-lg-none primary-btn optional-color rounded-circle d-flex justify-content-center align-items-center fs-3"
                type="button" style="height: 50px;width:50px;" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive"><i
                    class="bi bi-list"></i></button>
        </div>
        <!--  -->
    </main>
    <?php
    include ('./Includes/bootstrapJs.php');
    ?>
</body>

</html>