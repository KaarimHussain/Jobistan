<?php
include ('./Includes/sessionStart.php');
if (isset($_SESSION['logged'])) {
    header("Location: home.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ('./Includes/db.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == "jobistan.aku@gmail.com" && $password == "JetEngine") {
        $_SESSION['adminLogged'] = array(
            'email' => $email,
            'role' => 'admin'
        );
        header("Location: adminPanel.php");
        exit();
    }
    // Bind parameters
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Fetch result
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                if ($row['role'] == "recruiter") {
                    $stmt = $conn->prepare("SELECT * FROM employer_profiles WHERE actions = 'approved' AND user_id = ?");
                    $stmt->bind_param("i", $row['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $_SESSION['logged'] = array(
                            'id' => $row['id'],
                            'username' => $row['username'],
                            'email' => $email,
                            'role' => $row['role']
                        );
                        header("Location: companyHome.php");
                        exit();
                    } else {
                        $_SESSION['register_error'] = "Your account is not approved yet. Please contact your admin";
                        header("Location: loginthroughPassword.php");
                        exit();
                    }
                } else if ($row['role'] == 'worker') {
                    $_SESSION['logged'] = array(
                        'id' => $row['id'],
                        'username' => $row['username'],
                        'email' => $email,
                        'role' => $row['role']
                    );
                    header("Location: home.php");
                    exit();
                } else {
                    $_SESSION['register_error'] = "Cannot fetch the role of the provided email";
                    header("Location: loginthroughPassword.php");
                    exit();
                }
            } else {
                $_SESSION['register_error'] = "Invalid email or password. Please try again!";
                header("Location: loginthroughPassword.php");
                exit();
            }
        } else {
            $_SESSION['register_error'] = "Invalid email or password.";
            header("Location: loginthroughPassword.php");
            exit();
        }
    } else {
        $_SESSION['register_error'] = "Couldn't execute the query";
        header("Location: loginthroughPassword.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
