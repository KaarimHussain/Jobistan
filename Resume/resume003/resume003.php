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
  <title>Create Your Resume</title>
  <?php
  include("../../Includes/bootstrapCss.php");
  include("../../Includes/tailwindCss.php");
  include("../../Includes/Icons.php");
  ?>
  <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
  <style>
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
  </style>
</head>

<body class="h-100 w-100">
  <main class="full-h optional-bg position-relative d-flex align-items-center">
    <button class="primary-btn position-fixed top-50 start-0 translate-middle-y m-5" type="button"
      data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
      <i class="bi bi-arrow-right-circle-fill"></i>
    </button>
    <!-- OffCanvas -->
    <div class="offcanvas offcanvas-start" data-bs-backdrop="false" data-bs-theme="dark" data-bs-scroll="true"
      tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
      <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <h2 class="text-2xl font-bold mb-4">Create Your Resume</h2>
        <form id="resumeForm" action="save_resume003.php" method="POST">
          <!-- Step 1: Basic Info -->
          <div id="step1" class="step">
            <label for="full_name" class="block mb-2">Full Name:</label>
            <input type="text" id="form_full_name" name="form_full_name" required
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

            <label for="job_title" class="block mb-2">Job Title:</label>
            <input type="text" id="form_job_title" name="form_job_title" required
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

            <label for="form_job_summary" class="block mb-2">Job Summary:</label>
            <input type="text" id="form_job_summary" name="form_job_summary" required
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
            <!-- contant section -->

            <label for="Email" class="block mb-2">Email:</label>
            <input type="email" id="form_email" name="form_email" required
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

            <label for="phone" class="block mb-2">Phone:</label>
            <input type="text" id="form_phone" name="form_phone"
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

            <label for="Location" class="block mb-2">Location:</label>
            <input type="text" id="form_Location" name="form_Location"
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

            <label for="linkedin" class="block mb-2">linkedin:</label>
            <input type="text" id="form_linkedin" name="form_linkedin"
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

            <label for="twitter" class="block mb-2">twitter:</label>
            <input type="text" id="form_twitter" name="form_twitter"
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">

            <!-- SKILLS FININSHED -->

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
              <div class="job-experience">
                <label for="job_title_1" class="block mb-2">Job Title1:</label>
                <input type="text" id="form_job_title_1" name="form_job_title_1" required
                  class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                <label for="company_name_1" class="block mb-2">Company Name:1</label>
                <input type="text" id="form_company_name_1" name="form_company_name_1" required
                  class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                <label for="job_duration_1" class="block mb-2">Job Duration:</label>
                <input type="text" id="form_job_duration_1" name="form_job_duration_1" required
                  class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                <label for="job_description_1" class="block mb-2">Job Description:</label>
                <textarea id="form_job_description_1" name="form_job_description_1" rows="4"
                  class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>

                <!-- job experiance2 -->

                <label for="job_title_2" class="block mb-2">Job Title2:</label>
                <input type="text" id="form_job_title_2" name="form_job_title_2" required
                  class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                <label for="company_name_2" class="block mb-2">Company Name:2</label>
                <input type="text" id="form_company_name_2" name="form_company_name_2" required
                  class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                <label for="job_duration_2" class="block mb-2">Job Duration:2</label>
                <input type="text" id="form_job_duration_2" name="form_job_duration_2" required
                  class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500">
                <label for="job_description_2" class="block mb-2">Job Description:2</label>
                <textarea id="form_job_description_2" name="form_job_description_2" rows="4"
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
          <!-- Step 3: Education and languages -->
          <div id="step3" class="step hidden">
            <label for="form_skills" class="block mb-2">Skills:</label>
            <textarea id="form_skills" name="form_skills" rows="4"
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"
              placeholder="Enter your skills, each on a new line"></textarea>
            <label for="form_languages" class="block mb-2">languages:</label>
            <textarea id="form_languages" name="form_languages" rows="4"
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
            <label for="form_Education1" class="block mb-2">Education:1</label>
            <textarea id="form_Education1" name="form_Education1" rows="4"
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
            <input type="date" id="form_education_date1" name="form_education_date1">
            <label for="form_Education2" class="block mb-2">Education:2</label>
            <textarea id="form_Education2" name="form_Education2" rows="4"
              class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:border-blue-500"></textarea>
            <input type="date" id="form_education_date2" name="form_education_date2">

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

    <div class="w-full w-3/4 p-4 bg-white shadow-md rounded-lg">
      <!-- Right side: Resume preview -->
      <a href="../../mainresume/CreateResume.php" class="fs-6 fw-bold"><i class="bi bi-arrow-left-circle-fill"></i> Go
        Back</a>
      <div class="d-flex align-items-center flex-column gap-2 pb-5">
        <small class="fw-bold">Resume Style</small>
        <h1 class="text-center display-5" id="heading-gradient-background">The Dynamic Curriculum</h1>
      </div>

      <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 my-5">
        <div class="bg-gray-800 text-white p-6 rounded-t-lg flex justify-between items-center">
          <div>
            <h1 class="text-4xl font-bold" id="preview_FullName"></h1>
            <p class="text-lg" id="preview_JobTitle"></p>
            <p class="mt-4" id="preview_JobSummary"></p>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-6 mt-6">
          <!-- Contact Section -->
          <div class="col-span-1">
            <h2 class="text-2xl font-bold border-b pb-2 mb-4" style="width: 800px;">Contact</h2>
            <p class="mb-4"><strong>Email:</strong>
            <p id="preview_email"></p>
            </p>
            <p class="mb-4"><strong>Phone:</strong>
            <p id="preview_phone"> </p>
            </p>
            <p class="mb-4"><strong>Location:</strong>
            <p id="preview_location"> </p>
            </p>
            <p class="mb-4"><strong>LinkedIn:</strong>
            <p id="preview_linkdin"> </p>
            </p>
            <p class="mb-4"><strong>Twitter:</strong>
            <p id="preview_twitter"></p>
            </p>

            <h2 class="text-2xl font-bold border-b pb-2 mb-4 mt-8"></h2>
            <div class="flex flex-wrap">
              <ul id="preview_skills" name="preview_skills">
              </ul>
            </div>

            <h2 class="text-2xl font-bold border-b pb-2 mb-4 mt-8">Languages</h2>
            <ul class="list-disc list-inside" id="preview_languages">
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>
          </div>

          <!-- Work Experience, Education, etc. -->
          <div class="col-span-2">
            <!-- Experience -->
            <section class="mb-6">
              <h1 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Experience</h2>
                <h1 id="preview_companyname_1"></h1>
                <p id="preview_experiance_Title1"></p>
                <P id="preview_discription1" class="overflow-wrap" style="overflow-wrap: break-word;"></P>
                <P id="preview_duration1"></P>

                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4"
                  id="preview_experience2_2_heading"></h2>
                <p id="preview_companyname_2"></p>
                <p id="preview_experiance_Title2"></p>
                <P id="preview_discription2" style="overflow-wrap: break-word;"></P>
                <P id="preview_duration2"></P>
            </section>

            <section class="mb-6">
              <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Education:2</h2>
              <div id="preview_education1_1" style="overflow-wrap:break-word;">
              </div>
              <p id="preview_education_date1"></p>

              <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Education:2</h2>
              <div id="preview_education2_2" style="overflow-wrap:break-word;">
              </div>
              <p id="preview_education_date2"></p>
            </section>
          </div>
        </div>
      </div>
      <!-- More Templates Button -->
      <?php
      include("../Default_Resume\swiperinclude.php");
      ?>
    </div>
  </main>
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
    //output fields
    var preview_FullName = document.getElementById('preview_FullName');
    var preview_JobSummary = document.getElementById('preview_JobSummary');
    var preview_email = document.getElementById('preview_email');
    var preview_phone = document.getElementById('preview_phone');
    var preview_location = document.getElementById('preview_location');
    var preview_linkdin = document.getElementById('preview_linkdin');
    var preview_twitter = document.getElementById('preview_twitter');
    var preview_skills = document.getElementById('preview_skills');
    var preview_languages = document.getElementById('preview_languages');
    var preview_education2_1 = document.getElementById('preview_education2_1');
    var preview_education2_2 = document.getElementById('preview_education2_2');
    var preview_company_name_1 = document.getElementById('preview_companyname_1');
    var preview_job_title_1 = document.getElementById('preview_experiance_Title1');
    var preview_job_description_1 = document.getElementById('preview_discription1');
    var preview_job_duration_1 = document.getElementById('preview_duration1');
    var preview_company_name_2 = document.getElementById('preview_companyname_2');
    var preview_job_title_2 = document.getElementById('preview_experiance_Title2');
    var preview_job_description_2 = document.getElementById('preview_discription2');
    var preview_job_duration_2 = document.getElementById('preview_duration2');






























    //basic info
    document.getElementById("form_full_name").addEventListener('input', function (event) {
      preview_FullName.innerHTML = event.target.value;
    });

    document.getElementById('form_job_title').addEventListener('input', function (event) {
      preview_JobTitle.innerHTML = event.target.value;
    });

    document.getElementById('form_job_summary').addEventListener('input', function (event) {
      preview_JobSummary.innerHTML = event.target.value;
    });

    document.getElementById('form_email').addEventListener('input', function (event) {
      preview_email.innerHTML = event.target.value;
    });

    document.getElementById('form_phone').addEventListener('input', function (event) {
      preview_phone.innerHTML = event.target.value;
    });

    document.getElementById('form_Location').addEventListener('input', function (event) {
      preview_location.innerHTML = event.target.value;
    });

    document.getElementById('form_linkedin').addEventListener('input', function (event) {
      preview_linkdin.innerHTML = event.target.value;
    });

    document.getElementById('form_twitter').addEventListener('input', function (event) {
      preview_twitter.innerHTML = event.target.value;
    });

    // //skill section's



    document.getElementById('form_skills').addEventListener('input', function () {
      var skills = this.value;
      var skillsContent = skills.split('\n').map(skill => `<li>${skill}</li>`).join('');
      document.getElementById('preview_skills').innerHTML = skillsContent;
    });




    //  // JavaScript code to dynamically update skills preview
    //  document.getElementById('form_skille').addEventListener('input', function() {
    //         var skills = this.value;
    //         var skillsContent = skills.split('\n').map(skill => `<li>${skill}</li>`).join('');
    //         document.getElementById('preview_skills').innerHTML = skillsContent;
    //     });


    document.getElementById('form_languages').addEventListener('input', (e) => {
      // Get the input value from the textarea
      let form_skills = e.target.value;

      // Split the input value into individual skills by line break or comma
      let skills = form_skills.split(/\n|,/).map(skill => skill.trim()).filter(skill => skill);

      // Get the ul element where the skills will be displayed
      let skillsList = document.getElementById('preview_languages');

      // Clear the existing list items
      skillsList.innerHTML = '';

      // Iterate over the skills array and create li elements
      skills.forEach(skill => {
        let li = document.createElement('li');
        li.textContent = skill;
        skillsList.appendChild(li);
      });
    });



    //education section
    document.getElementById('form_Education1').addEventListener('input', function (event) {
      preview_education1_1.innerHTML = event.target.value;
    });


    document.getElementById('form_education_date1').addEventListener('input', function (event) {
      preview_education_date1.innerHTML = event.target.value;
    });


    document.getElementById('form_Education2').addEventListener('input', function (event) {
      preview_education2_2.innerHTML = event.target.value;
    });

    document.getElementById('form_education_date2').addEventListener('input', function (event) {
      preview_education_date2.innerHTML = event.target.value;
    });




    //experiance01
    document.getElementById('form_company_name_1').addEventListener('input', function (event) {
      preview_company_name_1.innerHTML = event.target.value;
    });

    document.getElementById('form_job_title_1').addEventListener('input', function (event) {
      preview_job_title_1.innerHTML = event.target.value;
    });

    document.getElementById('form_job_description_1').addEventListener('input', function (event) {
      preview_job_description_1.innerHTML = event.target.value;
    });

    document.getElementById('form_job_duration_1').addEventListener('input', function (event) {
      preview_job_duration_1.innerHTML = event.target.value;
    });
    // experiance 02
    document.getElementById('form_company_name_2').addEventListener('input', function (event) {
      preview_company_name_2.innerHTML = event.target.value;
    });

    document.getElementById('form_job_title_2').addEventListener('input', function (event) {
      preview_job_title_2.innerHTML = event.target.value;
    });

    document.getElementById('form_job_description_2').addEventListener('input', function (event) {
      preview_job_description_2.innerHTML = event.target.value;
    });

    document.getElementById('form_job_duration_2').addEventListener('input', function (event) {
      preview_job_duration_2.innerHTML = event.target.value;
    });
  </script>

</body>

</html>