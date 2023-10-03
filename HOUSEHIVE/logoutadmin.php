<?php
// Start the session
session_start();

// Destroy the session to log out the admin
session_destroy();

// Redirect to the login page or any other page you prefer
header("Location: admin.php"); // Replace 'login.php' with the appropriate URL
exit();
?>