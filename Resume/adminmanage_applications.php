<?php
// session_start();
// if (!isset($_SESSION['admin'])) {
//     header('Location: login.php');
//     exit;
// }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$applications_query = "
    SELECT applications.id, users.username, applications.job_listing_id, applications.status
    FROM applications
    INNER JOIN users ON applications.job_seeker_id = users.id
";
$applications_result = mysqli_query($conn, $applications_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Applications</title>
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
        <h1 class="text-3xl font-bold mb-8 text-center text-white">Manage Applications</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full rounded-lg overflow-hidden shadow-lg">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-blue-500 text-white font-bold">ID</th>
                        <th class="py-3 px-4 bg-blue-500 text-white font-bold">Job Seeker</th>
                        <th class="py-3 px-4 bg-blue-500 text-white font-bold">Job Listing ID</th>
                        <th class="py-3 px-4 bg-blue-500 text-white font-bold">Status</th>
                        <th class="py-3 px-4 bg-blue-500 text-white font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($application = mysqli_fetch_assoc($applications_result)) { ?>
                        <tr class="hover:bg-gray-100 group">
                            <td class="py-3 px-4 border-b text-white border-gray-200 text-center glass-effect group-hover:text-black"><?php echo $application['id']; ?></td>
                            <td class="py-3 px-4 border-b text-white border-gray-200 text-center glass-effect group-hover:text-black"><?php echo $application['username']; ?></td>
                            <td class="py-3 px-4 border-b text-white border-gray-200 text-center glass-effect group-hover:text-black"><?php echo $application['job_listing_id']; ?></td>
                            <td class="py-3 px-4 border-b text-white border-gray-200 text-center glass-effect group-hover:text-black"><?php echo $application['status']; ?></td>
                            <td class="py-3 px-4 border-b text-white border-gray-200 text-center glass-effect group-hover:text-black">
                                <a href="edit_application.php?id=<?php echo $application['id']; ?>" class="text-blue-500 hover:underline">Edit</a>
                                <a href="delete_application.php?id=<?php echo $application['id']; ?>" class="ml-2 text-red-500 hover:underline">Delete</a>
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
