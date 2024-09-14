<?php
include('./Includes/sessionStart.php');
if (!isset($_SESSION['adminLogged'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./Includes/db.php');
    include('./Classes/mailing.php');
    $mail = new Mailing($conn);
    if (isset($_POST['approve_request_btn'])) {
        $user_id = $_POST['user_id'];
        $email = $_POST['email'];
        $action = "approved";
        $SQL = "UPDATE employer_profiles SET actions = ? WHERE user_id = ?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("si", $action, $user_id);
        if ($stmt->execute() && $mail->sendMailToSenderForApproval('JOBISTAN', $email, 'Jobistan Approval Team')) {
            $stmt->close();
            $_SESSION['admin_success'] = "Successfully Approve the Pending Recruiter";
            header("Location: adminViewPendings.php");
            exit();
        } else {
            $stmt->close();
            // $_SESSION['admin_error'] = "Failed to Accept the Pending Recruiter";
            header("Location: adminViewPendings.php");
            exit();
        }
    } else if (isset($_POST['reject_request_btn'])) {
        $user_id = $_POST['user_id'];
        $email = $_POST['email'];
        $action = "rejected";
        $SQL = "UPDATE employer_profiles SET actions = ? WHERE user_id = ?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("si", $action, $user_id);
        if ($stmt->execute() && $mail->sendMailToSenderForRequestReject('JOBISTAN', $email, 'Jobistan Approval Team')) {
            $stmt->close();
            $_SESSION['admin_success'] = "Successfully Reject the Pending Recruiter.";
            header("Location: adminViewPendings.php");
            exit();
        } else {
            $stmt->close();
            // $_SESSION['admin_error'] = "Failed to Reject the Pending Recruiter";
            header("Location: adminViewPendings.php");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
