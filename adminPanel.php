<?php
include ("./Includes/sessionStart.php");
if (!isset($_SESSION['adminLogged'])) {
    header("LocationL index.php");
    exit();
}
include ("./Includes/db.php");
include ("./Classes/adminData.php");
$adminData = new AdminData($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pakistan First Ever Job Portal | Jobistan</title>
    <?php
    include ('./Includes/bootstrapCss.php');
    include ('./Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/admin.css?v=<?php echo time(); ?>">
</head>

<body>

    <main class="optional-bg full-h postition-relative">
        <div class="container-lg-none container-md-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-5 col-md-12 postition-relative">
                    <?php
                    include ('./adminNav.php')
                        ?>
                </div>
                <div class="col-xl-9 col-lg-7 col-md-12">
                    <div class="container">
                        <div class="py-4 border-bottom border-primary">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h1 class="display-6 fw-bold">Welcome Back, <span class="fw-light"
                                            id="heading-gradient-background">Admin</span>!</h1>
                                    <small><i class="bi bi-star-fill"></i> Here's are the Basic Stats</small>
                                </div>
                                <div>
                                    <a href="adminLogout.php" class="primary-btn"><i
                                            class="bi bi-door-open-fill"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-4">
                                <div class="card black-gradient rounded-3">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h2 class="fw-bold optional-color fs-2">Total Users</h2>
                                        <h3 class="card-title fw-light fs-3 text-white secondary-font" id="total-users">
                                            <?php echo $adminData->getTotalUsers(); ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-4">
                                <div class="card black-gradient rounded-3">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h2 class="fw-bold optional-color fs-2">Total Jobs</h2>
                                        <h3 class="card-title fw-light fs-3 text-white secondary-font" id="total-users">
                                            <?php echo $adminData->getTotalJobs(); ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-4">
                                <div class="card black-gradient rounded-3">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h2 class="fw-bold optional-color fs-2">Total Companys</h2>
                                        <h3 class="card-title fw-light fs-3 text-white secondary-font" id="total-users">
                                            <?php echo $adminData->getTotalCompany(); ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 mb-5 d-flex justify-content-center">
                                <canvas id="myChart"></canvas>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 mb-5">
                                <div
                                    class="todoHeader rounded-top py-3 px-2 d-flex align-items-center primary-bg justify-content-center">
                                    <h4 class="text-center fw-bold optional-color">Todo List</h4>
                                </div>
                                <div
                                    class="todoBody rounded-bottom border-start border-bottom border-end border-secondary p-3">
                                    <div class="row">
                                        <div class="col-12 mb-3 d-flex gap-3">
                                            <input type="text" id="taskInput" class="form-control"
                                                placeholder="Add a new task">
                                            <button onclick="addTask()" class="text-nowrap primary-btn">Add
                                                Task</button>
                                        </div>
                                        <div class="col-12">
                                            <ul id="taskList">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    include ('./Includes/chatjs.php');
    ?>
    <script src="./Scripts/adminTodoList.js"></script>
    <script src="./Scripts/adminChart.js"></script>
</body>

</html>