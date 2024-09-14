<?php
include("./Includes/db.php");
include("./Classes/adminData.php");
$adminData = new AdminData($conn);
$UompanyData = $adminData->getTotalCompany();
$JobData = $adminData->getTotalJobs();
$UserData = $adminData->getTotalUsers();
header("Content-Type: application/json");

$data = [
    "company" => $UompanyData,
    "jobs" => $JobData,
    "users" => $UserData
];

echo json_encode($data);
