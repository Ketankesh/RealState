<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include "connect.php";

// Define upload folder
$uploadDir = 'uploads/';

// Create upload folder if not exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}

// Initialize variables with default values
$fname = $lname = $email = $country = $city = $location = $proptype = $pricebid = $phone = $description = $price = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data if it exists
    $fname = isset($_POST['fname']) ? $_POST['fname'] : "";
    $lname = isset($_POST['lname']) ? $_POST['lname'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $country = isset($_POST['country']) ? $_POST['country'] : "";
    $city = isset($_POST['city']) ? $_POST['city'] : "";
    $location = isset($_POST['location']) ? $_POST['location'] : "";
    $proptype = isset($_POST['proptype']) ? $_POST['proptype'] : "";
    $pricebid = isset($_POST['pricebid']) ? $_POST['pricebid'] : "";
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
    $description = isset($_POST['description']) ? $_POST['description'] : "";
    $price = isset($_POST['price']) ? $_POST['price'] : "";

    // Creation of table

    // Create a "sell_hive" table if it doesn't exist
   // $c = "CREATE TABLE IF NOT EXISTS sell_hive (
   //   property_id INT AUTO_INCREMENT PRIMARY KEY,
   //  
   //   fname VARCHAR(255),
   //   lname VARCHAR(255),
   //   email VARCHAR(255),
   //   country VARCHAR(255),
   //   city VARCHAR(255),
   //   location VARCHAR(255),
   //   proptype VARCHAR(255),
   //   pricebid VARCHAR(100),
   //   phone VARCHAR(20),
   //   description VARCHAR(255),
   //   price VARCHAR(10),
   //   agree TINYINT(1),
   //   files VARCHAR(255)
   // ) AUTO_INCREMENT = 100";
   // $res = mysqli_query($con, $c);

    

// Check form submit
if (isset($_POST['save'])) {
  // Upload files
  $files = [];
  if (isset($_FILES['fileupload']['name']) && is_array($_FILES['fileupload']['name'])) {
      foreach ($_FILES['fileupload']['name'] as $i => $name) {
          // Check if a file was uploaded for this input
          if ($_FILES['fileupload']['error'][$i] === UPLOAD_ERR_NO_FILE) {
              continue; // Skip this file and proceed with the next one
          }

          $tempPath = $_FILES['fileupload']['tmp_name'][$i];
          $filePath = $uploadDir . $name;

          // Check for file upload errors
          if ($_FILES['fileupload']['error'][$i] !== UPLOAD_ERR_OK) {
              echo "File '$name' upload failed with error code: " . $_FILES['fileupload']['error'][$i];
              continue; // Skip this file and proceed with the next one
          }

          if (move_uploaded_file($tempPath, $filePath)) {
              $files[] = $filePath;
          } else {
              echo "Failed to move the uploaded file: $name";
          }
      }
  }

  // Insert data into the database
  if (!empty($files)) {
      $filesStr = implode(",", $files);
      $stmt = $con->prepare("INSERT INTO sell_hive (fname, lname, email, country, city, location, proptype, pricebid, phone, description, price, files) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssssssssss", $fname, $lname, $email, $country, $city, $location, $proptype, $pricebid, $phone, $description, $price, $filesStr);
      if ($stmt->execute()) {
          echo '<script>alert("Request Submitted!");</script>';
      } else {
          echo "ERROR: Could not execute $sql. " . $stmt->error;
      }
  }
}

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
 
 <link rel="stylesheet" href="./css/rentstyle.css">
 <link rel="stylesheet" href="./css/footer1.css">


 <!--fontawesome-->
 <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>

    <title>Sell Your House</title>
</head>
<style>
.nav-left {
  position: absolute;
  top: 20px;
  right: 20px;
}
.nav-btn {
  margin-left: 10px;
}
/* Add some CSS styles for the profile image and dropdown */
.profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .dropdown {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
        }
        .dropdown-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }

        .dropdown a {
            text-decoration: none;
            color: #333;
            padding: 10px 0;
            width: 100%;
            text-align: center;
        }

        .dropdown a:hover {
            background-color: #f1f1f1;
        }</style>
<body>
      <!--nav starts-->
      <header class="header">
    <nav class="navbar">
        <a href="index.php" class="nav-logo">HouseHive-The Dream You Had</a>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="#" class="nav-link">Site View</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        <div class="nav-right"> <!-- New container for profile section -->
            <?php
            if (isset($_SESSION['userid'])) {
                // Display the profile image and dropdown
                echo '<div class="profile-section">';
                echo '<img src="images/untitled.png" alt="Profile Image" style="margin-left:5%" class="profile-image" id="profileImage">';
                echo '<h6>' . $_SESSION['username'] . '</h6>';
                echo '</div>';
                echo '<div class="dropdown" id="profileDropdown">';
                echo '<div class="dropdown-content">';
                echo '<a href="logout.php">Logout</a>';
                echo '</div>';
                echo '</div>';
            } else {
                // Display the login and register buttons
                echo '<div class="profile-section">';
                echo '<button class="nav-btn btn-lg bg-danger text-white" data-toggle="modal" data-target="#loginModal">Login</button>';
                echo '<button class="nav-btn btn-lg bg-danger text-white"><a style="text-decoration: none;color:white;" href="register.php">Register</a></button>';
                echo '</div>';
            }
            ?>
        </div>
    
             <script>
               // Function to toggle the dropdown
               function toggleDropdown() {
                 var dropdown = document.getElementById("profileDropdown");
                 if (dropdown.style.display === "block") {
                   dropdown.style.display = "none";
                 } else {
                   dropdown.style.display = "block";
                 }
               }
             
               // Add a click event listener to the profile image
               document.getElementById("profileImage").addEventListener("click", toggleDropdown);
             </script>
           

            <!---scripting tag-->
            <script>
                const navLink = document.querySelectorAll(".nav-link");

                navLink.forEach(n => n.addEventListener("click", closeMenu));

               function closeMenu() {
                 hamburger.classList.remove("active");
                 navMenu.classList.remove("active");
                }
            </script>
        </nav>
