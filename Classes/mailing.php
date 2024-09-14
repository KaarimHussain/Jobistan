<?php
include("./Includes/db.php");
include("./Includes/sessionStart.php");
// Using PHP Mailer Library Class for mailing
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Making sure that it get passed down to the function
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

class Mailing
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function generateOTP()
    {
        // Generate OTP of 6 digits
        $otp = rand(100000, 999999);
        return $otp;
    }
    public function sendMailOTP($recovery_email)
    {
        $otp = $this->insertIntoOTPTable($recovery_email);

        if ($otp) {
            try {
                $mail = new PHPMailer(true);
                // Server settings for Gmail
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jobistan.karachi.pk@gmail.com'; // Your Gmail email address
                $mail->Password = 'ddtm bvsm gcyk kmny'; // Your Gmail password or App Password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Sender info
                $mail->setFrom('jobistan.karachi.pk@gmail.com', "JOBISTAN Recovery Team");

                // Recipient
                $mail->addAddress($recovery_email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'OTP Confirmation for Password Reset';
                $mail->Body = '
                <html>
                    <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                                color: #333;
                                line-height: 1.6;
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background-color: #ffffff;
                                border-radius: 10px;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            }
                            .header {
                                text-align: center;
                                padding: 20px;
                                margin-bottom: 20px;
                                background-color: #008ae6;
                                border-radius: 10px;
                            }
                            .header h1 {
                                margin: 0;
                                color: #fff;
                            }
                            .content {
                                padding: 20px;
                            }
                            .content p {
                                margin: 0;
                                padding: 10px 0;
                            }
                            .otp {
                                display: inline-block;
                                padding: 10px 20px;
                                margin: 20px 0;
                                font-size: 1.5em;
                                color: #ffffff;
                                background-color: #008ae6;
                                border-radius: 5px;
                            }
                            .footer {
                                text-align: center;
                                padding-top: 20px;
                                font-size: 0.9em;
                                color: #888;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                                <h1>Jobistan</h1>
                            </div>
                            <div class="content">
                                <p>Dear User,</p>
                                <p>We received a request to reset your password. Please use the following OTP to complete your request:</p>
                                <div class="otp">' . $_SESSION['temp_otp'] . '</div>
                                <p>Please do not share this OTP with anyone. If you did not request a password reset, please ignore this email.</p>
                            </div>
                            <div class="footer">
                                <p>Thank you,<br>Jobistan Recovery Team</p>
                            </div>
                        </div>
                    </body>
                </html>';

                // Send email
                $mail->send();
                return true;
            } catch (Exception $e) {
                $_SESSION['recover_error'] = "Message could not be sent. Mailer";
                return false;
            }
        } else {
            $_SESSION['recovery_error'] = "Failed to generate OTP, please try again.";
            return false;
        }
    }
    public function insertIntoOTPTable($recovery_email)
    {
        include("./Includes/sessionStart.php");
        if ($user_id = $this->getUserIDByEmail($recovery_email)) {
            $otp = $this->generateOTP();
            $sql = "INSERT INTO recoveryEmail (user_id, otp, conformed) VALUES (?, ?, FALSE)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("is", $user_id, $otp);

            if ($stmt->execute()) {
                $_SESSION['temp_otp'] = (string) $otp;  // Ensure OTP is stored as a string
                return true;
            } else {
                return false;
            }
        } else {
            $_SESSION['recover_error'] = "Email is not registered!";
            return false;
        }
    }
    public function updateOTP($otp)
    {
        $sql = "UPDATE recoveryEmail SET conformed = TRUE WHERE otp = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $otp);
        if ($stmt->execute()) {
            return true;
        } else {
            $_SESSION['recover_error'] = "Failed to Update the OTP Conformation";
            return false;
        }
    }
    public function updatePassword($password, $email)
    {
        $hashPass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $hashPass, $email);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserIDByEmail($email)
    {
        $sql = "SELECT * from users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            if ($results->num_rows > 0) {
                $row = $results->fetch_assoc();
                return $row['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function sendMailToAdmin($name = "", $email = "", $subject = "", $message = "")
    {
        $body = "
        <body>
            <div style=\"background-color:royalblue;padding:1rem 2rem;border-radius:2rem;\">
                <h1 style=\"text-align:center;\">Jobistan Contact</h1>
            </div>
            <br>
            <div style=\"background-color:#000;padding:1rem 2rem;border-radius:2rem;\">
                <h4 style=\"text-align:center;color:#fff;font-size:14px;\">Email</h4>
                <h3 style=\"text-align:center;color:#fff;font-size:14px;\">$email</h3>
                <h4 style=\"text-align:center;color:#fff;font-size:14px;\">Name</h4>
                <h3 style=\"text-align:center;color:#fff;font-size:14px;\">$name</h3>
                <h4 style=\"text-align:center;color:#fff;font-size:14px;\">Message</h4>
                <p style=\"text-align:center;color:#fff;font-size:18px;\">$message</p>
            </div>
        </body>
        ";
        try {
            $mail = new PHPMailer(true);
            // Server settings for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jobistan.karachi.pk@gmail.com'; // Your Gmail email address
            $mail->Password = 'ddtm bvsm gcyk kmny'; // Your Gmail password or App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender info
            $mail->setFrom('jobistan.karachi.pk@gmail.com', 'JOBISTAN Contact Team');

            // Webiste email address
            $adminEmail = 'jobistan.karachi.pk@gmail.com';

            // Recipient
            $mail->addAddress($adminEmail);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            $_SESSION['contact_error'] = $e->getMessage();
            return false;
        }
    }
    public function sendMailToSender($name = "", $email = "", $subject = "")
    {
        $body = "
        <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
            }
            .header {
                background-color: #f4f4f4;
                padding: 20px;
                text-align: center;
                border-bottom: 1px solid #ccc;
            }
            .content {
                padding: 20px;
            }
            .footer {
                background-color: #f4f4f4;
                padding: 10px;
                text-align: center;
                border-top: 1px solid #ccc;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                color: white;
                background-color: #28a745;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class=\"header\">
            <h1>Welcome to Jobistan!</h1>
        </div>
        <div class=\"content\">
            <h2>Dear Job Seeker,</h2>
            <p>We are thrilled to bring you the latest updates and opportunities from Jobistan.</p>
            <p>Here are some exciting highlights:</p>
            <ul>
                <li><strong>New Job Postings:</strong> Check out the latest job openings on our platform. <a href=\"#\">Explore now</a>.</li>
                <li><strong>Resume Tips:</strong> Enhance your resume with our expert tips. <a href=\"#\">Read more</a>.</li>
                <li><strong>Success Stories:</strong> Discover how Jobistan has helped professionals land their dream jobs. <a href=\"#\">Read success stories</a>.</li>
            </ul>
            <p>We are committed to helping you find the perfect job. If you have any questions or need assistance, please don't hesitate to contact us.</p>
            <p>Thank you for being a valued member of Jobistan!</p>
            <p>Best regards,<br>The Jobistan Team</p>
            <a href=\"JobistanVision/index.php\" class=\"button\">Visit Jobistan</a>
        </div>
        <div class=\"footer\"
            <p>&copy; 2024 Jobistan. All rights reserved.</p>
            <p><a href=\"#\">Privacy Policy</a></p>
        </div>
    </body>
    </html>
        ";
        try {
            $mail = new PHPMailer(true);
            // Server settings for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jobistan.karachi.pk@gmail.com'; // Your Gmail email address
            $mail->Password = 'ddtm bvsm gcyk kmny'; // Your Gmail password or App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender info
            $mail->setFrom('jobistan.karachi.pk@gmail.com', 'JOBISTAN Contact Team');

            // Recipient
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            $_SESSION['contact_error'] = "Message could not be sent from Sender. Mailer";
            return false;
        }
    }
    public function sendMailToSenderForApproval($name = "", $email = "", $subject = "")
    {
        $body = "
        <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
            }
            .header {
                background-color: #f4f4f4;
                padding: 20px;
                text-align: center;
                border-bottom: 1px solid #ccc;
            }
            .content {
                padding: 20px;
            }
            .footer {
                background-color: #f4f4f4;
                padding: 10px;
                text-align: center;
                border-top: 1px solid #ccc;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                color: white;
                background-color: #28a745;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class=\"header\">
            <h1>$subject</h1>
        </div>
        <div class=\"content\">
            <h2>Dear Recruiters,</h2>
            <p>Thanks for Registering on Jobistan</p>
            <p>Your Account has been approved by our Admin! Please try loggin in now</p>
            <ul>
                <li><strong>New Job Postings:</strong> Check out the latest job openings on our platform. <a href=\"#\">Explore now</a>.</li>
                <li><strong>Resume Tips:</strong> Enhance your resume with our expert tips. <a href=\"#\">Read more</a>.</li>
                <li><strong>Success Stories:</strong> Discover how Jobistan has helped professionals land their dream jobs. <a href=\"#\">Read success stories</a>.</li>
            </ul>
            <p>We are committed to helping you find the perfect job. If you have any questions or need assistance, please don't hesitate to contact us.</p>
            <p>Thank you for being a valued member of Jobistan!</p>
            <p>Best regards,<br>The Jobistan Team</p>
            <a href=\"localhost/JobistanVision/index.php\" target=\"_blank\" class=\"button\">Visit Jobistan</a>
        </div>
        <div class=\"footer\">
            <p>&copy; 2024 Jobistan. All rights reserved.</p>
            <p><a href=\"localhost/JobistanVision/privacyPolicy.php\">Privacy Policy</a></p>
        </div>
    </body>
    </html>
        ";
        try {
            $mail = new PHPMailer(true);
            // Server settings for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jobistan.karachi.pk@gmail.com'; // Your Gmail email address
            $mail->Password = 'ddtm bvsm gcyk kmny'; // Your Gmail password or App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            // Sender info
            $mail->setFrom('jobistan.karachi.pk@gmail.com', 'JOBISTAN Contact Team');
            // Recipient
            $mail->addAddress($email);
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = 'Dear Recruiters, Thanks for Registering on Jobistan. Your Account has been approved by our admin... Please try checking now!';
            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    public function sendMailToSenderForRequestApprove($companyName, $email, $subject)
    {

    }
    public function matchOTP($tempOTP, $recover_OTP)
    {
        if ($tempOTP == $recover_OTP) {
            $this->updateOTP($tempOTP);
            unset($_SESSION['temp_otp']);
            return true;
        } else {
            return false;
        }
    }
    public function sendMailToSenderForRequestReject($name = "", $email = "", $subject = "")
    {
        $body = "
        <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
            }
            .header {
                background-color: #f4f4f4;
                padding: 20px;
                text-align: center;
                border-bottom: 1px solid #ccc;
            }
            .content {
                padding: 20px;
            }
            .footer {
                background-color: #f4f4f4;
                padding: 10px;
                text-align: center;
                border-top: 1px solid #ccc;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                color: white;
                background-color: #28a745;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class=\"header\">
            <h1>$subject</h1>
        </div>
        <div class=\"content\">
            <h2>Dear Recruiters,</h2>
            <p>Account Rejected</p>
            <p>Your account has been rejected by Jobistan.pk</p>
            <small>Reasons -></small>
            <ul>
                <li>Your Company Name or Email is not Verified</li>
                <li>Your Provided Company is Fake or Unregistered</li>
                <li>The provided information is Incomplete</li>
                <li>Scam or Fraudulent Activities</li>
            </ul>
            <p>Thank you for registering your Company in Jobistan.pk</p>
            <p>Best regards,<br>The Jobistan Team</p>
            <a href=\"localhost/JobistanVision/index.php\" target=\"_blank\" class=\"button\">Visit Jobistan</a>
        </div>
        <div class=\"footer\">
            <p>&copy; 2024 Jobistan. All rights reserved.</p>
            <p><a href=\"localhost/JobistanVision/privacyPolicy.php\">Privacy Policy</a></p>
        </div>
    </body>
    </html>
        ";
        try {
            $mail = new PHPMailer(true);
            // Server settings for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jobistan.karachi.pk@gmail.com'; // Your Gmail email address
            $mail->Password = 'ddtm bvsm gcyk kmny'; // Your Gmail password or App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender info
            $mail->setFrom('jobistan.karachi.pk@gmail.com', 'JOBISTAN Contact Team');

            // Recipient
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    public function sendMailToSenderForInterviewSchedule(
        $username,
        $email = "",
        $recruiter_email,
        $recruiter_company_name,
        $job_title,
        $job_description,
        $interview_date,
        $interview_time
    ) {
        $body = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                }
                .header {
                    background-color: #f4f4f4;
                    padding: 20px;
                    text-align: center;
                    border-bottom: 1px solid #ccc;
                }
                .content {
                    padding: 20px;
                }
                .footer {
                    background-color: #f4f4f4;
                    padding: 10px;
                    text-align: center;
                    border-top: 1px solid #ccc;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    color: white;
                    background-color: #28a745;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .list {
                    margin-top: 10px;
                }
                .list li {
                    margin-bottom: 5px;
                }
            </style>
        </head>
        <body>
            <div class=\"header\">
                <h1>Jobistan.pk</h1>
            </div>
            <div class=\"content\">
                <h2>Dear $username,</h2>
                <p>We are pleased to inform you that you have been selected for an interview for the position of <strong>$job_title</strong> at <strong>$recruiter_company_name</strong>.</p>
                <p><strong>Job Description:</strong></p>
                <p>$job_description</p>
                <p><strong>Interview Details:</strong></p>
                <ul class=\"list\">
                    <li><strong>Interview Date:</strong> $interview_date</li>
                    <li><strong>Interview Time:</strong> $interview_time</li>
                    <li><strong>Recruiter Email:</strong> $recruiter_email</li>
                    <li><strong>Company:</strong> $recruiter_company_name</li>
                    <li><strong>Position:</strong> $job_title</li>
                </ul>
                <p>If you have any questions or need further information, please feel free to contact us at <a href=\"mailto:$recruiter_email\">$recruiter_email</a>.</p>
                <p>We look forward to meeting you!</p>
                <p>Best regards,<br>The Jobistan Team</p>
            </div>
            <div class=\"footer\">
                <p>&copy; 2024 Jobistan. All rights reserved.</p>
                <p><a href=\"localhost/JobistanVision/privacyPolicy.php\">Privacy Policy</a></p>
            </div>
        </body>
        </html>
        ";

        try {
            $mail = new PHPMailer(true);
            // Server settings for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jobistan.karachi.pk@gmail.com'; // Your Gmail email address
            $mail->Password = 'ddtm bvsm gcyk kmny'; // Your Gmail password or App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender info
            $mail->setFrom('jobistan.karachi.pk@gmail.com', 'Jobistan Contact Team');

            // Recipient
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Interview Scheduled for " . strtoupper($job_title) . " Position";
            $mail->Body = $body;

            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            $_SESSION['contact_error'] = "Message could not be sent. Mailer Error: " . $e->getMessage();
            return false;
        }
    }
}
