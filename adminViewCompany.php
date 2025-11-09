<?php include("./Includes/sessionStart.php");
if (!isset($_SESSION['adminLogged'])) {
    header("Location: index.php");
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
                                    <h1 class="display-6 fw-bold">View Companies</h1>
                                    <small><i class="bi bi-star-fill"></i> In this section you will be able to view
                                        through all the registered companies that are registered Database</small>
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
                                            <th class="secondary-bg optional-color">Company Name</th>
                                            <th class="secondary-bg optional-color">Company Details</th>
                                            <th class="secondary-bg optional-color">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Fetching Users Data -->
                                        <?php
                                        include('./Classes/adminData.php');
                                        $AdminData = new AdminData($conn);
                                        $userData = $AdminData->getAllCompany();
                                        if (!empty($userData)) {
                                            $index = 1;
                                            foreach ($userData as $row) {
                                        ?>
                                                <tr>
                                                    <td class="secondary-font"><?php echo $index; ?></td>
                                                    <td class="text-nowrap"><?php echo $row['company_name']; ?></td>
                                                    <td class="text-nowrap">
                                                        <button class="action-edit-btn">Details</button>
                                                    </td>
                                                    <td class="d-flex gap-1">
                                                        <form action="adminDeleteUser.php" method="post">
                                                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                                            <button class="action-delete-btn">Delete</button>
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
            <button class="d-lg-none primary-btn optional-color rounded-circle d-flex justify-content-center align-items-center fs-3" type="button" style="height: 50px;width:50px;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive"><i class="bi bi-list"></i></button>
        </div>
        <!--  -->
    </main>
    <div class="modal" id="detailsModal" data-bs-theme="dark" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="companyDetails">Loading...</p>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('./Includes/bootstrapJs.php');
    include('./Includes/jQuery.php');
    ?>
    <script>
        $(document).ready(function() {
            $('.action-edit-btn').on('click', function() {
                var userId = $(this).closest('tr').find('input[name="user_id"]').val();
                // Make an AJAX request to fetch user details
                $.ajax({
                    url: 'adminGetCompanyDetails.php', // This PHP script will fetch user details by ID
                    type: 'POST',
                    data: {
                        id: userId
                    },
                    success: function(response) {
                        // Update modal content with user details
                        $('#companyDetails').html(response);
                        // Show the modal
                        $('#detailsModal').modal('show');
                    }
                });
            });
        });
    </script>

</body>

</html>