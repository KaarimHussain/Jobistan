<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $valid_email = "123@gmail.com";
    $valid_password = "password123";

    if ($email === $valid_email && $password === $valid_password) {

        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;

        header("Location: dashboard.php");
        exit;
    } else {
        $error_message = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #008ae6;
        }

        body {
            background-color: #ffffff;
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        body::before{
            content: '';
            position: absolute;
            width: 350px;
            height: 285px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary-color), transparent);
            filter: blur(60px); 
            z-index: -1;
        }

        body::after {
            content: '';
            position: absolute;
            width: 191px;
            height: 161px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary-color), transparent);
            filter: blur(60px); 
            z-index: -1;
        }

        body::before {
            top: 20px;
            left: 20px;
        }

        body::after {
            bottom: 20px;
            right: 20px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 100%; 
            max-width: 400px; 
            padding: 20px;
        }

        .bg-gray-700:hover {
            background-color: #374151;
            color: #ffffff; 
        }
    </style>
</head>

<body>
    <div class="bg-gray-800 rounded-xxl shadow-lg p-8 glass-effect">
        <h2 class="text-4xl font-bold mb-4 text-center">Login</h2>
        <?php
        if (!empty($error_message)) {
            echo "<div class='text-red-500 text-center mb-4'>$error_message</div>";
        }
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email address</label>
                <input type="email" id="email" name="email" required class="shadow appearance-none border rounded-full w-full py-3 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline glass-effect"
                    placeholder="Email address">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" required class="shadow appearance-none border rounded-full w-full py-3 px-3 text-white-700 leading-tight focus:outline-none focus:shadow-outline glass-effect"
                    placeholder="Password">
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white w-full font-bold py-3 px-4 rounded-full focus:outline-none focus:shadow-outline">Log
                    in</button>
            </div>
            <div class="text-sm mb-4">
                <a href="#" class="text-blue-500 hover:text-blue-700">Forgot your password?</a>
            </div>
           
            <div class="text-center">
                <span class="text-gray-400">Don't have an account yet? </span><a href="#" class="text-blue-500 hover:text-blue-700">Register</a>
            </div>
        </form>
    </div>
</body>

</html>
