<?php
include ("./Includes/sessionStart.php");
if (!isset($_SESSION["logged"])) {
    $_SESSION['register_error'] = "You need to create an account or login first!";
    header("Location: login.php");
    exit();
}
if (isset($_SESSION['logged']['role'])) {
    if ($_SESSION['logged']['role'] == "recruiter") {
        header("Location: companyHome.php");
        exit();
    }
}
include ('./Includes/db.php');
include ('./Classes/Startup.php');
$startup = new Startup($conn);
if (!$startup->checkAdditionalInfoExist($_SESSION['logged']['id'])) {  // Check for false
    header("Location: addAdditionalInfo.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Welcome to Jobistan Pakistan First Ever Job Portal</title>
    <?php
    include ("./Includes/bootstrapCss.php");
    include ("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/input.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/home.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include ("./AI.php");
    include ("./navbar.php");
    include ("./secondNav.php");
    ?>
    <main class="py-5 optional-bg full-h position-relative">
        <section class="container py-2">
            <div class="row">
                <div class="col-lg-3 col-md-0 col-0 position-relative d-lg-block d-md-none d-none"
                    style="min-height:30vh;">
                    <?php
                    include ("./filterNav.php");
                    ?>
                </div>
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="col-12 mb-3">
                        <!-- <?php
                        // print_r($_SESSION["logged"]);
                        ?> -->
                        <h3 class="my-4 display-6">Search Jobs</h3>
                        <div class="d-flex gap-3 align-items-center">
                            <i class="bi bi-search fs-4"></i>
                            <input type="text" id="searchBar" placeholder="Search for Jobs..."
                                class="input-primary bg-white col-12 fs-6">
                        </div>
                        <hr class="bg-dark">
                    </div>
                    <div class="row" id="responseBox">
                        <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-5" aria-hidden="true">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow d-flex justify-content-between">
                                    <span class="placeholder col-8 rounded-pill py-4"></span>
                                    <span class="placeholder col-2 rounded-circle"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-12 my-3 py-3 rounded-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="placeholder col-3 rounded-1 py-1"></span>
                                    <a class="btn btn-primary disabled placeholder col-4" aria-disabled="true"></a>
                                </div>
                            </div>
                        </div>
                        <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-5" aria-hidden="true">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow d-flex justify-content-between">
                                    <span class="placeholder col-8 rounded-pill py-4"></span>
                                    <span class="placeholder col-2 rounded-circle"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-12 my-3 py-3 rounded-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="placeholder col-3 rounded-1 py-1"></span>
                                    <a class="btn btn-primary disabled placeholder col-4" aria-disabled="true"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-5" aria-hidden="true">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow d-flex justify-content-between">
                                    <span class="placeholder col-8 rounded-pill py-4"></span>
                                    <span class="placeholder col-2 rounded-circle"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-12 my-3 py-3 rounded-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="placeholder col-3 rounded-1 py-1"></span>
                                    <a class="btn btn-primary disabled placeholder col-4" aria-disabled="true"></a>
                                </div>
                            </div>
                        </div>
                        <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-5" aria-hidden="true">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow d-flex justify-content-between">
                                    <span class="placeholder col-8 rounded-pill py-4"></span>
                                    <span class="placeholder col-2 rounded-circle"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-12 my-3 py-3 rounded-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="placeholder col-3 rounded-1 py-1"></span>
                                    <a class="btn btn-primary disabled placeholder col-4" aria-disabled="true"></a>
                                </div>
                            </div>
                        </div>
                        <div class=" col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-5" aria-hidden="true">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow d-flex justify-content-between">
                                    <span class="placeholder col-8 rounded-pill py-4"></span>
                                    <span class="placeholder col-2 rounded-circle"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-12 my-3 py-3 rounded-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="placeholder col-3 rounded-1 py-1"></span>
                                    <a class="btn btn-primary disabled placeholder col-4" aria-disabled="true"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-5" aria-hidden="true">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow d-flex justify-content-between">
                                    <span class="placeholder col-8 rounded-pill py-4"></span>
                                    <span class="placeholder col-2 rounded-circle"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-12 my-3 py-3 rounded-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-2"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="placeholder col-3 rounded-1 py-1"></span>
                                    <a class="btn btn-primary disabled placeholder col-4" aria-disabled="true"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php
    include ('./footer.php');
    include ("./Includes/bootstrapJs.php");
    include ("./Includes/jQuery.php");
    include ("./Includes/chatbot.php");
    ?>
    <script>
        $(document).ready(function () {
            fetchFilteredJobs(); // Fetch jobs when the page loads

            $('#searchBar').on('input', function () {
                fetchFilteredJobs();
            });

            $('#filterNav input[type="checkbox"]').on('change', function () {
                fetchFilteredJobs();
            });

            // Change event instead of select event
            $('#jobArea').on('change', function () {
                fetchFilteredJobs();
            });

            $('#jobTitle').on('change', function () {
                fetchFilteredJobs();
            });

            $('#jobSalary').on('change', function () {
                fetchFilteredJobs();
            });
        });

        function fetchFilteredJobs() {
            var searchData = {
                searchBarVal: $('#searchBar').val(),
                filters: getFilters(), // Retrieve selected filters
                jobArea: getJobArea(),
                jobSalary: getJobSalary(),
                jobTitle: getJobTitle() // Retrieve selected job title and salary range from the second navigation dropdowns
            };

            $.ajax({
                url: "./fetchPost.php", // Ensure this path is correct
                type: "POST",
                data: searchData,
                dataType: "html",
                success: function (response) {
                    $('#responseBox').empty();
                    $('#responseBox').html(response);
                },
                error: function (xhr, status, error) {
                    $('#responseBox').html("Job Post cannot be fetched because of some technical Error! Please try again later");
                }
            });
        }

        function getFilters() {
            var filters = [];
            $('#filterNav input[type="checkbox"]:checked').each(function () {
                filters.push($(this).val());
            });

            return filters;
        }

        function getJobArea() {
            return $('#jobArea').val();
        }

        function getJobSalary() {
            return $('#jobSalary').val();
        }

        function getJobTitle() {
            return $('#jobTitle').val();
        }

    </script>

</body>

</html>