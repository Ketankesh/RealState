<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['userid'])) {
    // If the user is logged in, destroy the session to log them out
    session_destroy();

    // Set cache control headers to prevent caching
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');

    header('Location: index.php'); // Redirect to the home page or any other page you prefer
    exit();
} else {
    // If the user is not logged in, you can redirect them to the login page or do something else
    header('Location: index.php'); // Redirect to the home page or the login page
    exit();
}
?>