</header>

<style>
  .bgsell{
  background-color: rgba(0, 255, 255, 0.581);
 
  border-radius: 6px;
}
</style>

    <!--form-->
    <div class="container bgsell">
             <h2 class="text-center" style="margin:5% 0 0 0;">Want Us To Get You A Beautyfull Offer:-</h2> 
             <span style="float: right; text-align: right; ">(Note:-These Details Will Be Displyed)</span>
        <div class="row" style="margin-top: 5%;">
            <div class="col">
              <form class="was-validated" action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault01">First name</label>
                        <input type="text" class="form-control" name="fname" id="validationDefault01"  required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault02">Last name</label>
                        <input type="text" class="form-control" name="lname" id="validationDefault02"  required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault03">Email</label>
                        <input type="text" class="form-control" name="email" id="validationDefault03"  required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-6 mb-3">
                        <label for="validationDefault04">Country</label>
                        <input type="text" class="form-control" name="country" id="validationDefault04" required>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="validationDefault05">City</label>
                        <select class="custom-select" name="city" id="validationDefault05" required>
                          <option selected disabled value="">Choose...</option>
                          <option>California</option>
                          <option>Washington D.C</option>
                          <option>Texes</option>
                          <option>Nivada</option>
                          <option>Los Angles</option>
                          <option>any other</option>
                        </select>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="validationDefault06">Lcation</label>
                        <input type="text" class="form-control" name="location" id="validationDefault06" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault07">Property type</label>
                        <input type="text" class="form-control" name="proptype" id="validationDefault07"  required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault08">Price expecting</label>
                        <input type="text" class="form-control" name="pricebid" id="validationDefault08"  required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault09">Contact No.</label>
                        <input type="text" class="form-control" name="phone" id="validationDefault09"  required>
                      </div>
                      
                    </div>
                    
                    <div class="mb-3">
                        <label for="validationTextarea">THINGS ONE OR TWO ABOUT YOUR PROPERTY</label>
                        <textarea class="form-control is-invalid" id="validationTextarea" name="description" placeholder="Required example textarea" required></textarea>
                        <div class="invalid-feedback">
                          Please enter details......
                        </div>
                      </div>
                
                      <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customControlValidation2" name="price" value="fixed" required>
                        <label class="custom-control-label" for="customControlValidation2">Fixed Rate</label>
                      </div>
                      <div class="custom-control custom-radio mb-3">
                        <input type="radio" class="custom-control-input" id="customControlValidation3" name="price" value="nigotiable" required>
                        <label class="custom-control-label" for="customControlValidation3">Nigotiable</label>
                      </div>
                      <!---uplod photos-->
                      UPLOAD PHOTOS
                      <br>
                      <div class="input-group is-invalid">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" name="fileupload[]" multiple id="fileInput" required>
                              <label class="custom-file-label" for="fileInput">Choose files...</label>
                          </div>
                      </div>
                      <!-- JavaScript to update the label text with selected file names -->
                      <script>
                          document.getElementById('fileInput').addEventListener('change', function () {
                              const fileInput = this;
                              const label = fileInput.nextElementSibling;
                              const labelText = Array.from(fileInput.files).map(file => file.name).join(', ');
                              label.innerText = labelText || 'Choose files...';
                          });
                      </script>
                      <!---uplod ends-->
                      <br>
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="check" value="" id="invalidCheck2" required>
                          <label class="form-check-label" for="invalidCheck2">
                            Agree to <a href="#">terms and conditions</a>
                          </label>
                        </div>
                      </div>
                      
                      <button class="btn btn-danger" name="save" type="submit">Submit</button>
                  </form>
            </div>
        </div>
    </div>

<!---footer-->
<div class="fotter" style="margin-top: 5%;">
  <div class="container-fluid" style="height: 50vh;background-color: rgb(74, 86, 104);">
    <div class="row">
      <div class="col-4" style=" padding-top: 60px;padding-bottom: 40px;">
        <h3 style="font-size:20px;color:white; text-align:center;">We Care About Your Family <br> Like Our Own</h3>
      </div>
      <div class="col-4" style=" padding-top: 60px;padding-bottom: 40px;" >
        <h4 style="font-size: 20px; color: white; text-align: center;">CONNECT WITH US ON</h4><br><br>
        <div class="rounded-social-buttons">
          <a class="social-button facebook" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <a class="social-button twitter" href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
          <a class="social-button linkedin" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
          <a class="social-button youtube" href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
          <a class="social-button instagram" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
      </div>
      </div>
      <div class="col-4" style=" padding-top: 60px;padding-bottom: 40px;">
          <div class="container text-white">
            <div class="row">
              <div class="col">
               <h4 style="font-size:20px; text-align:center;"> 9871908614</h4><br>
               <span>
               <i class="fas fa-3x fa-mobile-alt" style=" margin-left:50%; margin-right:50%;"></i><span>
              </div>
              <div class="col">
              <h4 style="font-size:20px;">North California</h4><br>
              <span>
               <i class="fas fa-3x fa-map-marker-alt" style=" margin-left:50%; margin-right:50%;"></i><span>
              </div>
            </div>
          </div>

      </div>
    
  </div>
</div>


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>