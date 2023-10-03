<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include "connect.php"; // Include your database connection file

// Define the table name
$tableName = "buy_hive";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    // Get form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $intrestedproperty = $_POST['intrestedproperty'];
    $price = $_POST['price'];

    // Create a "buy_hive" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS $tableName (
      id INT AUTO_INCREMENT PRIMARY KEY,
      fname VARCHAR(255),
      lname VARCHAR(255),
      email VARCHAR(255),
      description TEXT,
      intrestedproperty VARCHAR(255),
      price VARCHAR(255)
    )";
    $createTableResult = mysqli_query($con, $createTableSQL);

    if (!$createTableResult) {
        echo "Error creating table: " . mysqli_error($con);
    } else {
        // Insert data into the "buy_hive" table
        $insertSQL = "INSERT INTO $tableName (fname, lname, email, description, intrestedproperty, price)
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insertSQL);
        $stmt->bind_param("ssssss", $fname, $lname, $email, $description, $intrestedproperty, $price);

        if ($stmt->execute()) {
            echo '<script>alert("Request Submitted!");</script>';
        } else {
            echo "ERROR: Could not execute $sql. " . $stmt->error;
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
 <link rel="stylesheet" href="./css/buy.css">
 <link rel="stylesheet" href="./css/footer1.css">


 <!--fontawesome-->
 <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>

    <title>BUY HOUSE</title>
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

   
    <!---ON   SALE --->

    <div class="container outer-wrapper">
       <div class="s-wrap s-type-2" role="slider">
         <ul class="s-content">
           <li class="s-item s-item-1"></li>
           <li class="s-item s-item-2"></li>
           <li class="s-item s-item-3"></li>
           <li class="s-item s-item-4"></li>
           <li class="s-item s-item-5"></li>
         </ul>
       </div>
    </div>
    
    <h1 class="text-center">DEALS YOU CAN'T RESIST.....</h1>


    <!---houses data on sale or rent-->
    <style>
                  .carousel-caption {
                    position: absolute;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    opacity: 0;
                    transition: opacity 0.5s ease;
                    z-index: 10 !important;
                    font-style: italic;
                    color: white;
                  }
            
                  .carousel-item:hover .carousel-caption {
                    opacity: 1 !important;
                  }
            
                  .carousel {
                    overflow: hidden;
                  }
                </style>
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-4">
         
         <div class="card">
     
           <div id="carousel3" class="carousel slide" data-ride="carousel">
     
             <div class="carousel-inner">
               <div class="carousel-item active">
                 <img src="images/r-architecture-WQCkior21Gc-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                 <div class="carousel-caption text-white">
                    <h5>Overlay Title</h5>
                    <p>Overlay text here</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#productModal3">View Details</button>
                  </div>
               </div>
               <div class="carousel-item">
                 <img src="images/r-architecture-KQPEhYweLrQ-unsplash.jpg" class="d-block w-100" style="border-radius:5px"> 
                 <div class="carousel-caption text-white">
                    <h5>Overlay Title</h5>
                    <p>Overlay text here</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#productModal3">View Details</button>
                  </div>
               </div>
             </div>
             <!-- Bootstrap Modal -->
             <div class="modal fade" id="productModal3" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-lg" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <!-- Images here -->
                                     <img src="" class="img-fluid" alt="Image 1">
                                     <img src="images/r-architecture-KQPEhYweLrQ-unsplash.jpg" class="img-fluid" alt="Image 2">
                                     <img src="image3.jpg" class="img-fluid" alt="Image 3">
                                     <ul>
                                      <li><b>Price:</b>$29876</li>
                                      <li><b>PropertyType: </b>CONDOS</li>
                                      <li><b>Location:</b>North Korea</li>
                                      <li><b>Property ID:</b> php</li>
                                      <li><b>Status:</b> php</li>
                                      <li><b>Description:</b> php</li>
                                     </ul>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                     <button type="button" class="btn btn-primary"><a href="contact.php" style="text-decoration:none;color:aliceblue" >Contact Seller</a></button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 
              
             <a class="carousel-control-prev" href="#carousel3" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon"></span>
             </a>
     
             <a class="carousel-control-next" href="#carousel3" role="button" data-slide="next">
               <span class="carousel-control-next-icon"></span>
             </a>
     
           </div>
           
         </div>
     
       </div>
     
       <div class="col-md-4">
     
         <div class="card">
     
           <div id="carousel4" class="carousel slide" data-ride="carousel">
           
             <!-- Slider content -->
             <div class="carousel-inner">
               <div class="carousel-item active">
                 <img src="images/r-architecture-WQCkior21Gc-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                 <div class="carousel-caption text-white">
                    <h5>Overlay Title</h5>
                    <p>Overlay text here</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#productModal4">View Details</button>
                  </div>
               </div>
               <div class="carousel-item">
                 <img src="images/r-architecture-KQPEhYweLrQ-unsplash.jpg" class="d-block w-100" style="border-radius:5px"> 
                 <div class="carousel-caption text-white">
                    <h5>Overlay Title</h5>
                    <p>Overlay text here</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#productModal4">View Details</button>
                  </div>
               </div>
             </div>
            <!-- Bootstrap Modal -->
            <div class="modal fade" id="productModal4" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-lg" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <!-- Images here -->
                                     <img src="" class="img-fluid" alt="Image 1">
                                     <img src="images/r-architecture-KQPEhYweLrQ-unsplash.jpg" class="img-fluid" alt="Image 2">
                                     <img src="image3.jpg" class="img-fluid" alt="Image 3">
                                     <ul>
                                      <li><b>Price:</b>$29876</li>
                                      <li><b>PropertyType: </b>CONDOS</li>
                                      <li><b>Location:</b>North Korea</li>
                                      <li><b>Property ID:</b> php</li>
                                      <li><b>Status:</b> php</li>
                                      <li><b>Description:</b> php</li>
                                     </ul>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                     <button type="button" class="btn btn-primary"><a href="contact.php" style="text-decoration:none;color:aliceblue" >Contact Seller</a></button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 
              
             <a class="carousel-control-prev" href="#carousel4" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon"></span>
             </a>
     
             <a class="carousel-control-next" href="#carousel4" role="button" data-slide="next">
               <span class="carousel-control-next-icon"></span>
             </a>
           </div>
     
         </div>
     
       </div>
     
       <div class="col-md-4">
       
         <div class="card">  
     
           <div id="carousel5" class="carousel slide" data-ride="carousel">
           
             <!-- Slider content -->  
             <div class="carousel-inner">
               <div class="carousel-item active">
                 <img src="images/r-architecture-WQCkior21Gc-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                 <div class="carousel-caption text-white">
                    <h5>Overlay Title</h5>
                    <p>Overlay text here</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#productModal5">View Details</button>
                  </div>
               </div>
               <div class="carousel-item">
                 <img src="images/r-architecture-KQPEhYweLrQ-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                 <div class="carousel-caption text-white">
                    <h5>Overlay Title</h5>
                    <p>Overlay text here</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#productModal5">View Details</button>
                  </div> 
               </div>
             </div>
             <!-- Bootstrap Modal -->
             <div class="modal fade" id="productModal5" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-lg" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <!-- Images here -->
                                     <img src="" class="img-fluid" alt="Image 1">
                                     <img src="images/r-architecture-KQPEhYweLrQ-unsplash.jpg" class="img-fluid" alt="Image 2">
                                     <img src="image3.jpg" class="img-fluid" alt="Image 3">
                                     <ul>
                                      <li><b>Price:</b>$29876</li>
                                      <li><b>PropertyType: </b>CONDOS</li>
                                      <li><b>Location:</b>North Korea</li>
                                      <li><b>Property ID:</b> php</li>
                                      <li><b>Status:</b> php</li>
                                      <li><b>Description:</b> php</li>
                                     </ul>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                     <button type="button" class="btn btn-primary"><a href="contact.php" style="text-decoration:none;color:aliceblue" >Contact Seller</a></button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 
             
             <a class="carousel-control-prev" href="#carousel5" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon"></span>
             </a>
     
             <a class="carousel-control-next" href="#carousel5" role="button" data-slide="next">
               <span class="carousel-control-next-icon"></span>
             </a>
           </div>
         
         </div>
               
       </div>
     
     </div>
     
     </div>
    </div>
        </div>
       </div>
<style>
  .bg{
    background-color:rgba(27, 48, 48, 0.637);
    margin-bottom: 2%;
    border-radius: 5px;
  }
</style>


    <!--form-->
    <div class="container text-white bg">
         <h2 class="text-center" style="margin:5% 0 0 0;">Tell Us More About What You Are Looking For:-</h2>      
        <div class="row" style="margin-top: 5%;">
            <div class="col">
            <form class="was-validated" action="" method="post">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault01">First name</label>
                        <input type="text" name="fname" class="form-control" id="validationDefault01" value="" required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault01">Last name</label>
                        <input type="text" name="lname" class="form-control" id="validationDefault01" value="" required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault02">Email</label>
                        <input type="text" name="email" class="form-control" id="validationDefault02" value="" required>
                      </div>
                    </div>
                   <div class="mb-3">
                        <label for="validationTextarea">THINGS ONE OR TWO ABOUT YOUR DREAM HOME</label>
                        <textarea class="form-control is-invalid" name="description" id="validationTextarea" placeholder="Required example textarea" required></textarea>
                        <div class="invalid-feedback">
                          Please Describe...... The more the better
                        </div>
                      </div>
                      <div class="form-row">
                      <div class="col mb-3">
                        <label for="validationDefault01">Poperty Id(if already choosed)</label>
                        <input type="text" name="intrestedproperty" class="form-control" id="validationDefault07" value="">
                      </div></div>
                      <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customControlValidation1" name="price" value="20 Lakh or Below" required>
                        <label class="custom-control-label" for="customControlValidation1" >20 Lakh or Below</label>
                      </div><div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customControlValidation2" name="price" value="50 Lakh To 20 Lakh" required>
                        <label class="custom-control-label" for="customControlValidation2" >50 Lakh To 20 Lakh</label>
                      </div><div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customControlValidation3" name="price" value="1 Crore Or More" required>
                        <label class="custom-control-label" for="customControlValidation3" >1 Crore Or More</label>
                      </div><br>
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                          <label class="form-check-label" for="invalidCheck2">
                            Agree to <a href="terms&condition.php">terms and conditions</a>
                          </label>
                        </div>
                      </div>
                      
                      <input class="btn btn-danger" name="submit" type="submit"></input>
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
<script src="/js/buy.js"></script>
</body>
</html>