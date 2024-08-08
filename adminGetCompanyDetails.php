<?php
include('./Classes/adminData.php');
include('./Includes/sessionStart.php');
include('./Includes/db.php');
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $AdminData = new AdminData($conn);
    $userDetails = $AdminData->getCompanyWithID($id); // Assuming you have this method to get details by ID

    if (!empty($userDetails)) {
?>
        <div class="container">
            <div class="row">
                <div class="col-12 my-2">
                    <h4 class="fw-bold text-white">
                        Company Name
                    </h4>
                    <p class="text-white"><?php echo $userDetails['company_name']; ?></p>
                </div>
                <div class="col-12 my-2">
                    <h4 class="fw-bold text-white">
                        Company Description
                    </h4>
                    <p class="text-white"><?php echo $userDetails['company_description']; ?></p>
                </div>
                <div class="col-12 my-2">
                    <h4 class="fw-bold text-white">
                        Company Culture
                    </h4>
                    <p class="text-white"><?php echo $userDetails['company_culture']; ?></p>
                </div>
                <div class="col-12 my-2">
                    <h4 class="fw-bold text-white">
                        Company Benefits
                    </h4>
                    <p class="text-white"><?php echo $userDetails['company_benefits']; ?></p>
                </div>
            </div>
        </div>
<?php
        // echo '<p>Other Details: ' . $userDetails['other_details'] . '</p>'; // Customize as needed
    } else {
        echo 'No details found for this user.';
    }
} else {
    echo 'Invalid request.';
}
