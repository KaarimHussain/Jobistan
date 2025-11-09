<?php
include('../../Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location:../../index.php");
    exit();
}
$full_name = isset($_GET['full_name']) ? htmlspecialchars($_GET['full_name']) : '';
$job_title = isset($_GET['job_title']) ? htmlspecialchars($_GET['job_title']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$phone = isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : '';
$linkedin = isset($_GET['linkedin']) ? htmlspecialchars($_GET['linkedin']) : '';
$summary = isset($_GET['summary']) ? htmlspecialchars($_GET['summary']) : '';
$education = isset($_GET['education']) ? htmlspecialchars($_GET['education']) : '';
$skills = isset($_GET['skills']) ? htmlspecialchars($_GET['skills']) : '';
$experience = isset($_GET['experience']) ? htmlspecialchars($_GET['experience']) : '';

$experience_lines = explode("\n", $experience);
$job_titles = [];
$job_descriptions = [];

foreach ($experience_lines as $line) {
    $parts = explode(" at ", $line);
    if (count($parts) == 2) {
        $job_title_and_company = $parts[0];
        $company_and_duration = $parts[1];
        $job_title_and_duration = explode(" (", $job_title_and_company);
        $job_title = $job_title_and_duration[0];
        $company_and_duration = explode("): ", $company_and_duration);
        $company_name = $company_and_duration[0];
        $job_description = isset($company_and_duration[1]) ? $company_and_duration[1] : '';

        $job_titles[] = $job_title;
        $job_descriptions[] = [$company_name, $job_description];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get your Resume - Jobistan</title>
    <?php
    include('../../Includes/bootstrapCss.php');
    include('../../Includes/tailwindCss.php');
    ?>
    <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased leading-relaxed">
    <main class="full-h py-10">
        <div id="resume" class="max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-10 p-6">
            <!-- Header -->
            <header class="flex flex-col items-center border-b-2 pb-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-900"><?php echo $full_name; ?></h1>
                <p class="text-xl text-gray-600"><?php echo $job_title; ?></p>
                <div class="mt-2 text-gray-600">
                    <p><?php echo $email; ?> | <?php echo $phone; ?> | <?php echo $linkedin; ?></p>
                </div>
            </header>

            <!-- Summary -->
            <section class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Summary</h2>
                <p><?php echo nl2br($summary); ?></p>
            </section>

            <!-- Experience -->
            <section class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Experience</h2>
                <?php foreach ($job_titles as $index => $title) {
                    ?>
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-800"><?php echo $title; ?></h3>
                        <p class="text-gray-700"><?php echo $job_descriptions[$index][0]; ?></p><br>
                        <p class="text-gray-700"><?php echo $job_descriptions[$index][1]; ?></p>
                    </div>
                    <?php
                } ?>
            </section>

            <!-- Education -->
            <section class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Education</h2>
                <div class="mb-4">
                    <p><?php echo nl2br($education); ?></p>
                </div>
            </section>

            <!-- Skills -->
            <section>
                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Skills</h2>
                <ul class="list-disc list-inside text-gray-700">
                    <?php
                    $skills_list = explode("\n", $skills);
                    foreach ($skills_list as $skill) {
                        echo "<li>" . htmlspecialchars($skill) . "</li>";
                    }
                    ?>
                </ul>
            </section>
        </div>

        <div class="d-flex justify-center mt-6 d-flex gap-3">
            <button id="downloadButton" class="primary-btn">
                Download as PDF and Return Home
            </button>
        </div>
        <!-- Modal -->
    </main>
    <?php
    include('../../Includes/bootstrapJs.php');
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("Called");
            document.getElementById('downloadButton').addEventListener('click', function () {
                var element = document.getElementById('resume');
                html2pdf().from(element).output('blob').then(function (blob) {
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

                    fetch('saveUserPDFinDB.php', {
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