<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
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

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg t1" style="width: 75%; margin: auto;">
        <div class="flex">
            <!-- Left Section -->
            <div class="w-1/3 ls bg-blue-900 text-white">
                <div class="mb-4">
                    <img src="../Covid_Vaccination/eProject/img/covid_test.png" alt="Profile Picture"
                        class="rounded-full w-32 h-32 mx-auto">
                </div>
                <div class="text-center">
                    <h2 class="text-2xl font-bold mb-2">Mariana Anderson</h2>
                    <p class="text-lg">Marketing Manager</p>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-semibold">Contact</h3>
                    <hr class="mt-1 bold-hr">
                    <p class="mt-4">Phone: 123-456-7890</p>
                    <p class="mt-4">Email: hello@reallygreatsite.com</p>
                    <p class="mt-4">Address: 123 Anywhere St., Any City</p>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold">Hobbies</h3>
                    <hr class="mt-1 bold-hr">
                    <ul class="list-disc list-inside">
                        <li class="mt-4">Gamer</li>
                        <li class="mt-4">Dater</li>
                    </ul>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold">Expertise</h3>
                    <hr class="mt-1 bold-hr">
                    <ul class="list-disc list-inside">
                        <li class="mt-4">UI/UX</li>
                        <li class="mt-4">Visual Design</li>
                        <li class="mt-4">Wireframes</li>
                        <li class="mt-4">Storyboards</li>
                        <li class="mt-4">User Flows</li>
                        <li class="mt-4">Process Flows</li>
                    </ul>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold">Language</h3>
                    <hr class="mt-1 bold-hr">
                    <ul class="list-disc list-inside">
                        <li class="mt-4">English</li>
                        <li class="mt-4">Spanish</li>
                    </ul>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold">Hobbies</h3>
                    <hr class="mt-1 bold-hr">
                    <ul class="list-disc list-inside">
                        <li class="mt-4">Gamer</li>
                        <li class="mt-4">Dater</li>
                    </ul>
                </div>
            </div>
            <!-- Right Section: Dynamically Generated Preview -->
            <div class="w-3/4 p-8 bg-gray-100">
                <h2 class="text-3xl text-blue-900 font-bold mt-4" id="preview_full_name"></h2>
                <p class="text-xl text-gray-600" id="preview_job_title"></p>
                <h3 class="text-2xl font-semibold mt-20">About Me</h3>
                <hr class="mt-1 bold-hr1">
                <p class="mt-4" id="preview_summary"></p>
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold">Experience</h3>
                    <hr class="mt-1 bold-hr1">
                    <div id="preview_experience" class="mt-4"></div>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-semibold">Education</h3>
                    <hr class="mt-1 bold-hr1">
                    <div id="preview_education" class="mt-4"></div>
                </div>
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold">Reference</h3>
                    <hr class="mt-1 bold-hr1">
                    <div id="preview_reference" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dummy data for preview (replace with dynamic data handling)
        const dummyData = {
            full_name: "Mariana Anderson",
            job_title: "Marketing Manager",
            summary: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pharetra in lorem at laoreet. Donec hendrerit libero eget est tempor, quis tempus arcu elementum. In elementum elit at dui tristique feugiat. Mauris convallis, mi at mattis malesuada, neque nulla volutpat dolor, hendrerit faucibus eros nibh ut nunc.",
            experience: [
                {
                    duration: "2019 - 2022",
                    company: "Company Name",
                    location: "123 Anywhere St., Any City",
                    job_title: "Job position here",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pharetra in lorem at laoreet. Donec hendrerit libero eget est tempor, quis tempus arcu elementum. In elementum elit at dui tristique feugiat. Mauris convallis, mi at mattis malesuada, neque nulla volutpat dolor, hendrerit faucibus eros nibh ut nunc."
                },
                {
                    duration: "2019 - 2022",
                    company: "Company Name",
                    location: "123 Anywhere St., Any City",
                    job_title: "Job position here",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pharetra in lorem at laoreet. Donec hendrerit libero eget est tempor, quis tempus arcu elementum. In elementum elit at dui tristique feugiat. Mauris convallis, mi at mattis malesuada, neque nulla volutpat dolor, hendrerit faucibus eros nibh ut nunc."
                }
            ],
            education: [
                "2008 - Enter Your Degree University/College",
                "2008 - Enter Your Degree University/College"
            ],
            reference: {
                name: "Name Surname",
                job_title: "Job position, Company Name",
                phone: "123-456-7890",
                email: "hello@reallygreatsite.com"
            }
        };

        // Function to update preview with dummy data (replace with dynamic data handling)
        function updatePreview() {
            document.getElementById('preview_full_name').textContent = dummyData.full_name;
            document.getElementById('preview_job_title').textContent = `(${dummyData.job_title})`;
            document.getElementById('preview_summary').textContent = dummyData.summary;
            
            // Populate experience section
            const experienceContainer = document.getElementById('preview_experience');
            experienceContainer.innerHTML = "";
            dummyData.experience.forEach(exp => {
                const expElement = document.createElement('div');
                expElement.classList.add('mt-4');
                expElement.innerHTML = `
                    <p class="text-lg font-semibold">${exp.duration}</p>
                    <p class="text-lg font-semibold">${exp.company} | ${exp.location}</p>
                    <p class="text-lg font-semibold">${exp.job_title}</p>
                    <p class="mt-2 text-gray-600">${exp.description}</p>
                `;
                experienceContainer.appendChild(expElement);
            });
            
            // Populate education section
            const educationContainer = document.getElementById('preview_education');
            educationContainer.innerHTML = "";
            dummyData.education.forEach(edu => {
                const eduElement = document.createElement('p');
                eduElement.classList.add('mt-4');
                eduElement.textContent = edu;
                educationContainer.appendChild(eduElement);
            });
            
            // Populate reference section
            document.getElementById('preview_reference').innerHTML = `
                <p class="text-lg font-semibold">${dummyData.reference.name}</p>
                <p class="text-lg font-semibold">${dummyData.reference.job_title}</p>
                <p class="mt-2">Phone: ${dummyData.reference.phone}</p>
                <p>Email: ${dummyData.reference.email}</p>
            `;
        }

        // Call updatePreview on page load (replace with your actual data handling logic)
        window.addEventListener('DOMContentLoaded', () => {
            updatePreview();
        });
    </script>
</body>

</html>
