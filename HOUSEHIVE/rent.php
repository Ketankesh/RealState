<?php
session_start();
include "connect.php";

// SQL query to create table
$query = "CREATE TABLE if not exists rent_hive (
  id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(255), 
  lastname VARCHAR(255),
  rentemail VARCHAR(255),
  country VARCHAR(255),
  city VARCHAR(255),
  postalcode VARCHAR(20),
  rentdescription TEXT,
  intrestedproperty VARCHAR(255),
  price VARCHAR(50),
  agree TINYINT(1)
)";

// Execute the query 
mysqli_query($con, $query);


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get data from the form
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $rentemail = $_POST['rentemail'];
  $country = $_POST['country'];
  $city = $_POST['city'];
  $phone = $_POST['phone'];
  $rentdescription = $_POST['rentdescription'];
  $intrestedproperty = $_POST['intrestedproperty'];
  $price = $_POST['price'];
  $agree = isset($_POST['agree']) ? 1 : 0; // Convert checkbox value to 1 or 0

  // SQL query to insert data into the rent_hive table
  $insertQuery = "INSERT INTO rent_hive (firstname, lastname, rentemail, country, city, phone, rentdescription, intrestedproperty, price, agree)
                  VALUES ('$firstname', '$lastname', '$rentemail', '$country', '$city', '$phone', '$rentdescription', '$intrestedproperty', '$price', '$agree')";

  // Execute the query
  if (mysqli_query($con, $insertQuery)) {
    echo '<script>alert("We Will Contact You Soon!");</script>';

  } else {
      echo "Error inserting data: " . mysqli_error($con);
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
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

 <link rel="stylesheet" href="./css/rentstyle.css">
 <link rel="stylesheet" href="./css/buy.css">
 <link rel="stylesheet" href="./css/footer1.css">


 <!--fontawesome-->
 <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>

    <title>RENT A HOUSE</title>
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



<!--coursel-->
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
      
      
        <h1 class="text-center">Some Premium Home For You.....</h1>


    <!---details-->
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
    <div class="container-fluid" >
       <div class="row">
          <div class="col-md-7">
            <div class="container" style="margin-top:8%">

               <div class="row">
               
                 <div class="col-md-6">
                 
                   <div class="card" >
               
                     <div id="carousel1" class="carousel slide" data-ride="carousel">
               
                       <div class="carousel-inner">
                         <div class="carousel-item active">
                           <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100"style="border-radius:5px">
                           <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal">View Details</button>
                    </div>
                         </div>
                         <div class="carousel-item">
                           <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100"style="border-radius:5px"> 
                           <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal">View Details</button>
                    </div>
                         </div>
                       </div>
                       <!-- Bootstrap Modal -->
               <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   
               
                       <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                         <span class="carousel-control-prev-icon"></span>
                       </a>
               
                       <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                         <span class="carousel-control-next-icon"></span>
                       </a>
               
                     </div>
                     
                   </div>
               
                 </div>
               
                 <div class="col-md-6">
               
                   <div class="card">
               
                     <div id="carousel2" class="carousel slide" data-ride="carousel">
                     
                       <!-- Slider content -->
                       <div class="carousel-inner">
                         <div class="carousel-item active">
                           <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                           <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal2">View Details</button>
                    </div>
                         </div>
                         <div class="carousel-item">
                           <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100"style="border-radius:5px">
                           <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal2">View Details</button>
                    </div> 
                         </div>
                       </div>
                       <!-- Bootstrap Modal -->
               <div class="modal fade" id="productModal2" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   
               
                       <a class="carousel-control-prev" href="#carousel2" role="button" data-slide="prev">
                         <span class="carousel-control-prev-icon"></span>
                       </a>
               
                       <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
                         <span class="carousel-control-next-icon"></span>
                       </a>
                     </div>
               
                   </div>
               
                 </div>

               </div>
               
              </div>
           </div>

      <div class="col-md-5">
            
        <!-- Google Map -->
        <div id="map-container-google-1" class="z-depth-1-half map-container" style="margin-top:1%">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.2812872684435!2d-122.16973568450864!3d37.42748041199908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808586e6302615a1%3A0x86bd130251757c00!2sStorey%20Ave%2C%20San%20Francisco%2C%20CA%2094129!5e0!3m2!1sen!2sus!4v1620243992830!5m2!1sen!2sus" width="350" height="250" style="border-radius:5px;" allowfullscreen="" loading="lazy"></iframe>
        </div>

      </div>
       </div>
    <div class="row">
      <div class="container-fluid" style="margin-top:2%">

       <div class="row">
       
         <div class="col-md-4">
         
           <div class="card">
       
             <div id="carousel3" class="carousel slide" data-ride="carousel">
       
               <div class="carousel-inner">
                 <div class="carousel-item active">
                   <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                   <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal3">View Details</button>
                    </div>
                 </div>
                 <div class="carousel-item">
                   <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px"> 
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                   <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal4">View Details</button>
                    </div>
                 </div>
                 <div class="carousel-item">
                   <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px"> 
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                   <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal5">View Details</button>
                    </div>
                 </div>
                 <div class="carousel-item">
                   <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
     <div class="row">
           <div class="container-fluid" style="margin-top:2%">
       
         <div class="row">
       
           <div class="col-md-4">
           
             <div class="card">
       
               <div id="carousel6" class="carousel slide" data-ride="carousel">
       
                 <div class="carousel-inner">
                   <div class="carousel-item active">
                     <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal6">View Details</button>
                    </div>
                   </div>
                   <div class="carousel-item">
                     <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px"> 
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal6">View Details</button>
                    </div>
                   </div>
                 </div>
                  <!-- Bootstrap Modal -->
                  <div class="modal fade" id="productModal6" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   
               
                 <a class="carousel-control-prev" href="#carousel6" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon"></span>
                 </a>
       
                 <a class="carousel-control-next" href="#carousel6" role="button" data-slide="next">
                   <span class="carousel-control-next-icon"></span>
                 </a>
       
               </div>
               
             </div>
       
           </div>
       
           <div class="col-md-4">
       
             <div class="card">
       
               <div id="carousel7" class="carousel slide" data-ride="carousel">
               
                 <!-- Slider content -->
                <div class="carousel-inner">
                   <div class="carousel-item active">
                     <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal7">View Details</button>
                    </div>
                   </div>
                   <div class="carousel-item">
                     <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px"> 
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal7">View Details</button>
                    </div>
                   </div>
                 </div>
                 <!-- Bootstrap Modal -->
                 <div class="modal fade" id="productModal7" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   
               
                 <a class="carousel-control-prev" href="#carousel7" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon"></span>
                 </a>
       
                 <a class="carousel-control-next" href="#carousel7" role="button" data-slide="next">
                   <span class="carousel-control-next-icon"></span>
                 </a>
               </div>
       
             </div>
       
           </div>
       
           <div class="col-md-4">
           
             <div class="card">  
       
               <div id="carousel8" class="carousel slide" data-ride="carousel">
               
                 <!-- Slider content -->  
                 <div class="carousel-inner">
                   <div class="carousel-item active">
                     <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal8">View Details</button>
                    </div>
                   </div>
                   <div class="carousel-item">
                     <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal8">View Details</button>
                    </div> 
                   </div>
                 </div>
                  <!-- Bootstrap Modal -->
                  <div class="modal fade" id="productModal8" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   
               
                 <a class="carousel-control-prev" href="#carousel8" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon"></span>
                 </a>
       
                 <a class="carousel-control-next" href="#carousel8" role="button" data-slide="next">
                   <span class="carousel-control-next-icon"></span>
                 </a>
               </div>
             
             </div>
                   
           </div>
       
         </div>
         </div>
       </div>
       <div class="row">
       <div class="container-fluid" style="margin-top:2%">

         <div class="row">
         
           <div class="col-md-4">
           
             <div class="card">
         
               <div id="carousel9" class="carousel slide" data-ride="carousel">
         
                 <div class="carousel-inner">
                   <div class="carousel-item active">
                     <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal9">View Details</button>
                    </div>
                   </div>
                   <div class="carousel-item">
                     <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px"> 
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal9">View Details</button>
                    </div>
                   </div>
                 </div>
                 <!-- Bootstrap Modal -->
                 <div class="modal fade" id="productModal9" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   
               
                 <a class="carousel-control-prev" href="#carousel9" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon"></span>
                 </a>
         
                 <a class="carousel-control-next" href="#carousel9" role="button" data-slide="next">
                   <span class="carousel-control-next-icon"></span>
                 </a>
         
               </div>
               
             </div>
         
           </div>
         
           <div class="col-md-4">
         
             <div class="card">
         
               <div id="carousel10" class="carousel slide" data-ride="carousel">
               
                 <!-- Slider content -->
                 <div class="carousel-inner">
                   <div class="carousel-item active">
                     <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal10">View Details</button>
                    </div>
                   </div>
                   <div class="carousel-item">
                     <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px"> 
                     <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal10">View Details</button>
                    </div>
                   </div>
                 </div>
                      <!-- Bootstrap Modal -->
                      <div class="modal fade" id="productModal10" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   
               
                 <a class="carousel-control-prev" href="#carousel10" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon"></span>
                 </a>
         
                 <a class="carousel-control-next" href="#carousel10" role="button" data-slide="next">
                   <span class="carousel-control-next-icon"></span>
                 </a>
               </div>
         
             </div>
         
           </div>
         
           <div class="col-md-4">
           
           <div class="card">
              <div id="carousel11" class="carousel slide" data-ride="carousel">
                <!-- Slider content -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="images/r-architecture-L_j9OWElo1s-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                    <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal11">View Details</button>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="d-block w-100" style="border-radius:5px">
                    <div class="carousel-caption text-white">
                      <h5>Overlay Title</h5>
                      <p>Overlay text here</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#productModal11">View Details</button>
                    </div>
                  </div>
                </div>
              <!-- Bootstrap Modal -->
              <div class="modal fade" id="productModal11" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
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
                                       <img src="images/r-architecture-NeN1D7Z3Ick-unsplash.jpg" class="img-fluid" alt="Image 2">
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
                   
               
            
                <a class="carousel-control-prev" href="#carousel11" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
            
                <a class="carousel-control-next" href="#carousel11" role="button" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
              </div>
            </div>
            
                   
           </div>
         
         </div>
         
         </div>
       </div>
       <div class="row">
        <div class="col text-center" style="margin:1% 0 1% 0">
          <button class="btn btn-lg bg-primary text-white">Next page</button>
        </div>
       </div>
    </div>
  </div>
   

<style>
  .bgrent{
    background-color: rgba(49, 229, 115, 0.447);
    border-radius: 6px;
  }
</style>
    <!--form-->
    <div class="container bgrent">
             <h2 class="text-center" style="margin:5% 0 0 0;">Want Us To Get You A Beautyfull Offer:-<br>
              </h2> 
             
        <div class="row" style="margin-top: 5%;">
            <div class="col">
                <form method="post" action="" class="was-validated">
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault01">First name</label>
                        <input type="text" name="firstname" class="form-control" id="validationDefault01" value="" required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault02">Last name</label>
                        <input type="text" name="lastname" class="form-control" id="validationDefault02" value="" required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault03">Email</label>
                        <input type="text" name="rentemail" class="form-control" id="validationDefault03" value="" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-6 mb-3">
                        <label for="validationDefault04">Country</label>
                        <input type="text" name="country" class="form-control" id="validationDefault04" required>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="validationDefault06">City</label>
                        <input type="text" name="city" class="form-control" id="validationDefault06" required>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Mobile No.</label>
                        <input type="text" name="phone" class="form-control" id="validationDefault05" required>
                      </div>
                    </div>
                   
                    
                    <div class="mb-3">
                        <label for="validationTextarea">THINGS ONE OR TWO ABOUT YOUR DREAM HOME</label>
                        <textarea class="form-control is-invalid" name="rentdescription" id="validationTextarea" placeholder="Required example textarea" required></textarea>
                        <div class="invalid-feedback">
                          Please Describe...... The more the better
                        </div>
                      </div>
                      <div class="form-row">
                      <div class="col mb-3">
                        <label for="validationDefault07">Poperty Id(if already choosen</label>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

