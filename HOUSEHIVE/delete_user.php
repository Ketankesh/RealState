<?php 
// Start the session
session_start();
include "connect.php";
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Perform the user deletion
    $deleteQuery = "DELETE FROM Users WHERE userid = $userId";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        echo 'success';
    } else {
        echo 'Error deleting user: ' . mysqli_error($con);
    }

    exit; // Exit to stop further execution
}
?>