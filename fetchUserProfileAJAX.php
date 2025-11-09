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
    $workerData = $base->getWorkerForCompanyWithAJAX($TotalFilter);
    if (!empty($workerData)) {
        foreach ($workerData as $row) {
            if (isset($row['user_main_profession']) && !empty($row['user_main_profession'])) {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="border shadow-sm rounded-4 py-3 px-4 d-flex flex-column align-items-center gap-3">
                        <img src="<?php echo $row['profile_picture']; ?>" class="rounded-circle object-fit-cover object-position-none"
                            height="60" width="60">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="fw-bold p-0 text-center">
                                <?php echo $row['name']; ?>
                            </h5>
                            <small class="text-center"><?php echo $row['user_main_profession']; ?></small>
                        </div>
                        <form action="./viewUserDetails.php?post_user_id=<?php echo $row['user_id']; ?>" method="get">
                            <input type="hidden" name="post_user_id" value="<?php echo $row['user_id'] ?>">
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