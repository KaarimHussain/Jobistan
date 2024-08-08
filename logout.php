<?php
// In this file every single session will be destroyed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Unsetting all the sessions && Destroy all sessions adn then redirecting back to index.php
unset($_SESSION['logged']);
session_destroy();
header("Location: ./index.php");
exit();