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
                                    <h1 class="display-6 fw-bold">View Pending Requests</h1>
                                    <small><i class="bi bi-star-fill"></i> In this section you will be albe to see
                                        through all the pending request waiting to be accepted and rejected</small>
                                </div>
                                <div>
                                    <a href="adminLogout.php" class="primary-btn"><i
                                            class="bi bi-door-open-fill"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 my-3 d-flex justify-content-center">
                            <?php
                            if (isset($_SESSION['admin_error'])) {
                                echo '<div class="alert alert-danger" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $_SESSION['admin_error'] . '</div>';
                                unset($_SESSION['admin_error']);
                            }
                            if (isset($_SESSION['admin_success'])) {
                                echo '<div class="alert alert-success" role="alert"><i class="bi bi-check-circle-fill"></i> ' . $_SESSION['admin_success'] . '</div>';
                                unset($_SESSION['admin_success']);
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <table class="mainTable">
                                    <thead>
                                        <tr class="secondary-bg">
                                            <th class="secondary-bg optional-color">#</th>
                                            <th class="secondary-bg optional-color">Company Logo</th>
                                            <th class="secondary-bg optional-color">Company Name</th>
                                            <th class="secondary-bg optional-color">Company Email</th>
                                            <th class="secondary-bg optional-color">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Fetching Users Data -->
                                        <?php
                                        include('./Classes/adminData.php');
                                        $AdminData = new AdminData($conn);
                                        $userData = $AdminData->getAllPendingRequests();
                                        if (!empty($userData)) {
                                            $index = 1;
                                            foreach ($userData as $row) {
                                                ?>
                                                <tr>
                                                    <td class="secondary-font"><?php echo $index; ?></td>
                                                    <td class="text-nowrap">
                                                        <img src="<?php echo $row['company_logo']; ?>" height="40px"
                                                            width="40px"
                                                            class="rounded-circle object-fit-cover object-position-center"
                                                            alt="<?php echo $row['company_name'] ?>">
                                                    </td>
                                                    <td class="text-nowrap"><?php echo $row['company_name']; ?></td>
                                                    <td class="text-nowrap"><?php echo $row['email']; ?></td>
                                                    <td class="d-flex gap-1 align-items-center" style="height:70px;">
                                                        <form action="./adminPendingApproval.php" method="post">
                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo $row['user_id']; ?>">
                                                            <input type="hidden" name="email" value="<?php $row['email']; ?>">
                                                            <button type="submit" name="approve_request_btn"
                                                                class="action-edit-btn">Approve</button>
                                                        </form>
                                                        <form action="./adminPendingApproval.php" method="post">
                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo $row['user_id']; ?>">
                                                            <input type="hidden" name="email" value="<?php $row['email']; ?>">
                                                            <button type="submit" name="reject_request_btn"
                                                                class="action-delete-btn">Reject</button>
                                                        </form>
                                                    </td>
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
    include('./Includes/bootstrapJs.php');
    ?>
</body>

</html>