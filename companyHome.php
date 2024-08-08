<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    $_SESSION['register_error'] = "You need to create an account or login first";
    header("Location: login.php");
    exit();
}
if (isset($_SESSION['logged']['role'])) {
    if ($_SESSION['logged']['role'] == "worker") {
        header("Location: home.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home - Jobistan</title>
    <?php
    include("Includes/bootstrapCss.php");
    include("Includes/Icons.php");
    ?>
    <link rel="stylesheet" href="./Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./Styles/inputRange.css?v=<?php echo time(); ?>">
</head>

<body class="position-relative">
    <?php
    include("./navbar.php");
    include("./secondNav.php");
    ?>
    <main class="full-h overflow-hidden">
        <section class="row">
            <div class="col-12 py-5 ">
                <div class="container-lg">
                    <div class="light-dark-bg col-12 rounded-4 py-5 position-relative">
                        <h1 class="display-5 fw-semibold text-center text-white">Search the Workers that you desire
                        </h1>
                        <div class="position-absolute top-100 start-50 translate-middle col-md-7">
                            <input type="text" class="rounded-pill py-2 px-4 col-12 form-control border border-primary text-dark" placeholder="Search the Workers by there Profession e.g (Doctor, Engineer)" id="searchBar">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Now make the logic of the AJAX Search Engine -->
            <main class="col-12 my-5">
                <div class="container">
                    <!-- Displaying Workers -->
                    <div class="row" id="responseBox">

                    </div>
                </div>
            </main>
        </section>
    </main>
    <?php
    include("footer.php");
    include("Includes/bootstrapJs.php");
    include('./Includes/jQuery.php');
    ?>
    <script>
        $(document).ready(function() {
            fetchAllUsers();
            $('#searchBar').on('input', function() {
                fetchAllUsers();
            });
            // Fetch users based on search and experience filter
            $('#experience_range').on('input', function() {
                fetchAllUsers();
            });
            
            function fetchAllUsers() {
                console.log("Called");
                $.ajax({
                    type: "post",
                    url: "./fetchUserProfileAJAX.php",
                    data: {
                        searchBarVal: $('#searchBar').val(),
                        experienceRange: getExperienceFilter(),
                    },
                    dataType: 'html',
                    success: function(response) {
                        $("#responseBox").html(response);
                    }
                });
            }
            // $('#experience_range').on('input', function () {
            //     console.log($('#experience_range').val());
            // })
            function getExperienceFilter() {
                let experienceRange = $('#experience_range').val();
                if (experienceRange == 0) {
                    return "*";
                } else {
                    return experienceRange;
                }
            }
        });
    </script>
</body>

</html>