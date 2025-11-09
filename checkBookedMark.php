<?php
include('./Includes/sessionStart.php');
header('Content-Type: application/');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("./Includes/db.php");
    
} else {
    header('Location: home.php');
    exit();
}