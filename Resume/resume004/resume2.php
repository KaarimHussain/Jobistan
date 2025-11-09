<?php
include('../../Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location:../../index.php");
    exit();
}
// include('../../Classes/Base.php');
$user_id = $_SESSION['logged']['id'];
// $base = new Select($conn);
// $row = $base->SelectUserWithID($user_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Resume - Jobistan</title>
    <?php
    include('../../Includes/bootstrapCss.php');
    include('../../Includes/Icons.php');
    include('../../Includes/tailwindCss.php');
    ?>
    <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
    <style>
        .job-experience {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .job-experience label {
            font-weight: bold;
        }

        .resume-actions {
            margin-top: 20px;
        }

        .icon {
            display: none;
        }

        .t1 {
            padding: 40px;
        }

        .ls {
            padding: 3rem;
        }

        .bold-hr {
            height: 4px;
            background-color: #fff;
            border: none;
        }

        .bold-hr1 {
            height: 4px;
            background-color: rgba(30, 58, 138, var(--tw-bg-opacity));
            border: none;
        }
    </style>
</head>

<body class="h-100 w-100">
    <main class="full-h optional-bg position-relative d-flex flex-column p-4">
        <button class="primary-btn position-fixed top-50 start-0 translate-middle-y m-5" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
            <i class="bi bi-arrow-right-circle-fill"></i>
        </button>
        <div class="offcanvas offcanvas-start" data-bs-backdrop="false" data-bs-theme="dark" data-bs-scroll="true"
            tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h2 class="text-2xl font-bold mb-4">Create Your Resume</h2>
                <form id="resumeForm" action="save_resume004.php" method="POST">
                    <!-- Step 1: Basic Info -->
                    <div id="step1" class="step">
                        <label for="full_name" class="block mb-2">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" required
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="job_title" class="block mb-2">Job Title:</label>
                        <input type="text" id="job_title" name="job_title" required
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="exact_experience" class="block mb-2">Job Experience</label>
                        <select name="exact_experience" class="w-full px-3 py-2 border rounded-md mb-3">
                            <option value="fresher" selected>Fresher</option>
                            <option value="0.5">Less then 1 Year</option>
                            <option value="1">1+ Years</option>
                            <option value="3">3+ Years</option>
                            <option value="5">5+ Years</option>
                            <option value="10">10+ Years</option>
                            <option value="15">15+ Years</option>
                        </select>
                        <label for="phone" class="block mb-2">Phone:</label>
                        <input type="text" id="phone" name="phone"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="email" class="block mb-2">Email:</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="address" class="block mb-2">Address:</label>
                        <input type="text" id="address" name="address"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <div class="resume-actions flex justify-end">
                            <button type="button" onclick="showStep(2)" class="primary-btn">
                                Next
                            </button>
                        </div>
                    </div>
                    <!-- Step 2: Work Experience -->
                    <div id="step2" class="step hidden">

                        <label for="expertise" class="block mb-2">Expertise:</label>
                        <textarea id="expertise" name="expertise" rows="4"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <label for="languages" class="block mb-2">Languages:</label>
                        <textarea id="languages" name="languages" rows="4"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <label for="hobbies" class="block mb-2">Hobbies:</label>
                        <textarea id="hobbies" name="hobbies" rows="4"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <div class="resume-actions flex justify-end gap-3">
                            <button type="button" onclick="showStep(1)" class="primary-btn">
                                Back
                            </button>
                            <button type="button" onclick="showStep(3)" class="primary-btn">
                                Next
                            </button>
                        </div>
                    </div>
                    <!-- Step 3: Education and Skills -->
                    <div id="step3" class="step hidden">

                        <label for="about_me" class="block mb-2">About Me:</label>
                        <textarea id="about_me" name="about_me" rows="4"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <div id="workExperience">
                            <h3 class="text-lg font-bold mb-2">Work Experience</h3>
                            <div class="job-experience">
                                <label for="job_title_1" class="block mb-2">Job Title:</label>
                                <input type="text" id="job_title_1" name="job_title_1" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="company_name_1" class="block mb-2">Company Name:</label>
                                <input type="text" id="company_name_1" name="company_name_1" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="joblocation1" class="block mb-2">joblocation1</label>
                                <input type="text" id="joblocation1" name="joblocation1" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_duration_1" class="block mb-2">Job Duration:</label>
                                <input type="date" id="job_duration_start1" name="job_duration_start1" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                                <input type="date" id="job_duration_end1" name="job_duration_end1" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_description_1" class="block mb-2">Job Description:</label>
                                <textarea id="job_description_1" name="job_description_1" rows="4"
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                            </div>


                            <div class="job-experience">
                                <label for="job_title_2" class="block mb-2">Job Title:2</label>
                                <input type="text" id="job_title_2" name="job_title_2" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="company_name_2" class="block mb-2">Company Name:2</label>
                                <input type="text" id="company_name_2" name="company_name_2" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="joblocation2" class="block mb-2">joblocation2</label>
                                <input type="text" id="joblocation2" name="joblocation2" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_duration_2" class="block mb-2">Job Duration:</label>
                                <input type="date" id="job_duration_start2" name="job_duration_start2" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                                <input type="date" id="job_duration_end2" name="job_duration_end2" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_description_2" class="block mb-2">Job Description:2</label>
                                <textarea id="job_description_2" name="job_description_2" rows="4"
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                            </div>

                        </div>


                        <div class="resume-actions flex justify-end gap-3">
                            <button type="button" onclick="showStep(2)" class="primary-btn">
                                Back
                            </button>
                            <button type="button" onclick="showStep(4)" class="primary-btn">
                                Next
                            </button>
                        </div>
                    </div>
                    <div id="step4" class="step hidden">
                        <label for="r_name" class="block mb-2">Education Name:1</label>
                        <input type="text" id="Education_name1" name="Education_name1" required
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="Education_passoutdate1">date:</label>
                        <input type="date" id="Education_passoutdate1" name="Education_passoutdate1">
                        <label for="education" class="block mb-2">Education:</label>
                        <textarea id="Education_discription1" name="Education_discription1" rows="3"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <label for="r_name" class="block mb-2">Education Name:2</label>
                        <input type="text" id="Education_name2" name="Education_name2" required
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="Education_passoutdate2">date:</label>
                        <input type="date" id="Education_passoutdate2" name="Education_passoutdate2">
                        <label for="education" class="block mb-2">Education:2</label>
                        <textarea id="Education_discription2" name="Education_discription2" rows="3"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                        <div id="Reference">
                            <h3 class="text-lg font-bold mb-2">Reference</h3>
                            <div class="job-experience">
                                <label for="r_name" class="block mb-2">Name:</label>
                                <input type="text" id="r_name" name="r_name" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_position_1" class="block mb-2">Job Position:</label>
                                <input type="text" id="job_position_1" name="job_position_1" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="r_company_name_1" class="block mb-2">Company Name:</label>
                                <input type="text" id="r_company_name_1" name="r_company_name_1" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_phone_1" class="block mb-2">Phone:</label>
                                <input type="number" id="job_phone_1" name="job_phone_1" rows="4"
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_email_1" class="block mb-2">Email:</label>
                                <input type="email" id="job_email_1" name="job_email_1" rows="4"
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <div class="resume-actions flex justify-end gap-3">
                            <button type="button" onclick="showStep(3)" class="primary-btn">
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
        <div class="py-4">
            <a href="../../mainresume/CreateResume.php" class="fs-6 fw-bold"><i
                    class="bi bi-arrow-left-circle-fill"></i> Go
                Back</a>
            <div class="d-flex align-items-center flex-column gap-2">
                <small class="fw-bold">Resume Style</small>
                <h1 class="text-center display-5" id="heading-gradient-background">The Elite Experience</h1>
            </div>
        </div>
        <!-- Right side: Resume preview -->
        <div class="col-12 d-flex justify-content-center">

            <div id="previewContent" class="text-sm col-md-8 col-12">
                <!-- Initial Template Content -->
                <div class="t1" style=" margin: auto;">
                    <div class="flex">
                        <!-- Left Section -->
                        <div class="w-1/3 ls bg-blue-900 text-white">
                            <div class="text-center">
                                <h2 id="preview_full_name" class="text-2xl font-bold mb-2"></h2>
                                <p id="preview_job_title" class="text-lg"></p>
                            </div>
                            <div class="mt-8">
                                <h3 class="text-xl font-semibold">Contact</h3>
                                <hr class="mt-1 bold-hr">
                                <p id="preview_phone" class="mt-4"></p>
                                <p id="preview_email" class="mt-4"></p>
                                <p id="preview_address" class="mt-4"></p>
                            </div>

                            <div class="mt-8">
                                <h3 class="text-xl font-semibold">Expertise</h3>
                                <hr class="mt-1 bold-hr">
                                <ul id="preview_expertise" class="mt-4 list-disc list-inside">

                                </ul>
                            </div>

                            <div class="mt-8">
                                <h3 class="text-xl font-semibold">Language</h3>
                                <hr class="mt-1 bold-hr">
                                <ul id="preview_languages" class="mt-4 list-disc list-inside">

                                </ul>
                            </div>

                            <div class="mt-8">
                                <h3 class="text-xl font-semibold">Hobbies</h3>
                                <hr class="mt-1 bold-hr">
                                <ul id="preview_hobbies" class="mt-4 list-disc list-inside">

                                </ul>
                            </div>
                        </div>
                        <!-- Right Section -->
                        <div class="w-3/4 p-8 bg-gray-100">
                            <div>
                                <h2 id="preview_full_name_right" class="text-3xl text-blue-900 font-bold mt-4"></h2>
                                <p id="preview_job_title_right" class="text-xl text-gray-600"></p>
                                <h3 class="text-2xl font-semibold mt-20">About Me</h3>
                                <hr class="mt-1 bold-hr1">
                                <p id="preview_about_me" name="preview_about_me" class="mt-4"></p>
                            </div>
                            <div class="mt-8">
                                <h3 class="text-2xl font-semibold">Experience:1</h3>
                                <hr class="mt-1 bold-hr1">
                                <div class="mt-4">
                                    <div id="preview_jobtitle1" class="text-lg font-semibold" class="mt-4"></div>
                                    <div>
                                        <p id="preview_companyname1">Company Name |</p><span id="preveiw_joblocation1">
                                            123 Anywhere St., Any City</span>
                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <p id="preview_duration_start1" style="margin-right: 10px;"></p>
                                        <p>-</p>
                                        <p style="margin-left: 10px;" id="preview_duration_end1">2022</p>
                                    </div>
                                    <p class="mt-2 text-gray-600" id="preview_jobdiscription1"></p>
                                    <!-- Experience2 -->
                                    <h3 class="text-2xl font-semibold">Experience:2</h3>
                                    <hr class="mt-1 bold-hr1">

                                    <div class="mt-4">
                                        <div id="preview_jobtitle2" class="text-lg font-semibold"></div>
                                        <div>
                                            <p id="preview_companyname2">Company Name |</p><span
                                                id="preveiw_joblocation2"> 123 Anywhere St., Any City</span>
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                            <p id="pduration_start2" style="margin-right: 10px;"></p>
                                            <p>-</p>
                                            <p style="margin-left: 10px;" id="pduration_end2"></p>
                                        </div>
                                        <p class="mt-2 text-gray-600" id="preview_jobdiscription2"> </p>
                                    </div>
                                    <!-- //Education section -->
                                    <div class="mt-8">
                                        <h3 class="text-xl font-semibold">Education</h3>
                                        <p class="mt-4" id="Digree_name1">Enter Your Degree University/College</p>
                                        <hr class="mt-1 bold-hr1">
                                        <p id="digree1_passout_date1"></p>
                                        <p id="preview_education_discription1" class="mt-4"></p>
                                        <!-- second education -->
                                        <p class="mt-4" id="Digree_name2"></p>
                                        <hr class="mt-1 bold-hr1">
                                        <p id="digree2_passout_date2"></p>
                                        <p id="preview_education_discription2" class="mt-4"></p>
                                    </div>
                                    <div class="mt-8">
                                        <h3 class="text-2xl font-semibold">Reference</h3>
                                        <hr class="mt-1 bold-hr1">
                                        <div class="flex mt-4">
                                            <div class="w-1/2">
                                                <p id="preview_Reference_name" class="text-lg font-semibold"></p>
                                                <p id="preview_Reference_job_position_1" class="text-lg font-semibold">
                                                </p>
                                                <p id="preview_Reference_company" class="text-lg font-semibold"></p>
                                                <p id="preview_Reference-phone_1" class="mt-2"></p>
                                                <p id="preview_Reference_email_1" class="mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <?php
                        include("../Default_Resume\swiperinclude.php");
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include('../../Includes/bootstrapJs.php');
        ?>
        <script>
            function showStep(step) {
                document.querySelectorAll('.step').forEach(function (stepDiv) {
                    stepDiv.classList.add('hidden');
                });
                document.getElementById('step' + step).classList.remove('hidden');
            }

            function updateResumePreview() {
                document.getElementById('preview_full_name').textContent = document.getElementById('full_name').value;
                document.getElementById('preview_job_title').textContent = document.getElementById('job_title').value;
                document.getElementById('preview_full_name_right').textContent = document.getElementById('full_name').value;
                document.getElementById('preview_job_title_right').textContent = document.getElementById('job_title').value;
                document.getElementById('preview_phone').textContent = "Phone: " + document.getElementById('phone').value;
                document.getElementById('preview_email').textContent = "Email: " + document.getElementById('email').value;
                document.getElementById('preview_address').textContent = "Address: " + document.getElementById('address').value;
                document.getElementById('expertise').addEventListener('input', function () {
                    var skills = this.value;
                    var skillsContent = skills.split('\n').map(skill => `<li class='mt-4'>${skill}</li>`).join('');
                    document.getElementById('preview_expertise').innerHTML = skillsContent;
                });
                var language = document.getElementById('languages').value;

                var LanguageContent = language.split('\n').map(lng => `<li class='mt-4'>${lng}</li>`).join('');
                document.getElementById('preview_languages').innerHTML = LanguageContent;

                var hobby = document.getElementById('hobbies').value;

                var hobbyContent = hobby.split('\n').map(hobb => `<li class='mt-4'>${hobb}</li>`).join('');
                document.getElementById('preview_hobbies').innerHTML = hobbyContent;

                document.getElementById('preview_about_me').textContent = document.getElementById('about_me').value;
                var preview_jobtitle1 = document.getElementById('preview_jobtitle1');
                var preview_jobduration1 = document.getElementById('preview_jobduration1');
                var preview_companyname1 = document.getElementById('preview_companyname1');
                var preview_jobposition1 = document.getElementById('preview_jobposition1');
                var preview_jobdiscription1 = document.getElementById('preview_jobdiscription1');
                document.getElementById('job_title_1').addEventListener("input", function (e) {
                    document.getElementById('preview_jobtitle1').innerHTML = e.target.value;
                });
                document.getElementById('company_name_1').addEventListener("input", function (e) {
                    document.getElementById('preview_companyname1').innerHTML = e.target.value;
                });
                document.getElementById('joblocation1').addEventListener("input", function (e) {
                    document.getElementById('preveiw_joblocation1').innerHTML = e.target.value;
                });
                document.getElementById('job_position_1').addEventListener("input", function (e) {
                    document.getElementById('preview_jobposition1').innerHTML = e.target.value;
                });
                document.getElementById('job_duration_start1').addEventListener("input", function (e) {
                    document.getElementById('preview_duration_start1').innerHTML = e.target.value;
                });
                document.getElementById('job_duration_end1').addEventListener("input", function (e) {
                    document.getElementById('preview_duration_end1').innerHTML = e.target.value;
                });

                document.getElementById('job_description_1').addEventListener("input", function (e) {
                    document.getElementById('preview_jobdiscription1').innerHTML = e.target.value;
                });

                document.getElementById('job_title_2').addEventListener("input", function (e) {
                    document.getElementById('preview_jobtitle2').innerHTML = e.target.value;
                });
                document.getElementById('company_name_2').addEventListener("input", function (e) {
                    document.getElementById('preview_companyname2').innerHTML = e.target.value;
                });
                document.getElementById('joblocation2').addEventListener("input", function (e) {
                    document.getElementById('preveiw_joblocation2').innerHTML = e.target.value;
                });
                document.getElementById('job_duration_start2').addEventListener("input", function (e) {
                    document.getElementById('pduration_start2').innerHTML = e.target.value;
                });
                document.getElementById('job_duration_end2').addEventListener("input", function (e) {
                    document.getElementById('pduration_end2').innerHTML = e.target.value;
                });
                document.getElementById('job_description_2').addEventListener("input", function (e) {
                    document.getElementById('preview_jobdiscription2').innerHTML = e.target.value;
                });
                document.getElementById('Education_name1').addEventListener("input", function (e) {
                    document.getElementById('Digree_name1').innerHTML = e.target.value;
                });
                document.getElementById('Education_passoutdate1').addEventListener("input", function (e) {
                    document.getElementById('digree1_passout_date1').innerHTML = e.target.value;
                });
                document.getElementById('Education_discription1').addEventListener("input", function (e) {
                    document.getElementById('preview_education_discription1').innerHTML = e.target.value;
                });
                document.getElementById('Education_name2').addEventListener("input", function (e) {
                    document.getElementById('Digree_name2').innerHTML = e.target.value;
                });
                document.getElementById('Education_passoutdate2').addEventListener("input", function (e) {
                    document.getElementById('digree2_passout_date2').innerHTML = e.target.value;
                });
                document.getElementById('Education_discription2').addEventListener("input", function (e) {
                    document.getElementById('preview_education_discription2').innerHTML = e.target.value;
                });
                //referecne section
                document.getElementById('r_name').addEventListener("input", function (e) {
                    document.getElementById('preview_Reference_name').innerHTML = e.target.value;
                });

                document.getElementById('job_position_1').addEventListener("input", function (e) {
                    document.getElementById('preview_Reference_job_position_1').innerHTML = e.target.value;
                });

                document.getElementById('r_company_name_1').addEventListener("input", function (e) {
                    document.getElementById('preview_Reference_company').innerHTML = e.target.value;
                });

                document.getElementById('job_phone_1').addEventListener("input", function (e) {
                    document.getElementById('preview_Reference-phone_1').innerHTML = e.target.value;
                });

                document.getElementById('job_email_1').addEventListener("input", function (e) {
                    document.getElementById('preview_Reference_email_1').innerHTML = e.target.value;
                });

            }
            document.querySelectorAll('input, textarea').forEach(function (element) {
                element.addEventListener('input', updateResumePreview);
            });

            function downloadResume() {
                var content = document.getElementById('previewContent').innerHTML;
                var blob = new Blob([content], {
                    type: 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                });
                var link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'resume.docx';
                link.click();
            }
            document.addEventListener('DOMContentLoaded', updateResumePreview);
        </script>
    </main>
</body>

</html>