<?php
// In this file it will start the session but before starting it will check if the current session is on working
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
