<!-- filterNav.php -->
<div id="filterNav">
    <!-- Collapsible filter section -->
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">More Filter</h1>
        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#navTabs" aria-expanded="false"
            aria-controls="navTabs">
            <i class="bi bi-caret-right-fill"></i>
        </button>
    </div>
    <div class="collapse show collapse-horizontal py-4 px-3 border-end border-secondary mt-3 navbar-expand-lg"
        id="navTabs">
        <p class="secondary-color fw-bold pt-3">Working schedule</p>
        <ul class="nav flex-column row gap-3">
            <li class="nav-item col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="full-time" id="workFullTime">
                    <label class="form-check-label" for="workFullTime">
                        Full Time
                    </label>
                </div>
            </li>
            <li class="nav-item col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="part-time" id="workPartTime">
                    <label class="form-check-label" for="workPartTime">
                        Part Time
                    </label>
                </div>
            </li>
            <li class="nav-item col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="remote" id="workRemote">
                    <label class="form-check-label" for="workRemote">
                        Remote
                    </label>
                </div>
            </li>
            <li class="nav-item col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="hybrid" id="workHybrid">
                    <label class="form-check-label" for="workHybrid">
                        Hybrid
                    </label>
                </div>
            </li>
            <li class="nav-item col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="intern" id="workInternship">
                    <label class="form-check-label" for="workInternship">
                        Internship
                    </label>
                </div>
            </li>
        </ul>
    </div>
</div>