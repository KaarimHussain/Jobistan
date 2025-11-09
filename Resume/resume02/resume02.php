<?php
include('../../Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: ../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Visionary Vitae - Resume Style | Jobistan</title>
    <?php
    include('../../Includes/bootstrapCss.php');
    include('../../Includes/tailwindCss.php');
    include('../../Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
</head>

<body class="h-100 w-100">
    <main class="full-h optional-bg position-relative d-flex align-items-center">
        <button class="primary-btn position-fixed top-50 start-0 translate-middle-y m-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
            <i class="bi bi-arrow-right-circle-fill"></i>
        </button>
        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-start" data-bs-backdrop="false" data-bs-theme="dark" data-bs-scroll="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h2 class="text-2xl font-bold mb-4">Create Your Resume</h2>
                <form id="resumeForm" action="./save_resume002.php" method="POST">
                    <!-- Step 1: Basic Info -->
                    <div id="step1" class="step">
                        <label for="full_name" class="block mb-2">Full Name:</label>
                        <input type="text" id="form_full_name" name="form_full_name" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="job_title" class="block mb-2">Job Title:</label>
                        <input type="text" id="form_job_title" name="form_job_title" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="exact_experience" class="block mb-2">Job Experience</label>
                        <select name="exact_experience" class="w-full px-3 py-2 border rounded-md mb-3">
                            <option value="fresher" selected>Fresher</option>
                            <option value="less_1">Less then 1 Year</option>
                            <option value="1">1+ Years</option>
                            <option value="3">3+ Years</option>
                            <option value="5">5+ Years</option>
                            <option value="10">10+ Years</option>
                            <option value="15">15+ Years</option>
                        </select>

                        <label for="email" class="block mb-2">Email:</label>
                        <input type="email" id="form_email" name="form_email" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="phone" class="block mb-2">Phone:</label>
                        <input type="number" required id="form_phone" name="form_phone" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="linkedin" class="block mb-2">Address:</label>
                        <input type="text" id="form_address" name="form_address" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="form_dob" name="form_dob" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                        <label for="summary" class="block mb-2">Summary:</label>
                        <textarea id="form_summary" name="form_summary" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500 resize-none"></textarea>

                        <div class="resume-actions flex justify-end">
                            <button type="button" class="primary-btn" onclick="showStep(2)">
                                Next
                            </button>
                        </div>
                    </div>
                    <!-- Step 2: Work Experience -->
                    <div id="step2" class="step hidden">
                        <h3 class="text-lg font-bold mb-2">Work Experience</h3>
                        <div class="job-experience">
                            <label for="job_title_1" class="block mb-2">Job Title:</label>
                            <input type="text" id="form_job_title1" name="form_job_title1" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                            <label for="company_name_1" class="block mb-2">Company Name:</label>
                            <input type="text" id="form_company_name" name="form_company_name" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                            <label for="job_duration_1" class="block mb-2">Job Duration:</label>
                            <input type="date" id="form_job_duration_start" name="form_job_duration_start" placeholder="Start From" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                            <input type="date" id="form_job_duration_end" name="form_job_duration_end" placeholder="End At" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                            <label for="job_description_1" class="block mb-2">Job Description:</label>
                            <textarea id="form_job_description" name="form_job_description" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500 resize-none"></textarea>
                        </div>
                        <div class="resume-actions flex justify-end gap-3">
                            <button type="button" class="primary-btn" onclick="showStep(1)">
                                Back
                            </button>
                            <button type="button" class="primary-btn" onclick="showStep(3)">
                                Next
                            </button>
                        </div>
                    </div>
                    <!-- Step 3: Education and Skills -->
                    <div id="step3" class="step hidden">
                        <!--  -->
                        <label for="education_name" class="block mb-2">College / University Name:</label>
                        <input id="form_education_name" name="form_education_name" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="education_description" class="block mb-2">Education Description:</label>
                        <textarea id="form_education_description" name="form_education_description" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                        <!--  -->
                        <label for="education_name" class="block mb-2">College2 / University2 Name:</label>
                        <input id="form_education_name2" name="form_education_name2" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="education_description2" class="block mb-2">Education2 Description:</label>
                        <textarea id="form_education_description2" name="form_education_description2" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                        <!--  -->
                        <label for="education_name" class="block mb-2">College3 / University3 Name:</label>
                        <input id="form_education_name3" name="form_education_name3" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="education_description3" class="block mb-2">Education3 Description:</label>
                        <textarea id="form_education_description3" name="form_education_description3" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                        <!--  -->
                        <label for="skills" class="block mb-2">Skills:</label>
                        <textarea id="form_skills" name="form_skills" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                        <label for="languages" class="block mb-2">Languages:</label>
                        <textarea id="language_list" name="language_list" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>


                        <div class="resume-actions flex justify-end gap-3">
                            <button type="button" class="primary-btn" onclick="showStep(2)">
                                Back
                            </button>
                            <button type="submit" class="primary-btn">
                                Finish
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Right Side (Preview) -->
        <div class="container pt-5">
            <a href="../../mainresume/CreateResume.php" class="fs-6 fw-bold"><i class="bi bi-arrow-left-circle-fill"></i> Go
                Back</a>
            <div class="d-flex align-items-center flex-column gap-2 pb-5">
                <small class="fw-bold">Resume Style</small>
                <h1 class="text-center display-5" id="heading-gradient-background">The Visionary Vitae</h1>
            </div>
            <div class="row d-flex flex-column align-items-end">
                <div class="col-lg-10 col-md-11 col-sm-12 col-12">
                    <div class="max-w-4xl mx-auto bg-gray-100 shadow-lg rounded-lg p-6">
                        <div class="flex justify-between items-center border-b-2 border-green-600 pb-6">
                            <div>
                                <h1 class="text-4xl text-green-600 font-bold" id="name"></h1>
                                <p class="text-gray-600" id="jobTitle"></p>
                            </div>
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6 mt-6">
                            <!-- Contact Section -->
                            <div class="col-span-1">
                                <h2 class="text-2xl text-green-600 border-b-2 border-green-600 font-bold pb-2">Contact
                                </h2>
                                <p class="mt-4"><strong></strong> <span id="email"></span></p>
                                <p class="mt-4"><strong></strong> <span id="adress-preview"></span></p>
                                <p class="mt-4"><strong></strong> <span id="phone"></span></p>
                                <p class="mt-4"><strong></strong> <span id="dob"></span></p>

                                <h2 class="text-2xl text-green-600 border-b-2 border-green-600 font-bold pb-2 mt-8">
                                    Skills
                                </h2>
                                <ul class="list-disc list-inside" id="skills">
                                    <li class="mt-4"></li>
                                    <li class="mt-4"></li>
                                    <li class="mt-4"></li>
                                    <li class="mt-4"></li>
                                    <li class="mt-4"></li>
                                </ul>

                                <h2 class="text-2xl text-green-600 font-bold border-b-2 border-green-600 pb-2 mb-4 mt-8">
                                    Languages</h2>
                                <ul class="list-disc list-inside" id="languages">
                                    <li class="mt-4"></li>
                                    <li class="mt-4"></li>
                                    <li class="mt-4"></li>
                                    <li class="mt-4"></li>
                                </ul>
                            </div>

                            <!-- Objective and Experience Section -->
                            <div class="col-span-2">
                                <h2 class="text-2xl text-green-600 font-bold border-b-2 border-green-600 pb-2 mb-4">
                                    Objective</h2>
                                <p id="objective" class="text-black"></p>

                                <h2 class="text-2xl text-green-600 font-bold border-b-2 border-green-600 pb-2 mb-4 mt-8">
                                    Experience</h2>
                                <div class="mb-6" id="experience1">
                                    <h3 class="text-xl font-bold" id="prev_jobTitle"></h3>
                                    <p class="text-gray-900" id="prev_description"></p>
                                    <ul class="list-disc list-inside">
                                        <li id="prev_company_name"></li>
                                        <li>
                                            <span id="prev_job_duration_start"></span>
                                            <b>-</b>
                                            <span id="prev_job_duration_end"></span>
                                        </li>
                                    </ul>
                                </div>
                                <h2 class="text-2xl text-green-600 font-bold border-b-2 border-green-600 pb-2 mb-4 mt-8">
                                    Education</h2>
                                <div class="mb-6" id="education1">
                                    <h3 class="text-xl font-bold" id="education_title"></h3>
                                    <p class="text-gray-900" id="education_description_text"></p>
                                </div>
                                <div class="mb-6" id="education2">
                                    <h3 class="text-xl font-bold" id="education_title2"></h3>
                                    <p class="text-gray-900" id="education_description_text2"></p>
                                </div>
                                <div class="mb-6" id="education3">
                                    <h3 class="text-xl font-bold" id="education_title3"></h3>
                                    <p class="text-gray-900" id="education_description_text3"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="resumePreview" class="pb-5 pt-3">
                    <!-- Preview will dynamically update based on form inputs -->

                </div>
                <div class="py-4">
                    <?php
                    include("../Default_Resume\swiperinclude.php");
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    include('../../Includes/bootstrapJs.php');
    include('../../Includes/jQuery.php');
    ?>
    <script>
        // Function to show specific step in the form
        function showStep(step) {
            document.querySelectorAll('.step').forEach(function(stepDiv) {
                stepDiv.classList.add('hidden');
            });
            document.getElementById('step' + step).classList.remove('hidden');
            // Optionally update the resume preview based on the form inputs
            updateResumePreview(step);
        }

        document.getElementById('form_full_name').addEventListener('input', (e) => {
            document.getElementById('name').innerHTML = e.target.value;
        });

        document.getElementById('form_job_title').addEventListener("input", function(e) {
            document.getElementById('jobTitle').innerHTML = e.target.value;
        });

        document.getElementById('form_email').addEventListener("input", function(e) {
            document.getElementById('email').innerHTML = e.target.value;
        })

        document.getElementById('form_address').addEventListener("input", function(e) {
            document.getElementById('adress-preview').innerHTML = e.target.value;
        })
        document.getElementById('form_phone').addEventListener("input", function(e) {
            document.getElementById('phone').innerHTML = e.target.value;
        })
        document.getElementById('form_dob').addEventListener("input", function(e) {
            document.getElementById('dob').innerHTML = e.target.value;
        })
        document.getElementById('form_summary').addEventListener("input", function(e) {
            document.getElementById('objective').innerHTML = e.target.value;
        })
        document.getElementById('form_job_title1').addEventListener("input", (e) => {
            document.getElementById('prev_jobTitle').innerHTML = e.target.value;
        })
        document.getElementById('form_job_description').addEventListener("input", (e) => {
            document.getElementById('prev_description').innerHTML = e.target.value;
        })
        document.getElementById('form_job_duration_start').addEventListener("input", (e) => {
            document.getElementById('prev_job_duration_start').innerHTML = e.target.value;
        })
        document.getElementById('form_job_duration_end').addEventListener("input", (e) => {
            document.getElementById('prev_job_duration_end').innerHTML = e.target.value;
        })
        document.getElementById('form_company_name').addEventListener("input", (e) => {
            document.getElementById('prev_company_name').innerHTML = e.target.value;
        })


        document.getElementById('form_skills').addEventListener('input', function() {
            var skills = this.value;
            var skillsContent = skills.split('\n').map(skill => `<li>${skill}</li>`).join('');
            document.getElementById('skills').innerHTML = skillsContent;
        });

        document.getElementById('language_list').addEventListener('input', function() {
            var skills = this.value;
            var skillsContent = skills.split('\n').map(skill => `<li>${skill}</li>`).join('');
            document.getElementById('languages').innerHTML = skillsContent;
        });

        document.getElementById('form_education_name').addEventListener('input', (e) => {
            // Capture the input value
            let educationName = e.target.value;

            // Update the college/university name in the education section
            document.getElementById('education_title').textContent = educationName;
        });

        // Update the education description in the education section
        document.getElementById('form_education_description').addEventListener('input', (e) => {
            // Capture the input value
            let educationDescription = e.target.value;

            // Update the education description in the education section
            document.getElementById('education_description_text').textContent = educationDescription;
        });
        // ================================================================================

        document.getElementById('form_education_name2').addEventListener('input', (e) => {
            // Capture the input value
            let educationName = e.target.value;

            // Update the college/university name in the education section
            document.getElementById('education_title2').textContent = educationName;
        });

        // Update the education description in the education section
        document.getElementById('form_education_description2').addEventListener('input', (e) => {
            // Capture the input value
            let educationDescription = e.target.value;

            // Update the education description in the education section
            document.getElementById('education_description_text2').textContent = educationDescription;
        });

        // ================================================================================

        document.getElementById('form_education_name3').addEventListener('input', (e) => {
            // Capture the input value
            let educationName = e.target.value;

            // Update the college/university name in the education section
            document.getElementById('education_title3').textContent = educationName;
        });

        // Update the education description in the education section
        document.getElementById('form_education_description3').addEventListener('input', (e) => {
            // Capture the input value
            let educationDescription = e.target.value;

            // Update the education description in the education section
            document.getElementById('education_description_text3').textContent = educationDescription;
        });

        // ================================================================================
        // document.getElementById('form_university1').addEventListener("input", (e) => {
        //     document.getElementById('education1').innerHTML = e.target.value;
        // })
        // Function to update the resume preview based on form inputs
        function updateResumePreview(step) {
            // Example: Update the preview div with the form data
            var previewDiv = document.getElementById('resumePreview');
            previewDiv.innerHTML = '';
        }
    </script>
</body>

</html>