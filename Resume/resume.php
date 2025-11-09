<!-- <!DOCTYPE html>
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
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full md:w-4/5 lg:w-3/4 xl:w-1/2 p-4 bg-white shadow-md rounded-lg">
        <div class="md:flex md:justify-between">
            <div class="md:w-1/2 p-4">
                <h2 class="text-2xl font-bold mb-4">Create Your Resume</h2>
                <form id="resumeForm" action="create_resume.php" method="POST">
                    <label for="full_name" class="block mb-2">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" required
                        class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                    <label for="email" class="block mb-2">Email:</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                    <label for="phone" class="block mb-2">Phone:</label>
                    <input type="text" id="phone" name="phone"
                        class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                    <label for="education" class="block mb-2">Education:</label>
                    <textarea id="education" name="education" rows="4"
                        class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                    <div id="workExperience">
                        <h3 class="text-lg font-bold mb-2">Work Experience</h3>
                        <div class="job-experience">
                            <label for="company_name_1" class="block mb-2">Company Name:</label>
                            <input type="text" id="company_name_1" name="company_name[]" required
                                class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                            <label for="job_duration_1" class="block mb-2">Job Duration:</label>
                            <input type="text" id="job_duration_1" name="job_duration[]" required
                                class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                            <label for="job_type_1" class="block mb-2">Job Type:</label>
                            <input type="text" id="job_type_1" name="job_type[]"
                                class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                        </div>
                    </div>

                    <label for="skills" class="block mb-2">Skills:</label>
                    <textarea id="skills" name="skills" rows="4"
                        class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                    <div class="resume-actions">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create Resume
                        </button>
                    </div>
                </form>
            </div>

            <div class="md:w-1/2 p-4">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-bold mb-4">Resume Preview</h3>
                    <div id="previewContent" class="text-sm">
                        Your resume preview will appear here...
                    </div>
                    <div class="template-selection mt-4">
                        <h4 class="font-bold">Choose Template:</h4>
                        <select id="templateSelect"
                            class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                            <option value="template1">Template 1</option>
                            <option value="template2">Template 2</option>
                        </select>
                    </div>
                    <div class="resume-actions">
                        <button onclick="downloadResume()"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Download Resume (.docx)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateResumePreview() {
            var fullName = document.getElementById('full_name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var education = document.getElementById('education').value;
            var experienceFields = document.querySelectorAll('.job-experience');
            var skills = document.getElementById('skills').value;
            var template = document.getElementById('templateSelect').value;

            var previewContent = `
                <h3 class="text-lg font-bold">${fullName}</h3>
                ${email ? `<p class="text-sm"><i class="fas fa-envelope mr-2"></i>${email}</p>` : ''}
                ${phone ? `<p class="text-sm"><i class="fas fa-phone mr-2"></i>${phone}</p>` : ''}
                <h4 class="text-md font-bold">Education:</h4>
                <p class="text-sm">${education}</p>
                <h4 class="text-md font-bold">Work Experience:</h4>
            `;

            experienceFields.forEach(function (field, index) {
                var companyName = field.querySelector('[name="company_name[]"]').value;
                var jobDuration = field.querySelector('[name="job_duration[]"]').value;
                var jobType = field.querySelector('[name="job_type[]"]').value;
                previewContent += `
                    <p class="text-sm"><strong>${companyName}</strong> (${jobDuration}) - ${jobType}</p>
                `;
            });

            previewContent += `
                <h4 class="text-md font-bold">Skills:</h4>
                <p class="text-sm">${skills}</p>
            `;

            document.getElementById('previewContent').innerHTML = previewContent;
        }

        document.getElementById('resumeForm').addEventListener('input', function (event) {
            updateResumePreview();
            var emailIcon = document.querySelector('.email-icon');
            var phoneIcon = document.querySelector('.phone-icon');
            var emailInput = document.getElementById('email');
            var phoneInput = document.getElementById('phone');

            if (emailInput.value.trim() !== '') {
                emailIcon.style.display = 'inline-block';
            } else {
                emailIcon.style.display = 'none';
            }

            if (phoneInput.value.trim() !== '') {
                phoneIcon.style.display = 'inline-block';
            } else {
                phoneIcon.style.display = 'none';
            }
        });

        function downloadResume() {
            var fullName = document.getElementById('full_name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var education = document.getElementById('education').value;
            var experienceFields = document.querySelectorAll('.job-experience');
            var skills = document.getElementById('skills').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'download_resume.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.responseType = 'blob';

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var blob = xhr.response;
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = fullName + '_resume.docx';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            };

            var jobExperience = [];
            experienceFields.forEach(function (field) {
                var companyName = field.querySelector('[name="company_name[]"]').value;
                var jobDuration = field.querySelector('[name="job_duration[]"]').value;
                var jobType = field.querySelector('[name="job_type[]"]').value;
                jobExperience.push({
                    company_name: companyName,
                    job_duration: jobDuration,
                    job_type: jobType
                });
            });

            var data = JSON.stringify({
                full_name: fullName,
                email: email,
                phone: phone,
                education: education,
                experience: jobExperience,
                skills: skills
            });

            xhr.send(data);
        }
    </script>
</body>

</html> -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Resume</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
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
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full md:w-4/5 lg:w-3/4 xl:w-1/2 p-4 bg-white shadow-md rounded-lg">
        <div class="md:flex md:justify-between">
            <!-- Left side: Input fields -->
            <div class="md:w-1/2 p-4">
                <h2 class="text-2xl font-bold mb-4">Create Your Resume</h2>
                <form id="resumeForm" action="create_resume.php" method="POST">
                    <label for="full_name" class="block mb-2">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                    <label for="email" class="block mb-2">Email:</label>
                    <input type="email" id="email" name="email" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                    <label for="phone" class="block mb-2">Phone:</label>
                    <input type="text" id="phone" name="phone" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                    <label for="education" class="block mb-2">Education:</label>
                    <textarea id="education" name="education" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                    <div id="workExperience">
                        <h3 class="text-lg font-bold mb-2">Work Experience</h3>
                        <div class="job-experience">
                            <label for="company_name_1" class="block mb-2">Company Name:</label>
                            <input type="text" id="company_name_1" name="company_name[]" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                            <label for="job_duration_1" class="block mb-2">Job Duration:</label>
                            <input type="text" id="job_duration_1" name="job_duration[]" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

                            <label for="job_type_1" class="block mb-2">Job Type:</label>
                            <input type="text" id="job_type_1" name="job_type[]" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                        </div>
                    </div>

                    <label for="skills" class="block mb-2">Skills:</label>
                    <textarea id="skills" name="skills" rows="4" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                    <div class="resume-actions">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create Resume
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right side: Resume preview -->
            <div class="md:w-1/2 p-4">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-bold mb-4">Resume Preview</h3>
                    <div id="previewContent" class="text-sm">
                        Your resume preview will appear here...
                    </div>
                    <div class="template-selection mt-4">
                        <h4 class="font-bold">Choose Template:</h4>
                        <select id="templateSelect" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                            <option value="template1">Template 1</option>
                            <option value="template2">Template 2</option>
                        </select>
                    </div>
                    <div class="resume-actions">
                        <button onclick="downloadResume()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Download Resume (.docx)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateResumePreview() {
            var fullName = document.getElementById('full_name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var education = document.getElementById('education').value;
            var experienceFields = document.querySelectorAll('.job-experience');
            var skills = document.getElementById('skills').value;
            var template = document.getElementById('templateSelect').value;

            var previewContent = `
                <h3 class="text-lg font-bold">${fullName}</h3>
                ${email ? `<p class="text-sm"><i class="fas fa-envelope mr-2"></i>${email}</p>` : ''}
                ${phone ? `<p class="text-sm"><i class="fas fa-phone mr-2"></i>${phone}</p>` : ''}
                <h4 class="text-md font-bold">Education:</h4>
                <p class="text-sm">${education}</p>
                <h4 class="text-md font-bold">Work Experience:</h4>
            `;

            experienceFields.forEach(function(field, index) {
                var companyName = field.querySelector('[name="company_name[]"]').value;
                var jobDuration = field.querySelector('[name="job_duration[]"]').value;
                var jobType = field.querySelector('[name="job_type[]"]').value;
                previewContent += `
                    <p class="text-sm"><strong>${companyName}</strong> (${jobDuration}) - ${jobType}</p>
                `;
            });

            previewContent += `
                <h4 class="text-md font-bold">Skills:</h4>
                <p class="text-sm">${skills}</p>
            `;

            document.getElementById('previewContent').innerHTML = previewContent;
        }

        var inputFields = document.querySelectorAll('input, textarea, select');
        inputFields.forEach(function(input) {
            input.addEventListener('input', function() {
                updateResumePreview();
            });
        });

        function downloadResume() {
            var fullName = document.getElementById('full_name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var education = document.getElementById('education').value;
            var experienceFields = document.querySelectorAll('.job-experience');
            var skills = document.getElementById('skills').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'download_resume.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.responseType = 'blob';

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var blob = xhr.response;
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = fullName + '_resume.docx';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            };

            var jobExperience = [];
            experienceFields.forEach(function(field) {
                var companyName = field.querySelector('[name="company_name[]"]').value;
                var jobDuration = field.querySelector('[name="job_duration[]"]').value;
                var jobType = field.querySelector('[name="job_type[]"]').value;
                jobExperience.push({
                    companyName: companyName,
                    jobDuration: jobDuration,
                    jobType: jobType
                });
            });

            var data = JSON.stringify({
                full_name: fullName,
                email: email,
                phone: phone,
                education: education,
                experience: jobExperience,
                skills: skills
            });

            xhr.send(data);
        }
    </script>
</body>

</html>