<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "connect.php";



//database create
//$c="CREATE DATABASE IF NOT EXISTS Realstate";
//$res=mysqli_query($con,$c);


//create table
$d="create table if not exists feedback(id int NOT NULL auto_increment primary key,name varchar(30) NOT NULL,email varchar(20) NOT NULL,text varchar(100) NOT NULL)";
$res=mysqli_query($con,$d);

//Insertion
if(isset($_POST["submit"]))
{
  $name=$_POST['name'];
$email=$_POST['email'];
$text=$_POST['text'];
   
        $ins="insert into feedback(name,email,text) values('$name','$email','$text')";
        $res = mysqli_query($con,$ins);
   
}
//login 
if(isset($_POST['email']) && isset($_POST['password'])) {

  // Get form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query database
  $sql = "SELECT email, username FROM users WHERE email='$email' AND password='$password'";
  $result = $con->query($sql);

  // Check if user exists
  if (!$res) {
    echo "Error: " . mysqli_error($con);
}

  if($result->num_rows == 1) {
     // Fetch user data
     $user = $result->fetch_assoc();
    // Start session for user
    $_SESSION['userid'] = $email;
    $_SESSION['username'] = $user['username'];
    

  } else {
    echo "Invalid email or password.";
  }

}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"">



          <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/testimonal.css">
    <link rel="stylesheet" href="./css/fotter.css">


    <!--fontawesome-->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>

    <title>HouseHive</title>


