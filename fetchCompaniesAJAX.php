<?php
include ('./Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $TotalFilter = "";
    $searchBarVal = $_POST['searchBarVal'];
    if (!empty($searchBarVal)) {
        $TotalFilter .= "AND user_main_profession LIKE '%$searchBarVal%'";
    }
    include ('./Includes/db.php');
    include ('./Classes/Base.php');
    $base = new Select($conn);
    $compData = $base->getCompanyForWorker($TotalFilter);
    if (!empty($compData)) {
        foreach ($compData as $row) {
            if ($row['user_id'] == $_SESSION['logged']['id']) {
                continue; // Skip the current logged user's company
            } else {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="border shadow-sm rounded-4 py-3 px-4 d-flex flex-column align-items-center gap-3">
                        <img src="<?php echo $row['company_logo']; ?>" class="rounded-circle object-fit-cover object-position-none"
                            height="60" width="60">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="fw-bold p-0 d-flex justify-content-center">
                                <?php echo $row['company_name']; ?>
                            </h5>
                        </div>
                        <form action="./viewCompanyDetails.php?post_company_id=<?php echo $row['user_id']; ?>" method="get">
                            <input type="hidden" name="post_company_id" value="<?php echo $row['user_id'] ?>">
                            <button type="submit" name="showUserDetailsForCompany"
                                class="primary-btn rounded-pill px-4">Details</button>
                        </form>
                    </div>
                </div>

                <?php
            }
        }
    } else {
        ?>
        <div class="col-12">
            <h4 class="text-center fw-bold">No Currently Avaliable Workers</h4>
        </div>
        <?php
    }
    $conn->close();
} else {
    header("Location: home.php");
    exit();
}

?>