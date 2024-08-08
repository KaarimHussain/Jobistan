<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies | Jobistan</title>
    <?php
    include ("./Includes/bootstrapCss.php");
    include ("./Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Styles/displayCompany.css?v=<?php echo time(); ?>">
</head>

<body class="position-relative">
    <?php
    include ("./navbar.php");
    ?>
    <main class="full-h overflow-hidden">
        <section class="row">
            <div class="col-12 py-5 ">
                <div class="container-lg">
                    <div class="light-dark-bg col-12 rounded-4 py-5 position-relative">
                        <h1 class="display-5 fw-semibold text-center text-white">Search the Companies that you
                            acknowledge</h1>
                        <div class="position-absolute top-100 start-50 translate-middle col-md-7">
                            <input type="text"
                                class="rounded-pill py-2 px-4 col-12 form-control border border-primary text-dark"
                                placeholder="Search the Companies..." id="searchBar">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-12 my-5">
            <div class="container">
                <div class="row" id="responseBoxCompanies"></div>
            </div>
        </section>
    </main>
    <?php
    include ('./footer.php');
    include ('./Includes/bootstrapJs.php');
    include ('./Includes/jQuery.php');
    ?>
    <script>
        $(document).ready(function () {
            fetchAllCompanies();
            $('#searchBar').on('input', function () {
                fetchAllCompanies();
            });

            function fetchAllCompanies() {
                $.ajax({
                    type: "post",
                    url: "fetchCompaniesAJAX.php",
                    data: {
                        searchBarVal: $('#searchBar').val()
                    },
                    dataType: "html",
                    success: function (response) {
                        $('#responseBoxCompanies').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                    }
                });
            }
        });
    </script>
</body>

</html>