</head>
<body>
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
    <!--nav starts-->
    <nav class="navbar">
        <div class="navbar-container container">
            <input type="checkbox">
            <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
            <ul class="menu-items">
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#testimonials">Testimonial</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <h1 class="logo" style="color:cadetblue">HouseHive-The Dream You Had</h1>
            <div class="nav-left">
            <?php
              if (isset($_SESSION['userid'])) {
                  // Display the profile image and dropdown
                  
                  echo '<img src="images/untitled.png" alt="Profile Image" class="profile-image" id="profileImage">';
                  echo '<h6> ' .$_SESSION['username'] . '</h6>';
                  echo '<div class="dropdown" id="profileDropdown">';
                  echo '<div class="dropdown-content">';
                 
                  echo '<a href="logout.php">Logout</a>';
                  echo '</div>';
                  echo '</div>';
              } else {
                  // Display the login and register buttons
                  echo '<button class="nav-btn btn-lg bg-danger text-white" data-toggle="modal" data-target="#loginModal">Login</button>';
                  echo '<button class="nav-btn btn-lg bg-danger text-white"><a style="text-decoration: none;color:white;" href="register.php">Register</a></button>';
              }
              ?>
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
           </div>
          </div>
        </div>
    </nav>
  
    <div class="container" style="height: 10vh;">

    </div>
    <!--nav ends-->

    <!--Search house-->
    <div class="container-fluid" id="bimg" style="background-image: url(./images/background/r-architecture-Cn87TISYij8-unsplash.jpg);" >
        <div class="row">
           
            <div class="col" >
            </div>
            <div class="col-6" id="app-cover" >
                 
                  <div id="app"> 
                    <form method="get" action="">
                      <div id="f-element">
                        <div id="inp-cover"><input type="text" name="query" placeholder="Discover a place you'll love to live" autocomplete="off"></div>
                      </div>
                      <button type="submit" id="button" class="shadow"><i class="fas fa-search"></i></button>
                    </form>
                  </div>    
                  <div id="layer" title="Click the blue area to hide the form"></div>
                  <div id="init"></div>
                </div>
                 
            </div>
            
            <div class="col" >

            </div>
        </div>

    </div>
           <!---About pages--->

           <div class="container "  >
            <div class="row" >
                <div class="col-md-4 text-center ">
                    <div ><img src="./images/logo/BuyAHome.svg" height="150px"></div>
                    <h3 style="margin-top: 6%;">Buy A House</h3>
                    <P >With over 1 million+ homes for sale available on the website, Trulia can match you with a house you will want to call home.</P>
                    <a href="buy.php" style="text-decoration: none; ">
                    <button class="btn btn-grad btn-lg">Take A Look</button>
                   </a>
    
                </div>
                <div class="col-md-4 text-center" >
                  <div ><img src="./images/logo/RentAHome.svg" height="150px"></div>
                    <h3 style="margin-top: 6%;">Rent A House</h3>
                    <p >With 35+ filters and custom keyword search, Trulia can help you easily find a home or apartment for rent that you'll love.</p>
                    <a href="rent.php" style="text-decoration: none;">
                    <button class="btn btn-grad btn-lg">Take A Look</button>
                  </a>
    
                </div>
                <div class="col-md-4 text-center">
                  <div ><img src="./images/logo/Neighborhoods.svg" height="150px" ></div>
                    <h3 style="margin-top: 6%;">Sell A House</h3>
                    <p >With more neighborhood insights than any other real estate website, we've captured the color and diversity of communities.</p>
                    <a href="sell.php" style="text-decoration: none;">
                    <button class="btn btn-grad btn-lg">Take A Look</button></a>
    
                </div>
            </div>
        </div>
        
        


                
        
           
        <!---coursel-->
        <main style="margin-top:5% ;">
         <div class="hero-left">
           <h1>TOP DEALS</h1>
           <div class="layers">
             <div class="layer1 layer-displayed" data-scene="1">
               <span>SPITI VILLA</span>
               <div class="layer__image" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80')"></div>
               <div class="layer__info">
                 <div>
                   <strong>Rent</strong>
                   <strong>Location</strong>
                   <strong>Sq Ft</strong>
                   <strong>Ballcony</strong>
                   
                 </div>
                 <div>
                   <span>1M $</span>
                   <span>SPITY VALLEY</span>
                   <span>8000</span>
                   <span>4</span>
                   
                 </div>
               </div>
             </div>
             <div class="layer1" data-scene="2">
               <span>THE ARYAS</span>
               <div class="layer__image" style="background-image: url('https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=889&q=80')"></div>
               <div class="layer__info">
                 <div>
                   <strong>Rent</strong>
                   <strong>Location</strong>
                   <strong>Sq Ft</strong>
                   <strong>Ballcony</strong>
                   
                 </div>
                 <div>
                   <span>1M $</span>
                   <span>SPITY VALLEY</span>
                   <span>8000</span>
                   <span>5</span>
                 </div>
               </div>
             </div>
             <div class="layer1" data-scene="3">
               <span>THE HOBBIT</span>
               <div class="layer__image" style="background-image: url('https://images.unsplash.com/photo-1584956861988-913b8c1c7270?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=667&q=80')"></div>
               <div class="layer__info">
                 <div>
                   <strong>RENT</strong>
                   <strong>Location</strong>
                   <strong>Sq Ft</strong>
                   <strong>Ballcony</strong>
                   
                 </div>
                 <div>
                   <span>100K $</span>
                   <span>Wairere Falls, Waikato</span>
                   <span>6000</span>
                   <span>1</span>
                 </div>
               </div>
             </div>
           </div>
           <button onclick="switchLayer(2)"><</button>
           <button onclick="switchLayer()">></button>
         </div>
         <div class="hero-right">
           <div class="layer1 layer-displayed" data-scene="1"></div>
           <div class="layer1" data-scene="2"></div>
           <div class="layer1" data-scene="3"></div>
           <div class="photo-frame">
             <div class="layer1 layer-displayed" style="background-image: url('https://images.unsplash.com/photo-1600607688969-a5bfcd646154?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=750&q=80')" data-scene="1"></div>
             <div class="layer1" style="background-image: url('https://images.unsplash.com/photo-1565731761817-6bdc8e7d9f34?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1789&q=80')" data-scene="2"></div>
             <div class="layer1" style="background-image: url('https://images.unsplash.com/photo-1578305034054-6eb022b06c9d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80')" data-scene="3"></div>
             <div class="cover"></div>
           </div>
           <div class="photo-name">
             <div class="photo-name__wrapper">
               <div class="layer1 layer-displayed" data-scene="1">
                 <span class="photo-name__title ">SPITY VILLA</span>
                 <span >1 MILLION U.S(DOLLAR)</span>
               </div>
               <div class="layer1" data-scene="2">
                 <span class="photo-name__title">THE ARYAS</span>
                 <span>2 MILLION U.S(DOLLORS)</span>
               </div>
               <div class="layer1" data-scene="3 ">
                 <span class="photo-name__title">THE HOBBIT</span>
                 <span>10 THOUSAND(DOLLAR)</span>
               </div>
             </div>
           </div>
           <div class="photo-frame">
             <div class="layer1 layer-displayed" style="background-image: url('https://images.unsplash.com/photo-1604014238170-4def1e4e6fcf?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80')" data-scene="1"></div>
             <div class="layer1" style="background-image: url('https://images.unsplash.com/photo-1548386704-23fc0135faab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80')" data-scene="2"></div>
             <div class="layer1" style="background-image: url('https://images.unsplash.com/photo-1565024144003-1e575b05564e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=889&q=80')" data-scene="3"></div>
             <div class="cover"></div>
           </div>
         </div>
       </main>


       <h3 class="container" style="text-align: center; justify-content: center; font-size: 20px; font-family: poppins; margin-top: 5%; margin-bottom: 5%;">Search over 1.1 million listings including apartments, houses, condos, and townhomes available for rent. You’ll find your next home, in any style you prefer.</h3>
           

        <!--About-->
        <div class="container-fluid text-white" id="divder">
            <div class="row no-gutters" id="about">
                <div class="col-6" style="background-image: linear-gradient(to right, #f8f6f6 0%, #b1a5a5  51%, #807575  100%)">
                   <h3 style="margin-top: 10%;">Renting Made Simple</h3>
                 <p style="margin-top: 8%;" >Browse the highest quality listings, apply online,<br> sign your lease, and even pay your rent from any device.</p>
                </div>
                <div class="col-6">
                    <img src="./images/widget_1_1407.jpg" height="100%" width="100%">
                </div>

            </div>
            <div class="row no-gutters">
                <div class="col-6">
                    <img src="./images/widget_2_1407.jpg" height="100%" width="100%">
                </div>
                <div class="col-6" style="background-image: linear-gradient(to right,#f8f6f6 0%, #b1a5a5  51%, #807575  100%)">
                    <h3 style="margin-top: 10%;">Find Your Next Renter</h3>
                    <p style="margin-top: 8%;">Connect with millions of renters and lease<br> your property 100% online</p>
                </div>

            </div>
            <div class="row no-gutters">
                <div class="col-6" style="background-image: linear-gradient(to right,#f8f6f6 0%, #b1a5a5  51%, #807575  100%)">
                    <h3 style="margin-top: 10%;">Tips for Renters</h3>
                    <p style="margin-top: 8%;">Find answers to all of your renting questions<br> with the best renter’s guide in the galaxy.</p>
                </div>
                <div class="col-6"><img src="./images/widget_3_1407.jpg" height="100%" width="100%"></div>

            </div>
            <div class="row no-gutters">
                <div class="col-6">
                    <img src="./images/widget_list_1407.jpg" height="100%" width="100%">

                </div>
                <div class="col-6" style="background-image: linear-gradient(to right,#f8f6f6 0%, #b1a5a5  51%, #807575  100%)">
                    <h3 style="margin-top: 10%;">Make A Secure Healthy Enviroment For Your Kids</h3>
                    

                </div>

            </div>

        </div>

        <!--testimonal-->
       
        <div class="testimonial text-center" id="testimonials" style="background-image:url(https://images.unsplash.com/photo-1486684228390-da5df1e46f7e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80);height:80vh;">
          <div class="container">
            <div class="row">
              <div class="col">
        
            <div class="heading white-heading">
              What Our Clients Say
            </div>
            <div id="testimonial4" class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
        
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <div class="testimonial4_slide">
                    <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                    <h4>Client 1</h4>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="testimonial4_slide">
                    <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                    <h4>Client 2</h4>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="testimonial4_slide">
                    <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                    <h4>Client 3</h4>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#testimonial4" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#testimonial4" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>
              </div>
              </div>
            </div>
          </div>
        </div>

          <!---CONTACT US-->

          <div class="container-fluid" id="contact" style="padding-top: 4%; margin-top: 4% ;background-image: url(https://images.unsplash.com/photo-1486509556775-a2404e7d7d7d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80); opacity: 0.9;">
            <h1 style="text-align: center; font-size: 40px; color: cornsilk; ">YOUR FEEDBACK IS VALUABLE TO US</h1>
            <div class="row" style="margin-top: 5%; padding: 8% 8% 8% 8%;">
              <div class="col" >
                <h3 style="font-size: 30px; font-family: coquette, sans-serif; font-weight: 200; color: cornsilk;" >Getting In Touch Is Easy!</h3><br><br>
                <h4 style="font-size: 20px; font-family: coquette, sans-serif; font-weight: 200; color: cornsilk;">WE GIVE YOUR FAMILY A HOME THEY DREAM OF</h4>
                <br><br><br>
                <a href="https://goo.gl/maps/Wtr1AAVN8xUrPesUA" style="font-size: 20px; font-family: coquette, sans-serif; font-weight: 200;">Find Us Here</a>
                <br><br><br>
                <a href="mailto:ketanarya9999@gmail.com" style="font-size: 20px; font-family: coquette, sans-serif; font-weight: 200;">E-Mail</a>

              </div>
              <div class="col" style="background-color: rgba(0, 0, 0, 0.63); height: 65vh; border-radius: 25px;">
                <form action="" method="post">
                  <div class="form-group">
                    
                    <input type="name" class="form-control" style="font-size: 20px; "  name="name" id="exampleFormControlInput1" placeholder="Full Name">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" style="font-size: 20px; " name="email" id="exampleFormControlInput1" placeholder="Email">
                    
                  </div>
                  <br><br><br>
                  <div class="form-group">
                 
                    <textarea class="form-control" style="font-size: 20px; " name="text" id="exampleFormControlTextarea1" rows="3" placeholder="Tell Us Something"></textarea>
                  </div>
                  <button type="submit" class="btn btn-lg bg-danger" name="submit"  style="float: right; border-radius: 5%; color: cornsilk; font-size: 20px;">Submit</button>
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
              <h4 style="font-size:20px;">New Delhi</h4><br>
              <span>
               <i class="fas fa-3x fa-map-marker-alt" style=" margin-left:50%; margin-right:50%;"></i><span>
              </div>
            </div>
          </div>
      </div></div> 
  </div>
