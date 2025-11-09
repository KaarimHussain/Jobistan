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
    <title>Create Your Resume - Jobistan</title>
    <?php
    include('../../Includes/bootstrapCss.php');
    include('../../Includes/Icons.php');
    ?>
    <!-- swiper no swiping -->
    <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
    <style>
        #overScreen {
            height: 100vh;
            width: 100%;
            background-color: var(--secondary-color);
            position: absolute;
            top: 100%;
            left: 0;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            /* This makes sure the overlay doesn't block clicks */
            transform: translateY(-100%);
            animation-name: overScreen;
            animation-duration: 2s;
            animation-timing-function: ease;
            z-index: 99;
        }

        @keyframes overScreen {
            0% {
                opacity: 1;
                visibility: visible;
            }

            95% {
                opacity: 0;
            }

            100% {
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                /* Ensure the overlay does not block clicks */
            }
        }


        .job-experience {
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

        .custom-dropdown {
            position: relative;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
            font-size: 18px;
        }

        .selected-option {
            padding: 8px;
            text-align: center;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
            width: 100%;
        }

        .option {
            padding: 8px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .option img {
            margin-right: 10px;
            max-width: 50px;
            /* Adjust image size as needed */
        }

        .option label {
            flex: 1;
        }

        .option:hover {
            background-color: #f9f9f9;
        }

        .swiper {
            width: 70%;
            height: 70%;
        }

        #swiper-container {
            display: none;
            margin-top: 20px;
            /* Adjust as needed to avoid overlap with other content */
        }
    </style>
</head>

<body class="full-h optional-bg position-relative d-flex align-items-center">
    <section id="overScreen" class="d-flex full-h secondary-bg justify-content-center align-items-center">
        <img src="../../Resources/JOBISTANLOGO/trans_logo1.png" height="300px" width="300px"
            class="object-fit-cover object-position-center" alt="">
    </section>
    <button class="primary-btn position-fixed top-50 start-0 translate-middle-y m-5" type="button"
        data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <i class="bi bi-arrow-right-circle-fill"></i>
    </button>
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" data-bs-backdrop="false" data-bs-theme="dark" data-bs-scroll="true"
        tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="col-12">
                <h2 class="text-2xl font-bold mb-4">Create Your Resume</h2>
                <form id="resumeForm" action="../Default_Resume/save_resume.php" method="POST">
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
                            <option value="less_1">Less then 1 Year</option>
                            <option value="1">1+ Years</option>
                            <option value="3">3+ Years</option>
                            <option value="5">5+ Years</option>
                            <option value="10">10+ Years</option>
                            <option value="15">15+ Years</option>
                        </select>
                        <label for="email" class="block mb-2">Email:</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="phone" class="block mb-2">Phone:</label>
                        <input type="text" id="phone" name="phone"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="linkedin" class="block mb-2">LinkedIn:</label>
                        <input type="text" id="linkedin" name="linkedin"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="summary" class="block mb-2">Summary:</label>
                        <textarea id="summary" name="summary" rows="4"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <div class="resume-actions flex justify-end">
                            <button type="button" onclick="showStep(2)" class="primary-btn">
                                Next
                            </button>
                        </div>
                    </div>
                    <!-- Step 2: Work Experience -->
                    <div id="step2" class="step hidden">
                        <div id="workExperience">
                            <h3 class="text-lg font-bold mb-2">Work Experience</h3>
                            <div class="job-experience border-none">
                                <label for="job_title_1" class="block mb-2">Job Title:</label>
                                <input type="text" id="job_title_1" name="job_title[]" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="company_name_1" class="block mb-2">Company Name:</label>
                                <input type="text" id="company_name_1" name="company_name[]" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_duration_1" class="block mb-2">Job Duration:</label>
                                <input type="text" id="job_duration_1" name="job_duration[]" required
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_description_1" class="block mb-2">Job Description:</label>
                                <textarea id="job_description_1" name="job_description[]" rows="4"
                                    class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                            </div>
                        </div>
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
                        <label for="education" class="block mb-2">Education:</label>
                        <textarea id="education" name="education" rows="4"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <label for="skills" class="block mb-2">Skills:</label>
                        <textarea id="skills" name="skills" rows="4"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <div class="resume-actions flex justify-end gap-3">
                            <button type="button" onclick="showStep(2)" class="primary-btn">
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
    </div>
    <!--  -->
    <div class="container">
        <a href="../../mainresume/CreateResume.php" class="fs-6 fw-bold"><i class="bi bi-arrow-left-circle-fill"></i> Go
            Back</a>
        <div class="d-flex align-items-center flex-column gap-2">
            <small class="fw-bold">Resume Style</small>
            <h1 class="text-center display-5" id="heading-gradient-background">The Apex Achievement</h1>
        </div>
        <div class="row d-flex flex-column align-items-end">
            <!-- Right side: Resume preview -->
            <div class="col-lg-10 col-md-11 col-sm-12 col-12">
                <div class="p-4">
                    <div id="previewContent" class="text-sm">
                        <!-- Initial Template Content -->
                        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-10 p-6">
                            <!-- Header -->
                            <header class="flex flex-col items-center border-b-2 pb-4 mb-6">
                                <h1 id="preview_name" class="text-3xl font-bold text-gray-900"></h1>
                                <p id="preview_job_title" class="text-xl text-gray-600"></p>
                                <div id="preview_contact" class="mt-2 text-gray-600"></div>
                            </header>

                            <!-- Summary -->
                            <section class="mb-6">
                                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Summary</h2>
                                <p id="preview_summary"></p>
                            </section>

                            <!-- Experience -->
                            <section class="mb-6">
                                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Experience</h2>
                                <div id="preview_experience"></div>
                            </section>

                            <!-- Education -->
                            <section class="mb-6">
                                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Education</h2>
                                <div id="preview_education"></div>
                            </section>

                            <!-- Skills -->
                            <section>
                                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Skills</h2>
                                <ul id="preview_skills" class="list-disc list-inside text-gray-700"></ul>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <?php
                include("./swiperinclude.php");
                ?>
            </div>
        </div>
    </div>
    <?php
    include("../../Includes/bootstrapJs.php");
    include("../../Includes/swiperJs.php");
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiperContainer = document.getElementById('swiper-container');
            // Show Swiper function
            document.getElementById('showSwiperButton').addEventListener('click', function () {
                swiperContainer.style.display = 'block';
                document.getElementById('hideSwiperButton').style.display = 'inline-block';
                this.style.display = 'none'; // Hide show button

                // Initialize Swiper if not already initialized
                if (!swiperContainer.swiper) {
                    const swiper = new Swiper('.swiper', {
                        direction: 'horizontal',
                        loop: true,
                        slidesPerView: 3,
                        spaceBetween: 30,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                }
            });
            // Hide Swiper function
            document.getElementById('hideSwiperButton').addEventListener('click', function () {
                swiperContainer.style.display = 'none';
                document.getElementById('showSwiperButton').style.display = 'inline-block';
                this.style.display = 'none'; // Hide hide button

                // Optionally destroy Swiper instance to clean up
                const swiperInstance = swiperContainer.swiper;
                if (swiperInstance) {
                    swiperInstance.destroy(true, true);
                }
            });
        });

        function showStep(step) {
            document.querySelectorAll('.step').forEach(function (stepDiv) {
                stepDiv.classList.add('hidden');
            });
            document.getElementById('step' + step).classList.remove('hidden');
        }

        function updateResumePreview() {
            var fullName = document.getElementById('full_name').value;
            var jobTitle = document.getElementById('job_title').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var linkedin = document.getElementById('linkedin').value;
            var summary = document.getElementById('summary').value;
            var education = document.getElementById('education').value;
            var skills = document.getElementById('skills').value;
            var experienceFields = document.querySelectorAll('.job-experience');

            document.getElementById('preview_name').textContent = fullName;
            document.getElementById('preview_job_title').textContent = jobTitle;
            document.getElementById('preview_contact').innerHTML = `${email} | ${phone} | ${linkedin}`;
            document.getElementById('preview_summary').textContent = summary;
            var experienceContent = '';
            experienceFields.forEach(function (field, index) {
                var jobTitle = field.querySelector('[name="job_title[]"]').value;
                var companyName = field.querySelector('[name="company_name[]"]').value;
                var jobDuration = field.querySelector('[name="job_duration[]"]').value;
                var jobDescription = field.querySelector('[name="job_description[]"]').value;
                experienceContent += `
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">${jobTitle}</h3>
                        <p class="text-gray-700">${companyName} | ${jobDuration}</p>
                        <ul class="list-disc list-inside mt-2 text-gray-700">
                            ${jobDescription.split('\n').map(line => `<li>${line}</li>`).join('')}
                        </ul>
                    </div>
                `;
            });
            document.getElementById('preview_experience').innerHTML = experienceContent;
            // document.getElementById('preview_experience').innerHTML = "LOLOGASFAG";
            document.getElementById('preview_education').innerHTML = education;
            var skillsContent = skills.split('\n').map(skill => `<li>${skill}</li>`).join('');

            document.getElementById('preview_skills').innerHTML = skillsContent;
        }
        document.querySelectorAll('input, textarea').forEach(function (element) {
            element.addEventListener('input', updateResumePreview);
        });
    </script>
</body>

</html>