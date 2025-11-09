<?php
include('../../Includes/sessionStart.php');
if (!isset($_SESSION['logged'])) {
    header("Location: ../../index.php");
    exit();
}
// Extract and sanitize each parameter from $_GET

$full_name = isset($_GET['full_name']) ? htmlspecialchars($_GET['full_name']) : '';
$job_title = isset($_GET['job_title']) ? htmlspecialchars($_GET['job_title']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$phone = isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : '';
$address = isset($_GET['address']) ? htmlspecialchars($_GET['address']) : '';
$expertise = isset($_GET['expertise']) ? htmlspecialchars($_GET['expertise']) : '';
$languages = isset($_GET['languages']) ? htmlspecialchars($_GET['languages']) : '';
$hobbies = isset($_GET['hobbies']) ? htmlspecialchars($_GET['hobbies']) : '';
$about_me = isset($_GET['about_me']) ? htmlspecialchars($_GET['about_me']) : '';

$job_title_1 = isset($_GET['job_title_1']) ? htmlspecialchars($_GET['job_title_1']) : '';
$company_name_1 = isset($_GET['company_name_1']) ? htmlspecialchars($_GET['company_name_1']) : '';
$joblocation1 = isset($_GET['joblocation1']) ? htmlspecialchars($_GET['joblocation1']) : '';
$job_duration_start1 = isset($_GET['job_duration_start1']) ? htmlspecialchars($_GET['job_duration_start1']) : '';
$job_duration_end1 = isset($_GET['job_duration_end1']) ? htmlspecialchars($_GET['job_duration_end1']) : '';
$job_description_1 = isset($_GET['job_description_1']) ? htmlspecialchars($_GET['job_description_1']) : '';

$job_title_2 = isset($_GET['job_title_2']) ? htmlspecialchars($_GET['job_title_2']) : '';
$company_name_2 = isset($_GET['company_name_2']) ? htmlspecialchars($_GET['company_name_2']) : '';
$joblocation2 = isset($_GET['joblocation2']) ? htmlspecialchars($_GET['joblocation2']) : '';
$job_duration_start2 = isset($_GET['job_duration_start2']) ? htmlspecialchars($_GET['job_duration_start2']) : '';
$job_duration_end2 = isset($_GET['job_duration_end2']) ? htmlspecialchars($_GET['job_duration_end2']) : '';
$job_description_2 = isset($_GET['job_description_2']) ? htmlspecialchars($_GET['job_description_2']) : '';

$Education_name1 = isset($_GET['Education_name1']) ? htmlspecialchars($_GET['Education_name1']) : '';
$Education_passoutdate1 = isset($_GET['Education_passoutdate1']) ? htmlspecialchars($_GET['Education_passoutdate1']) : '';
$Education_discription1 = isset($_GET['Education_discription1']) ? htmlspecialchars($_GET['Education_discription1']) : '';

$Education_name2 = isset($_GET['Education_name2']) ? htmlspecialchars($_GET['Education_name2']) : '';
$Education_passoutdate2 = isset($_GET['Education_passoutdate2']) ? htmlspecialchars($_GET['Education_passoutdate2']) : '';
$Education_discription2 = isset($_GET['Education_discription2']) ? htmlspecialchars($_GET['Education_discription2']) : '';

$r_name = isset($_GET['r_name']) ? htmlspecialchars($_GET['r_name']) : '';
$job_position_1 = isset($_GET['job_position_1']) ? htmlspecialchars($_GET['job_position_1']) : '';
$r_company_name_1 = isset($_GET['r_company_name_1']) ? htmlspecialchars($_GET['r_company_name_1']) : '';
$job_phone_1 = isset($_GET['job_phone_1']) ? htmlspecialchars($_GET['job_phone_1']) : '';
$job_email_1 = isset($_GET['job_email_1']) ? htmlspecialchars($_GET['job_email_1']) : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download your Resume now</title>
    <?php
    include('../../Includes/bootstrapCss.php');
    include('../../Includes/tailwindCss.php');
    include('../../Includes/Icons.php');
    ?>
    <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="max-w-3xl mx-auto bg-white rounded-lg mt-10 p-6">
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Resume</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
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

        <div class="bg-white shadow-lg t1" style=" margin: auto;width: 900px;">
            <div class="flex" id="resume003">
                <!-- Left Section -->
                <div class="w-1/3 ls bg-blue-900 text-white">
                    <div class="text-center">
                        <h2 id="preview_full_name" class="text-2xl font-bold mb-2"><?php echo "$full_name" ?></h2>
                        <p id="preview_job_title" class="text-lg"><?php echo "$job_title" ?></p>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold">Contact</h3>
                        <hr class="mt-1 bold-hr">
                        <p id="preview_phone" class="mt-4"><?php echo "$phone" ?></p>
                        <p id="preview_email" class="mt-4"><?php echo "$email" ?></p>
                        <p id="preview_address" class="mt-4"><?php echo "$address" ?></p>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold">Expertise</h3>
                        <hr class="mt-1 bold-hr">
                        <ul id="preview_expertise" class="mt-4 list-disc list-inside">
                            <?php
                            $Langs_array = explode("\r\n", $expertise);
                            ?>
                            <ul id="preview_skills">
                                <?php foreach ($Langs_array as $expertise) : ?>
                                    <li><?php echo htmlspecialchars($expertise); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </ul>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold">Language</h3>
                        <hr class="mt-1 bold-hr">
                        <ul id="preview_languages" class="mt-4 list-disc list-inside">
                            <?php
                            $Langs_array = explode("\r\n", $languages);
                            ?>
                            <ul id="preview_skills">
                                <?php foreach ($Langs_array as $$languages) : ?>
                                    <li><?php echo htmlspecialchars($$languages); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </ul>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold">Hobbies</h3>
                        <hr class="mt-1 bold-hr">
                        <ul id="preview_hobbies" class="mt-4 list-disc list-inside">
                            <?php
                            $Langs_array = explode("\r\n", $hobbies);
                            ?>

                            <ul id="preview_skills">
                                <?php foreach ($Langs_array as $$hobbies) : ?>
                                    <li><?php echo htmlspecialchars($$hobbies); ?></li>
                                <?php endforeach; ?>
                            </ul>

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
                        <p id="preview_about_me" class="mt-4"><?php echo "$about_me" ?></p>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold">Experience:1</h3>
                        <hr class="mt-1 bold-hr1">
                        <div class="mt-4">
                            <div id="preview_jobtitle1" class="text-lg font-semibold" class="mt-4"><?php echo "$job_title_1" ?></div>
                            <div>
                                <p id="preview_companyname1"><?php echo "$company_name_1" ?></p><span id="preveiw_joblocation1"> <?php echo "$joblocation1" ?></span>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <p id="preview_duration_start1" style="margin-right: 10px;"><?php echo "$job_duration_start1" ?></p>
                                <p>-</p>
                                <p style="margin-left: 10px;" id="preview_duration_end1"><?php echo "$job_duration_end1" ?></p>
                            </div>
                            <p class="mt-2 text-gray-600" id="preview_jobdiscription1"><?php echo "$job_description_1" ?></p>
                            <!-- Experience2 -->
                            <h3 class="text-2xl font-semibold">Experience:2</h3>
                            <hr class="mt-1 bold-hr1">

                            <div class="mt-4">
                                <div id="preview_jobtitle2" class="text-lg font-semibold"><?php echo "$job_title_2" ?></div>
                                <div>
                                    <p id="preview_companyname2"><?php echo "$company_name_2" ?> </p><span id="preveiw_joblocation2"><?php echo "$joblocation2" ?></span>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <p id="pduration_start2" style="margin-right: 10px;"><?php echo "$job_duration_start2" ?></p>
                                    <p>-</p>
                                    <p style="margin-left: 10px;" id="pduration_end2"><?php echo "$job_duration_end2" ?></p>
                                </div>
                                <p class="mt-2 text-gray-600" id="preview_jobdiscription2"><?php echo "$job_description_2" ?></p>
                            </div>

                            <!-- //Education section -->
                            <div class="mt-8">
                                <h3 class="text-xl font-semibold">Education</h3>
                                <p class="mt-4" id="Digree_name1"><?php echo "$Education_name1" ?></p>
                                <hr class="mt-1 bold-hr1">
                                <p id="digree1_passout_date1"><?php echo "$Education_passoutdate1" ?></p>
                                <p id="preview_education_discription1" class="mt-4"><?php echo "$Education_discription1" ?></p>
                                <!-- second education -->
                                <p class="mt-4" id="Digree_name2"><?php echo "$Education_name2" ?></p>
                                <hr class="mt-1 bold-hr1">
                                <p id="digree2_passout_date2"><?php echo "$Education_passoutdate2" ?></p>
                                <p id="preview_education_discription2" class="mt-4"><?php echo "$Education_discription2" ?></p>
                            </div>
                            <div class="mt-8">
                                <h3 class="text-2xl font-semibold">Reference</h3>
                                <hr class="mt-1 bold-hr1">
                                <div class="flex mt-4">
                                    <div class="w-1/2">
                                        <p id="preview_Reference_name" class="text-lg font-semibold"><?php echo "$r_name" ?></p>
                                        <p id="preview_Reference_job_position_1" class="text-lg font-semibold"><?php echo "$job_position_1" ?></p>
                                        <p id="preview_Reference_company" class="text-lg font-semibold"><?php echo "$r_company_name_1" ?></p>
                                        <p id="preview_Reference-phone_1" class="mt-2"><?php echo "$job_phone_1" ?></p>
                                        <p id="preview_Reference_email_1" class="mt-2"><?php echo "$job_email_1" ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <div class="d-flex justify-center my-6 d-flex gap-3">
        <button id="downloadButton" class="primary-btn">
            Download as PDF and Return Home
        </button>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("Called");
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