</div>
<style>
      @media (min-width: 576px){
  .modal-dialog {
    max-width: 400px;
    
    .modal-content {
      padding: 1rem;
    }
  }
}

.modal-header {
  .close {
    margin-top: -1.5rem;
  }
}

.form-title {
  margin: -2rem 0rem 2rem;
}

.btn-round {
  border-radius: 3rem;
}

.delimiter {
  padding: 1rem;  
}

.social-buttons {
  .btn {
    margin: 0 0.5rem 1rem;
  }
}

.signup-section {
  padding: 0.3rem 0rem;
}
    </style>
    <script>
      $(document).ready(function() {             $('#loginModal').modal('show');
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});
    </script>
    <div class="modal fade "  style="background-color: #9e0c2c8f;" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"style="background-color: #00cd9ae7;">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body " >
        <div class="form-title text-center">
          <h4 style="color: white; font-size:26px">Login</h4>
        </div>
        <div class="d-flex flex-column text-center">

          <form method="post" action="">
            <div class="form-group" style="margin-top: -15%;" >
              <input type="email" name="email" class="form-control" id="email1" placeholder="Your email address...">
            </div>
            <div class="form-group" style="margin-top: -10%;">
              <input type="password" name="password" class="form-control" id="password1" placeholder="Your password...">
            </div>
            <input type="submit" name="login" value="Login" class="btn btn-info btn-block btn-round"/>
          </form>
          
          <div class="text-center text-muted delimiter">or use a social network</div>
          <div class="d-flex justify-content-center rounded-social-buttons">
          <a class="social-button facebook" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <a class="social-button twitter" href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
          <a class="social-button linkedin" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">Not a member yet? <a href="register.php" class="text-info"> Sign Up</a>.</div>
      </div>
    </div>
  </div>
</div>



    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./js/script.js"></script>
</body>

</html>


