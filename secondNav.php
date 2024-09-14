<?php
include ("./Includes/sessionStart.php");
?>
<nav class="navbar navbar-expand-lg secondary-bg border-top border-secondary" data-bs-theme="dark">
    <div class="container py-lg-4 py-md-2 py-2">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContentSecondary"
            aria-controls="navbarContentSecondary" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContentSecondary">
            <?php
            if ($_SESSION['logged']['role'] == 'recruiter') {
                ?>
                <ul data-bs-theme="dark" class="w-100 navbar-nav justify-content-evenly d-md-block d-block d-lg-flex">
                    <li class="nav-item d-flex align-items-center gap-3">
                        <div class="d-flex gap-3 justify-content-between">
                            <span class="text-white">No Exp</span>
                            <input type="range" min="0" max="10" value="0" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="No Exp | 10+ Years Exp" id="experience_range"
                                class="custom-range">
                            <span class="text-white">Max Exp</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="vr h-100 text-white d-lg-block d-md-none d-none"></div>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Select Area"
                        class="nav-item d-flex align-items-center gap-3">
                        <i class="bi bi-geo-alt text-white fs-4"></i>
                        <select id="#" class="nav-link outline-dark w-100">
                            <option class="text-dark" value="*" selected>All Areas</option>
                            <option class="text-dark" value="Karachi">Karachi</option>
                            <option class="text-dark" value="Lahore">Lahore</option>
                            <option class="text-dark" value="Islamabad">Islamabad</option>
                            <option class="text-dark" value="Multan">Multan</option>
                            <option class="text-dark" value="Gujranwala">Gujranwala</option>
                            <option class="text-dark" value="Rawalpindi">Rawalpindi</option>
                            <option class="text-dark" value="Peshawar">Peshawar</option>
                            <option class="text-dark" value="Quetta">Quetta</option>
                        </select>
                    </li>
                    <li class="nav-item">
                        <div class="vr h-100 text-white d-lg-block d-md-none d-none"></div>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Select Salary Option"
                        class="nav-item d-flex align-items-center gap-3">
                        <i class="bi bi-cash-stack text-white fs-4"></i>
                        <select id="#" class="nav-link outline-dark w-100">
                            <option class="text-black" value="*" selected>Any</option>
                            <option class="text-black" value="Karachi">Per Month</option>
                            <option class="text-black" value="Lahore">Per Hour</option>
                            <option class="text-black" value="Islamabad">Per Anum</option>
                        </select>
                    </li>
                </ul>
                <?php
            }
            if ($_SESSION['logged']['role'] == 'worker') {
                ?>
                <ul data-bs-theme="dark" class="w-100 navbar-nav justify-content-evenly d-md-block d-block d-lg-flex">
                    <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Select Profession"
                        class="nav-item d-flex align-items-center gap-3">
                        <i class="bi bi-search text-white fs-4"></i>
                        <select id="jobTitle" class="nav-link outline-dark w-100">
                            <!-- Add More Value by connecting through database -->
                            <option class="text-black" value="" selected>All Jobs</option>
                            <option class="text-black" value="Engineer">Engineer</option>
                            <option class="text-black" value="Doctor">Doctor</option>
                            <option class="text-black" value="Nurse">Nurse</option>
                            <option class="text-black" value="Computer Engineer">Computer Engineer</option>
                            <option class="text-black" value="Graphic Designer">Graphic Designer</option>
                        </select>
                    </li>
                    <li class="nav-item">
                        <div class="vr h-100 text-white d-lg-block d-md-none d-none"></div>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Select Area"
                        class="nav-item d-flex align-items-center gap-3">
                        <i class="bi bi-geo-alt text-white fs-4"></i>
                        <!-- Add More Value by connecting through database -->
                        <select id="jobArea" class="nav-link outline-dark w-100">
                            <option class="text-dark" value="" selected>All Areas</option>
                            <option class="text-dark" value="Karachi">Karachi</option>
                            <option class="text-dark" value="Lahore">Lahore</option>
                            <option class="text-dark" value="Islamabad">Islamabad</option>
                            <option class="text-dark" value="Multan">Multan</option>
                            <option class="text-dark" value="Gujranwala">Gujranwala</option>
                            <option class="text-dark" value="Rawalpindi">Rawalpindi</option>
                            <option class="text-dark" value="Peshawar">Peshawar</option>
                            <option class="text-dark" value="Quetta">Quetta</option>
                        </select>
                    </li>
                    <li class="nav-item">
                        <div class="vr h-100 text-white d-lg-block d-md-none d-none"></div>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Select Salary"
                        class="nav-item d-flex align-items-center gap-3">
                        <i class="bi bi-cash-stack text-white fs-4"></i>
                        <select id="jobSalary" class="nav-link outline-dark w-100">
                            <!-- Add More Value by connecting through database -->
                            <option class="text-black" value="" selected>Any</option>
                            <option class="text-black" value="10000">10k+</option>
                            <option class="text-black" value="20000">20k+</option>
                            <option class="text-black" value="50000">50k+</option>
                            <option class="text-black" value="90000">90k+</option>
                        </select>
                    </li>
                </ul>
                <?php
            }
            ?>


        </div>
    </div>
</nav>