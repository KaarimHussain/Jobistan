<?php
if (2 > 1) {
} else if ($selectedOption == "add_pkgs") {
    $result = $conn->query("SELECT * FROM cities");

    echo "<h1 class='text-center text-white heading'>Add Travel Pacakges</h1>";

    echo '
        <div class="container d-flex px-5" style="flex-direction:column:align-items:center;">
        <form action="addpkg.php" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate method="post">
        
    <div class="col-12">
       <label class="input-text fs-5 text-white col-12">City ID</label>
       
    <select name="CityID" style="font-size: 15px;" class="w-100 form-control" required>
    ';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row["CityID"] . '">' . $row["name"] . '</option>';
    }
    echo '
    </select>
    </div> </br>

    <div class="col-12">
        <label class="input-text fs-5 text-white col-12">Package Name</label>
        <input type="text" name="PackageName" style="font-size: 15px;" class="form-control" required>
    </div>
    
    <div class="text-white "> <span class="fs-5">Packages Type </span>
        <select required class="col-12 border pt-1 pb-1 pe-2 ps-2  rounded-2" name="PackageType" id="myDropdown packageType " onchange="displaySelectedValue()"> 
            <option class="shadow rounded-2" disabled selected hidden><span class="text-secondary">
            Select a Packages Type</span></option>
            <option class="shadow rounded-2" value="Solo">Solo</option>
            <option class="shadow rounded-2" value="Couple">Couple </option>
            <option class="shadow rounded-2" value="Family">Family</option>
        </select>
        <small class="col-12 text-center text-white pt-1" name="PackageType" id="selectedValue">Selected Types will appear here.</small>                                
    </div>

    <div class="mb-1">
        <label class="fs-5 text-white col" for="pkgImage">Select a Travel Package Image</label>
        <input type="file" accept="  image/" class="form-control pt-1 pb-1 col-9" name="pkgImage" required id="inputGroupFile01">
    </div>

    <div class="input-group col-12">
        <label class="input-text fs-5 text-white col-12">Add Details</label>
        <textarea class="form-control" name="Details" aria-label="With textarea" style="resize: none;font-size: 12px;"></textarea>
    </div>

<div class="input-group mb-3">
                                <label class="input-text fs-4 text-white col-12"> Package Price</label>
    <input type="number" name="Price" class="form-control  pt-1 pb-1 col-9 " aria-label="Amount (to the nearest dollar)">
    <span class="input-group-text ">$</span>
</div>

<!-- Start Date Input -->
<div class="input-group mb-3">
    <label class="input-text fs-4 text-white col-12" id="basic-addon2">Start Date</label>
    <input type="date" name="StartDate" class="form-control " aria-label="Start Date" required>
</div>

<!-- End Date Input -->
<div class="input-group mb-3">
    <label class="input-text fs-4 text-white col-12" id="basic-addon3">End Date</label>
    <input type="date" name="EndDate" class="form-control " aria-label="End Date" required>
</div>


<div class="input-group mb-3">
    <label class="input-text fs-5 text-white col-12" id="basic-addon4">Duration (Days)</label>
    <input type="number" name="DurationDays" class="form-control " placeholder="Duration" min="1" aria-label="Duration" required>
</div>


    <div class="col-12">
        <input type="submit" class="input-text btn w-100 fs-5" style="color:#fff;background-color:#E07A5F;" value="Enter to submit">
    </div>
</form>
        </div>
             ';
}
