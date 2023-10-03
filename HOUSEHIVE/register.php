<?php 

include "connect.php";

$c = "CREATE TABLE IF NOT EXISTS Users (
  userid INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  phone VARCHAR(15),
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  address VARCHAR(255)
)";
$res=mysqli_query($con,$c);

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Get form data
  $username = $_POST['username'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  
  // Insert data into the 'Users' table
  $ins = "INSERT INTO Users (username, phone, email, password, address) VALUES ('$username', '$phone', '$email', '$password', '$address')";
  $result = mysqli_query($con, $ins);

  if ($result) {
    // Display a success message using JavaScript alert
    echo '<script>alert("Account created successfully.");</script>';
    
    // Redirect the user to index.php
    echo '<script>window.location.href = "index.php";</script>';
    exit; // Terminate the script to prevent further execution
} else {
    echo "Error: " . mysqli_error($con);
}
 
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Address</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="./stylere.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
 


</head>
<body style="background-color:black">
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
        <div class="container">
            <a class="navbar-brand text-white" href="index.php">HouseHive-The Dream You Had</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link bg-white" style="border-radius: 5px;color:black;" href="index.php">Back</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- partial:index.partial.html -->
<form class="grop-from" method="post" id="signup">
  <div class="form-head"><span class="text"> </span><i class="icon-placeholder"></i></div>
  <div class="form-body"><span class="error-text">Please Fill Out This Field</span>
    <div class="form-controls">
      <input id="control-name" name="username" placeholder="Name"/ type="text">
      <input id="control-phone" name="phone" placeholder="Phone No"/ type="text">
      <input id="control-email" name="email" placeholder="Email"/ type="text">
      <input id="control-password" name="password" placeholder="Password" type="password"/>
      <input id="control-password-repeat" placeholder="Confirm Password" type="password"/>
      <input id="control-address" name="address" placeholder="address"/ type="text">
    </div>
  </div><a class="form-action"><i class="icon-action"></i></a><div class="container text-center" style="margin-top: 1%;color:white"><input type="submit" name="submit" style="color:white" value="Create" class="btn btn bg-danger"/></div>
  
</form>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script><script  src="./scriptre.js"></script>

</body>
</html>
