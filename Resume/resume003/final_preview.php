<?php
include('../../Includes/sessionStart.php');
$full_name = isset($_GET['form_full_name']) ? htmlspecialchars($_GET['form_full_name']) : '';
$job_title = isset($_GET['form_job_title']) ? htmlspecialchars($_GET['form_job_title']) : '';
$job_summary = isset($_GET['form_job_summary']) ? htmlspecialchars($_GET['form_job_summary']) : '';
$email = isset($_GET['form_email']) ? htmlspecialchars($_GET['form_email']) : '';
$phone = isset($_GET['form_phone']) ? htmlspecialchars($_GET['form_phone']) : '';
$linkedin = isset($_GET['form_linkedin']) ? htmlspecialchars($_GET['form_linkedin']) : '';
$location1 = isset($_GET['form_location']) ? htmlspecialchars($_GET['form_location']) : '';
$twitter = isset($_GET['form_twitter']) ? htmlspecialchars($_GET['form_twitter']) : '';
$job_title_1 = isset($_GET['form_job_tittle_1']) ? htmlspecialchars($_GET['form_job_tittle_1']) : '';
$company_name_1 = isset($_GET['form_company_name_1']) ? htmlspecialchars($_GET['form_company_name_1']) : '';
$job_duration_1 = isset($_GET['form_job_duration_1']) ? htmlspecialchars($_GET['form_job_duration_1']) : '';
$job_description_1 = isset($_GET['form_job_description_1']) ? htmlspecialchars($_GET['form_job_description_1']) : '';
$job_title_2 = isset($_GET['form_job_title_2']) ? htmlspecialchars($_GET['form_job_title_2']) : '';
$company_name_2 = isset($_GET['form_company_name_2']) ? htmlspecialchars($_GET['form_company_name_2']) : '';
$job_duration_2 = isset($_GET['form_job_duration_2']) ? htmlspecialchars($_GET['form_job_duration_2']) : '';
$job_description_2 = isset($_GET['form_job_description_2']) ? htmlspecialchars($_GET['form_job_description_2']) : '';
$form_skills = isset($_GET['form_skills']) ? htmlspecialchars($_GET['form_skills']) : '';
$languages = isset($_GET['form_languages']) ? htmlspecialchars($_GET['form_languages']) : '';
$Education1 = isset($_GET['form_Education1']) ? htmlspecialchars($_GET['form_Education1']) : '';
$Education_date1 = isset($_GET['form_education_date1']) ? htmlspecialchars($_GET['form_education_date1']) : '';
$Education2 = isset($_GET['form_Education2']) ? htmlspecialchars($_GET['form_Education2']) : '';
$Education_date2 = isset($_GET['form_education_date2']) ? htmlspecialchars($_GET['form_education_date2']) : '';
$skills = isset($_GET['SKILLSTOFORM']) ? $_GET['SKILLSTOFORM'] : '';
$Langs = isset($_GET['form_languages']) ? $_GET['form_languages'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download Resume - Jobistan</title>
  <?php
  include('../../Includes/bootstrapCss.php');
  include('../../Includes/Icons.php');
  include('../../Includes/tailwindCss.php');
  ?>
  <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>

<body>
  <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <div id="resume003" class="max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-10 p-6">
      <div class="bg-gray-800 text-white p-6 rounded-t-lg flex justify-between items-center">
        <div>
          <h1 class="text-4xl font-bold"><?php echo $full_name ?></h1>
          <p class="text-lg"><?php echo $job_title ?></p>
          <p class="mt-4" style="overflow-wrap:break-word;"><?php echo $job_summary ?></p>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-6 mt-6">
        <!-- Contact Section -->
        <div class="col-span-1">
          <h2 class="text-2xl font-bold border-b pb-2 mb-4">Contact</h2>
          <p class="mb-4"><strong>Email:</strong> <?php echo $email ?></p>
          <p class="mb-4"><strong>Phone:</strong> <?php echo $phone ?></p>
          <p class="mb-4"><strong>Location:</strong> <?php echo $location1 ?></p>
          <p class="mb-4"><strong>LinkedIn:</strong><?php echo $linkedin ?></p>
          <p class="mb-4"><strong>Twitter:</strong> <?php echo $twitter ?></p>
          <h2 class="text-2xl font-bold border-b pb-2 mb-4 mt-8">Skills & Competencies</h2>
          <div class="flex flex-wrap">

            <?php
            $skills_array = explode("\r\n", $skills);
            ?>

            <ul id="preview_skills">
              <?php foreach ($skills_array as $skill) : ?>
                <li><?php echo htmlspecialchars($skill); ?></li>
              <?php endforeach; ?>
            </ul>


          </div>
          <h2 class="text-2xl font-bold border-b pb-2 mb-4 mt-8">Languages</h2>
          <?php
          $Langs_array = explode("\r\n", $Langs);
          ?>

          <ul id="preview_skills">
            <?php foreach ($Langs_array as $Langs) : ?>
              <li><?php echo htmlspecialchars($Langs); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <!-- Work Experience, Education, etc. -->
        <div class="col-span-2" style="position:relative;left: 50px;">
          <h1 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Experience</h2>
            <section class="mb-6">
              <h1> <?php echo $company_name_1 ?></h1>
              <h1><?php echo $job_title_1 ?></h1>
              <P style="overflow-wrap:break-word;"><?php echo $job_duration_1 ?></P>
              <p style="overflow-wrap:break-word;"> <?php echo $job_description_1 ?></p>

              <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4" id="preview_experience2_2_heading"></h2>
              <h1> <?php echo $company_name_2 ?></h1>
              <h1><?php echo $job_title_2 ?></h1>
              <P><?php echo $job_duration_2 ?></P>
              <P style="overflow-wrap:break-word;"> <?php echo $job_description_2 ?></P>
            </section>
            <section class="mb-6">
              <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Education: 1</h2>
              <div style="overflow-wrap:break-word;">
                <?php echo $Education1 ?></div>
              <p><?php echo $Education_date1 ?></p>

              <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Education: 2</h2>
              <div style="overflow-wrap:break-word;">
                <?php echo $Education2 ?></div>
              <p><?php echo $Education_date2 ?></p>
            </section>
        </div>
      </div>

    </div>
  </div>
  <div class="text-center my-6">
    <div class="d-flex justify-center mt-6 d-flex gap-3">
      <button id="downloadButton" class="primary-btn">
        Download as PDF and Return Home
      </button>
    </div>
  </div>

  <script>
    console.log("Called");
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('downloadButton').addEventListener('click', function() {
        var element = document.getElementById('resume003');
        html2pdf().from(element).output('blob').then(function(blob) {
          // Download the PDF
          var url = URL.createObjectURL(blob);
          var a = document.createElement('a');
          a.href = url;
          a.download = '<?php echo $_SESSION['logged']['username']; ?>_Resume.pdf';
          document.body.appendChild(a);
          a.click();
          URL.revokeObjectURL(url);
          // Send the PDF to the server
          var formData = new FormData();
          formData.append('pdf', blob, '<?php echo $_SESSION['logged']['username']; ?>_Resume.pdf');
          fetch('../Default_Resume/saveUserPDFinDB.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.text())
            .then(result => {
              console.log('PDF saved and path recorded in database:', result);
              window.location.href = "../../home.php";
            })
            .catch(error => {
              console.error('Error saving PDF:', error);
            });
        });
      });
    });
  </script>
</body>

</html>