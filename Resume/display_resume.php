<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resume_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$full_name = urldecode($_GET['full_name']);

$sql = "SELECT * FROM resumes WHERE full_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $full_name);
$stmt->execute();
$result = $stmt->get_result();
$resume = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume for <?php echo htmlspecialchars($resume['full_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full w-3/4 p-4 bg-white shadow-md rounded-lg">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-10 p-6">
            <!-- Header -->
            <header class="flex flex-col items-center border-b-2 pb-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-900"><?php echo htmlspecialchars($resume['full_name']); ?></h1>
                <p class="text-xl text-gray-600"><?php echo htmlspecialchars($resume['job_title']); ?></p>
                <div class="mt-2 text-gray-600"><?php echo htmlspecialchars($resume['email']) . " | " . htmlspecialchars($resume['phone']) . " | " . htmlspecialchars($resume['linkedin']); ?></div>
            </header>

            <!-- Summary -->
            <section class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Summary</h2>
                <p><?php echo nl2br(htmlspecialchars($resume['summary'])); ?></p>
            </section>

            <!-- Experience -->
            <section class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Experience</h2>
                <p><?php echo nl2br(htmlspecialchars($resume['experience'])); ?></p>
            </section>

            <!-- Education -->
            <section class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Education</h2>
                <p><?php echo nl2br(htmlspecialchars($resume['education'])); ?></p>
            </section>

            <!-- Skills -->
            <section>
                <h2 class="text-2xl font-semibold text-gray-900 border-b-2 pb-2 mb-4">Skills</h2>
                <p><?php echo nl2br(htmlspecialchars($resume['skills'])); ?></p>
            </section>
        </div>
    </div>
</body>
</html>
