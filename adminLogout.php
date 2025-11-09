<?php
include('./Includes/sessionStart.php');
unset($_SESSION['adminLogged']);
session_destroy();
header("Location: index.php");
exit();
