<?php
// Initialize the session
session_start();

// Unset only the admin-specific session variables
unset($_SESSION["admin_loggedin"]);
unset($_SESSION["admin_username"]);

// Check if any session variables remain, if not, destroy the session
if (empty($_SESSION)) {
    session_destroy();
}

// Redirect to admin login page
header("location: ./login.php");
exit;
?>
