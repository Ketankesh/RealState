<?php
// Start session
session_start();
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connect.php";
// Check if user is logged in
if(!isset($_SESSION['userid'])) {
  header('Location: index.php');
  exit;
}

// Get user data from session
$username = $_SESSION['username'];
$phone = $_SESSION['phone']; 
$email = $_SESSION['email'];


// Handle form submit
if(isset($_POST['username'])) {
    
    // Update the email variable after checking if it's set in $_POST
    if (isset($_POST['email'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
    } 
    $stmt = $con->prepare("UPDATE users SET 
    username = ?, 
    phone = ?,
    email = ?  
    
    WHERE userid = ?");
        
    $stmt->bind_param('isss', 
        $_SESSION['userid'],
        $_POST['username'], 
        $_POST['phone'],
        $email 
        
    );
    
    if ($stmt->execute()) {
        // Success: The data was updated
        // You can add a success message or redirect the user to another page
        // For example, you can redirect them back to the profile page.
        header('Location: profile.php');
        
        exit;
    } else {
        die("Error: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Profile</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Custom CSS -->
<style>
.profile-img {
  text-align: center;
}
.profile-img img {
  width: 200px;
}
</style>

</head>
<body>

<div class="container">
  <div class="row">

    <div class="col-md-4">
      <div class="profile-img">
        <img src="images/untitled.png" id="profileImage" class="rounded-circle">
        <div class="upload-btn">
          <input type="file" id="imageUpload">
          Upload Image 
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <h2 class="mt-2"><?php echo $username; ?></h2>

      <form method="POST">
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
        </div>

        <div class="form-group">
          <label>Phone</label>
          <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
        </div>
        
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
      </form>

    </div>

  </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Image Upload JS -->  
<script>
$(document).ready(function() {

  $('#imageUpload').on('change', function() {

    var formData = new FormData();
    formData.append('file', $('#imageUpload')[0].files[0]);

    $.ajax({
      url: 'profile.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        $('#profileImage').attr('src', response); 
      }
    });

  });

});
</script>

</body>
</html>