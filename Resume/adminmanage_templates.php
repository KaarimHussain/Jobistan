<?php
// session_start();
// if (!isset($_SESSION['admin'])) {
//     header('Location: login.php');
//     exit;
// }

// include '../config.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$templates_query = "SELECT * FROM resume_templates";
$templates_result = mysqli_query($conn, $templates_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Resume Templates</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .ent-div {
            padding: 5rem;
        }

        .dark-blur-bg {
            background: url('https://images7.alphacoders.com/135/thumb-1920-1351186.png') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(5px);
        }
    </style>
</head>

<body class="dark-blur-bg bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-12 ent-div">
        <h1 class="text-3xl font-bold mb-8 text-center text-white">Manage Resume Templates</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full rounded-lg overflow-hidden shadow-lg">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-blue-500 text-white font-semibold text-center">ID</th>
                        <th class="py-3 px-4 bg-blue-500 text-white font-semibold text-center">Template Name</th>
                        <th class="py-3 px-4 bg-blue-500 text-white font-semibold text-center">Template Path</th>
                        <th class="py-3 px-4 bg-blue-500 text-white font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($template = mysqli_fetch_assoc($templates_result)) { ?>
                        <tr class="hover:bg-gray-100 group">
                            <td class="py-3 px-4 border-b border-gray-200 text-center text-white glass-effect group-hover:text-black"><?php echo $template['id']; ?></td>
                            <td class="py-3 px-4 border-b border-gray-200 text-center text-white glass-effect group-hover:text-black"><?php echo $template['template_name']; ?></td>
                            <td class="py-3 px-4 border-b border-gray-200 text-center text-white glass-effect group-hover:text-black"><?php echo $template['template_path']; ?></td>
                            <td class="py-3 px-4 border-b border-gray-200 text-center text-white glass-effect group-hover:text-black">
                                <a href="delete_template.php?id=<?php echo $template['id']; ?>" class="text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mt-4">
            <a href="admindashboard.php" class="bg-gray-700 hover:bg-gray-600 text-white py-3 px-5 rounded-lg shadow-md transition duration-300 ease-in-out">Go Back</a>
        </div>
    </div>
</body>

</html>