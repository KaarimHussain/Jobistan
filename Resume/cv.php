<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Resume</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full w-3/4 p-4 bg-white shadow-md rounded-lg">
        <div class="md:flex md:justify-between">
            <!-- Left side: Input fields -->
            <div class="md:w-1/2 p-4">
                <h2 class="text-2xl font-bold mb-4">Create Your Resume</h2>
                <form id="resumeForm" action="../Default_Resume/save_resume.php" method="POST">
                    <!-- Step 1: Basic Info -->
                    <div id="step1" class="step">
                        <label for="full_name" class="block mb-2">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="job_title" class="block mb-2">Job Title:</label>
                        <input type="text" id="job_title" name="job_title" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="phone" class="block mb-2">Phone:</label>
                        <input type="text" id="phone" name="phone" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="email" class="block mb-2">Email:</label>
                        <input type="email" id="email" name="email" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <label for="address" class="block mb-2">Address:</label>
                        <input type="text" id="address" name="address" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                        <div class="resume-actions flex justify-end">
                            <button type="button" onclick="showStep(2)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Next
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Work Experience -->
                    <div id="step2" class="step hidden">

                        <label for="expertise" class="block mb-2">Expertise:</label>
                        <textarea id="expertise" name="expertise" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <label for="languages" class="block mb-2">Languages:</label>
                        <textarea id="languages" name="languages" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <label for="hobbies" class="block mb-2">Hobbies:</label>
                        <textarea id="hobbies" name="hobbies" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <div class="resume-actions flex justify-end">
                            <button type="button" onclick="showStep(1)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Back
                            </button>
                            <button type="button" onclick="showStep(3)" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Next
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Education and Skills -->
                    <div id="step3" class="step hidden">

                        <label for="about_me" class="block mb-2">About Me:</label>
                        <textarea id="about_me" name="about_me" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <div id="workExperience">
                            <h3 class="text-lg font-bold mb-2">Work Experience</h3>
                            <div class="job-experience">
                                <label for="job_title_1" class="block mb-2">Job Title:</label>
                                <input type="text" id="job_title_1" name="job_title[]" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="company_name_1" class="block mb-2">Company Name:</label>
                                <input type="text" id="company_name_1" name="company_name[]" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_duration_1" class="block mb-2">Job Duration:</label>
                                <input type="text" id="job_duration_1" name="job_duration[]" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_description_1" class="block mb-2">Job Description:</label>
                                <textarea id="job_description_1" name="job_description[]" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
                            </div>
                        </div>

                        <div class="resume-actions flex justify-end">
                            <button type="button" onclick="showStep(2)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Back
                            </button>
                            <button type="button" onclick="showStep(4)" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Next
                            </button>
                        </div>
                    </div>

                    <div id="step4" class="step hidden">

                        <label for="education" class="block mb-2">Education:</label>
                        <textarea id="education" name="education" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                        <div id="Reference">
                            <h3 class="text-lg font-bold mb-2">Reference</h3>
                            <div class="job-experience">
                                <label for="r_name" class="block mb-2">Name:</label>
                                <input type="text" id="r_name" name="r_name1[]" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_position_1" class="block mb-2">Job Position:</label>
                                <input type="text" id="job_position_1" name="job_duration[]" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="company_name_1" class="block mb-2">Company Name:</label>
                                <input type="text" id="company_name_1" name="company_name[]" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                                <label for="job_phone_1" class="block mb-2">Phone:</label>
                                <input type="number" id="job_phone_1" name="job_phone[]" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <div class="resume-actions flex justify-end">
                            <button type="button" onclick="showStep(3)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Back
                            </button>
                            <button type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right side: Resume preview -->
            <div class="md:w-1/2 p-4 bg-gray-100 rounded-lg shadow-md h-full">
                <div id="resumePreview" class="hidden">
                    <div class="t1">
                        <h1 class="text-4xl text-center text-black font-extrabold" id="preview_full_name"></h1>
                        <h2 class="text-2xl text-center text-black" id="preview_job_title"></h2>
                    </div>
                    <hr class="bold-hr">
                    <div class="ls">
                        <p class="text-white text-lg"><i class="fas fa-phone"></i> <span id="preview_phone"></span></p>
                        <p class="text-white text-lg"><i class="fas fa-envelope"></i> <span id="preview_email"></span></p>
                        <p class="text-white text-lg"><i class="fas fa-map-marker-alt"></i> <span id="preview_address"></span></p>
                    </div>
                    <hr class="bold-hr1">
                    <div class="p-4">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold">Expertise</h3>
                            <p id="preview_expertise"></p>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-xl font-bold">Languages</h3>
                            <p id="preview_languages"></p>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-xl font-bold">Hobbies</h3>
                            <p id="preview_hobbies"></p>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-xl font-bold">About Me</h3>
                            <p id="preview_about_me"></p>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-xl font-bold">Education</h3>
                            <p id="preview_education"></p>
                        </div>
                        <div id="preview_work_experience_container" class="mb-4">
                            <h3 class="text-xl font-bold">Work Experience</h3>
                            <div id="preview_work_experience"></div>
                        </div>
                        <div id="preview_reference_container" class="mb-4">
                            <h3 class="text-xl font-bold">Reference</h3>
                            <div id="preview_reference"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show the specified step and hide others
        function showStep(step) {
            document.querySelectorAll('.step').forEach(function (el) {
                el.classList.add('hidden');
            });
            document.getElementById('step' + step).classList.remove('hidden');
            document.getElementById('resumePreview').classList.remove('hidden');
            updatePreview();
        }

        // Update resume preview with form input values
        function updatePreview() {
            document.getElementById('preview_full_name').innerText = document.getElementById('full_name').value;
            document.getElementById('preview_job_title').innerText = document.getElementById('job_title').value;
            document.getElementById('preview_phone').innerText = document.getElementById('phone').value;
            document.getElementById('preview_email').innerText = document.getElementById('email').value;
            document.getElementById('preview_address').innerText = document.getElementById('address').value;
            document.getElementById('preview_expertise').innerText = document.getElementById('expertise').value;
            document.getElementById('preview_languages').innerText = document.getElementById('languages').value;
            document.getElementById('preview_hobbies').innerText = document.getElementById('hobbies').value;
            document.getElementById('preview_about_me').innerText = document.getElementById('about_me').value;
            document.getElementById('preview_education').innerText = document.getElementById('education').value;

            // Update Work Experience in preview
            let workExperienceContainer = document.getElementById('preview_work_experience');
            workExperienceContainer.innerHTML = '';
            let jobTitles = document.querySelectorAll('input[name="job_title[]"]');
            let companyNames = document.querySelectorAll('input[name="company_name[]"]');
            let jobDurations = document.querySelectorAll('input[name="job_duration[]"]');
            let jobDescriptions = document.querySelectorAll('textarea[name="job_description[]"]');
            for (let i = 0; i < jobTitles.length; i++) {
                let jobDiv = document.createElement('div');
                jobDiv.innerHTML = `<h4 class="font-bold">${jobTitles[i].value} at ${companyNames[i].value} (${jobDurations[i].value})</h4><p>${jobDescriptions[i].value}</p>`;
                workExperienceContainer.appendChild(jobDiv);
            }

            // Update Reference in preview
            let referenceContainer = document.getElementById('preview_reference');
            referenceContainer.innerHTML = '';
            let referenceNames = document.querySelectorAll('input[name="r_name1[]"]');
            let jobPositions = document.querySelectorAll('input[name="job_position[]"]');
            let referenceCompanies = document.querySelectorAll('input[name="company_name[]"]');
            let referencePhones = document.querySelectorAll('input[name="job_phone[]"]');
            for (let i = 0; i < referenceNames.length; i++) {
                let referenceDiv = document.createElement('div');
                referenceDiv.innerHTML = `<h4 class="font-bold">${referenceNames[i].value} - ${jobPositions[i].value} at ${referenceCompanies[i].value}</h4><p>Phone: ${referencePhones[i].value}</p>`;
                referenceContainer.appendChild(referenceDiv);
            }
        }
    </script>
</body>

</html>
