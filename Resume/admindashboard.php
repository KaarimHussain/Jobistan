<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.3);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .dark-blur-bg {
            background: url('https://images7.alphacoders.com/135/thumb-1920-1351186.png') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(5px);
        }
        .card-div {
            padding: 5rem;
        }
        .count-badge {
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 2rem;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-weight: bold;
        }
    </style>
</head>

<body class="dark-blur-bg bg-gray-900 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-12 card-div">
        <h1 class="text-3xl font-bold mb-8 text-center text-white">Admin Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Users</h2>
                <p class="text-white">View and manage users.</p>
                <a href="adminmanage_users.php" class="text-blue-500 hover:underline">Go to Manage Users</a>
                <span id="count-users" class="count-badge">0</span>
            </div>
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Jobs</h2>
                <p class="text-white">View and manage job listings.</p>
                <a href="adminmanage_jobs.php" class="text-blue-500 hover:underline">Go to Manage Jobs</a>
                <span id="count-job_listings" class="count-badge">0</span>
            </div>
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Applications</h2>
                <p class="text-white">View and manage job applications.</p>
                <a href="adminmanage_applications.php" class="text-blue-500 hover:underline">Go to Manage Applications</a>
                <span id="count-applications" class="count-badge">0</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-5">
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Analytics</h2>
                <p class="text-white">View and manage analytics.</p>
                <a href="adminmanage_analytics.php" class="text-blue-500 hover:underline">Go to Manage Analytics</a>
                <span id="count-analytics" class="count-badge">0</span>
            </div>
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Templates</h2>
                <p class="text-white">View and manage templates.</p>
                <a href="adminmanage_templates.php" class="text-blue-500 hover:underline">Go to Manage Templates</a>
                <span id="count-resume_templates" class="count-badge">0</span>
            </div>
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Interviews</h2>
                <p class="text-white">View and manage interviews.</p>
                <a href="adminmanage_interviews.php" class="text-blue-500 hover:underline">Go to Manage Interviews</a>
                <span id="count-interview_schedules" class="count-badge">0</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-5">
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Alerts</h2>
                <p class="text-white">View and manage alerts.</p>
                <a href="adminmanage_alerts.php" class="text-blue-500 hover:underline">Go to Manage Alerts</a>
                <span id="count-job_alerts" class="count-badge">0</span>
            </div>
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Feedback</h2>
                <p class="text-white">View and manage feedback.</p>
                <a href="adminmanage_feedback.php" class="text-blue-500 hover:underline">Go to Manage Feedback</a>
                <span id="count-feedback" class="count-badge">0</span>
            </div>
            <div class="glass-effect p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-white">Manage Messages</h2>
                <p class="text-white">View and manage messages.</p>
                <a href="adminmanage_messages.php" class="text-blue-500 hover:underline">Go to Manage Messages</a>
                <span id="count-messages" class="count-badge">0</span>
            </div>
        </div>
    </div>

    <script>
        fetch('EntityCounts.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('count-users').innerText = data.users;
                document.getElementById('count-job_listings').innerText = data.job_listings;
                document.getElementById('count-applications').innerText = data.applications;
                document.getElementById('count-analytics').innerText = data.analytics;
                document.getElementById('count-resume_templates').innerText = data.resume_templates;
                document.getElementById('count-interview_schedules').innerText = data.interview_schedules;
                document.getElementById('count-job_alerts').innerText = data.job_alerts;
                document.getElementById('count-feedback').innerText = data.feedback;
                document.getElementById('count-messages').innerText = data.messages;
            });
    </script>
</body>

</html>
