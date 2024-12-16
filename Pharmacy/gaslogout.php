<?php
session_start(); // Start the session

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: /OUTPATIENT/index.php"); // Change 'login.php' to your actual login page URL
exit();
?>
