<?php
include('../../Includes/sessionStart.php');
$full_name = isset($_GET['full_name']) ? htmlspecialchars($_GET['full_name']) : '';
$job_title = isset($_GET['job_title']) ? htmlspecialchars($_GET['job_title']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$phone = isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : '';
$address = isset($_GET['address']) ? htmlspecialchars($_GET['address']) : '';
$dob = isset($_GET['dob']) ? htmlspecialchars($_GET['dob']) : '';
$summary = isset($_GET['summary']) ? htmlspecialchars($_GET['summary']) : '';
$job_title1 = isset($_GET['job_title1']) ? htmlspecialchars($_GET['job_title1']) : '';
$company_name = isset($_GET['company_name']) ? htmlspecialchars($_GET['company_name']) : '';
$job_duration_start = isset($_GET['job_duration_start']) ? htmlspecialchars($_GET['job_duration_start']) : '';
$job_duration_end = isset($_GET['job_duration_end']) ? htmlspecialchars($_GET['job_duration_end']) : '';
$job_description = isset($_GET['job_description']) ? htmlspecialchars($_GET['job_description']) : '';
$education_name = isset($_GET['education_name']) ? htmlspecialchars($_GET['education_name']) : '';
$education_description = isset($_GET['education_description']) ? htmlspecialchars($_GET['education_description']) : '';
$education_name2 = isset($_GET['education_name2']) ? htmlspecialchars($_GET['education_name2']) : '';
$education_description2 = isset($_GET['education_description2']) ? htmlspecialchars($_GET['education_description2']) : '';
$education_name3 = isset($_GET['education_name3']) ? htmlspecialchars($_GET['education_name3']) : '';
$education_description3 = isset($_GET['education_description3']) ? htmlspecialchars($_GET['education_description3']) : '';
$skills = isset($_GET['skills']) ? htmlspecialchars($_GET['skills']) : '';
$language_list = isset($_GET['language_list']) ? htmlspecialchars($_GET['language_list']) : '';

// Now you can use these variables as needed in your PHP script
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resume</title>
  <?php
  include('../../Includes/bootstrapCss.php');
  include('../../Includes/Icons.php');
  ?>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 p-10">
  <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <div class="col-span-2">
      <h2 class="text-2xl font-bold mb-4"></h2>
      <div id="resume003" class="max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-10 p-6">

        <div class="flex justify-between items-center border-b-2 border-green-600 pb-6">
          <div>
            <h1 class="text-4xl text-green-600 font-bold"><?php echo $full_name; ?></h1>
            <p class="text-gray-600"><?php echo $job_title; ?></p>
          </div>
          <div class="flex items-center justify-center h-full">
            <div class="text-center">
            </div>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-6 mt-6">
          <!-- Contact Section -->
          <div class="col-span-1">
            <h2 class="text-2xl text-green-600 border-b-2 border-green-600 font-bold pb-2">Contact</h2>
            <p class="mt-4">
              <strong?>Email:</strong> <span><?php echo $email; ?></span>
            </p>
            <p class="mt-4">
              <strong?>Address:</strong> <span><?php echo $address; ?></span>
            </p>
            <p class="mt-4">
              <strong?>Phone:</strong> <span><?php echo $phone; ?></span>
            </p>
            <p class="mt-4">
              <strong?>Date of Birth:</strong> <span><?php echo $dob; ?></span>
            </p>

            <h2 class="text-2xl text-green-600 border-b-2 border-green-600 font-bold pb-2 mt-8">Skills</h2>
            <?php
            $skills_array = explode("\r\n", $skills);
            ?>

            <ul id="preview_skills">
              <?php foreach ($skills_array as $skill) : ?>
                <li><?php echo htmlspecialchars($skill); ?>
                <?php endforeach; ?>
            </ul>

            <h2 class="text-2xl text-green-600 font-bold border-b-2 border-green-600 pb-2 mb-4 mt-8">Languages</h2>
            <ul class="list-disc list-inside" id="languages">
              <?php
              $languages_array = explode("\r\n", $language_list);
              foreach ($languages_array as $language) {
                echo "<li class='mt-4'>" . htmlspecialchars($language) . "</li>";
              }
              ?>
            </ul>
          </div>

          <!-- Objective and Experience Section -->
          <div class="col-span-2">
            <h2 class="text-2xl text-green-600 font-bold border-b-2 border-green-600 pb-2 mb-4">Objective</h2>
            <p id="objective" class="text-black"><?php echo $summary; ?></p>

            <h2 class="text-2xl text-green-600 font-bold border-b-2 border-green-600 pb-2 mb-4 mt-8">Experience</h2>
            <div class="mb-6" id="experience1">
              <h3 class="text-xl font-bold" id="prev_jobTitle"><?php echo $job_title1; ?></h3>
              <p class="text-gray-900" id="prev_description"><?php echo $job_description; ?></p>
              <ul class="list-disc list-inside">
                <li id="prev_company_name"><?php echo $company_name; ?></li>
                <li>
                  <span id="prev_job_duration_start"><?php echo $job_duration_start; ?></span>
                  <b>-</b>
                  <span id="prev_job_duration_end"><?php echo $job_duration_end; ?></span>
                </li>
              </ul>
            </div>

            <h2 class="text-2xl text-green-600 font-bold border-b-2 border-green-600 pb-2 mb-4 mt-8">Education</h2>
            <div class="mb-6" id="education1">
              <h3 class="text-xl font-bold" id="education_title"><?php echo $education_name; ?></h3>
              <p class="text-gray-900" id="education_description_text"><?php echo $education_description; ?></p>
            </div>
            <div class="mb-6" id="education2">
              <h3 class="text-xl font-bold" id="education_title2"><?php echo $education_name2; ?></h3>
              <p class="text-gray-900" id="education_description_text2"><?php echo $education_description2; ?></p>
            </div>
            <div class="mb-6" id="education3">
              <h3 class="text-xl font-bold" id="education_title3"><?php echo $education_name3; ?></h3>
              <p class="text-gray-900" id="education_description_text3"><?php echo $education_description3; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>




  <div class="text-center mt-6">
    <button id="downloadButton" class="primary-btn">
      Download as PDF and Return Home
    </button>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
  <script>
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
  </script>
</body>

</html>