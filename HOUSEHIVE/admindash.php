<?php
// Start the session
session_start();
include "connect.php";

// Create the property_list table if it doesn't exist
$c = "CREATE TABLE IF NOT EXISTS property_list (
    
    property_id INT PRIMARY KEY,
    seller_name VARCHAR(255) NOT NULL,
    seller_info VARCHAR(255) NOT NULL,
    property_type VARCHAR(255) NOT NULL,
    property_description TEXT,
    location VARCHAR(255) NOT NULL,
    price VARCHAR(100) NOT NULL,
    approval_status ENUM('Pending', 'Approved') DEFAULT 'Pending'
)";
$res = mysqli_query($con, $c);

if (!$res) {
    echo "Error creating table: " . mysqli_error($con);
}


// Check if the "Approve" button is clicked
if (isset($_POST['approve'])) {
    // Get the property_id from the button click
    $property_id = $_POST['property_id'];

    // Fetch the data from the sell_hive table for the selected property
    $fetch_query = "SELECT * FROM sell_hive WHERE property_id = '$property_id'";
    $fetch_result = mysqli_query($con, $fetch_query);

    if ($fetch_result && mysqli_num_rows($fetch_result) > 0) {
        // Fetch the data for the selected property
        $row = mysqli_fetch_assoc($fetch_result);
        $seller_name = $row['fname'] . ' ' . $row['lname'];
        $seller_info = $row['phone'] . '/' . $row['email'];
      
        $property_type = $row['proptype'];
        $property_description = $row['description'];
        $location = $row['location'];
        $price = $row['price'];
        // Add other variables here for other columns
        
// Insert the fetched data into the property_list table
$insert_query = "INSERT INTO property_list (property_id, seller_name, seller_info, property_type, property_description, location, price, approval_status)
VALUES ('$property_id', '$seller_name', '$seller_info', '$property_type', '$property_description', '$location', '$price', 'Approved')";

$insert_result = mysqli_query($con, $insert_query);
        if ($insert_result) {
            // Data inserted successfully, now delete it from sell_hive
            $delete_query = "DELETE FROM sell_hive WHERE property_id = '$property_id'";
            $delete_result = mysqli_query($con, $delete_query);

            if ($delete_result) {
                echo '<script>alert("Data approved and removed from sell_hive successfully!");</script>';
            } else {
                echo "Error deleting data from sell_hive: " . mysqli_error($con);
            }
        } else {
            echo "Error inserting data into property_list: " . mysqli_error($con);
        }
    } else {
        echo "Error fetching data from sell_hive: " . mysqli_error($con);
    }
}

// Check if the "Reject" button is clicked
if (isset($_POST['reject'])) {
    // Get the property_id from the button click
    $property_id = $_POST['property_id'];

    // Delete the data from the sell_hive table for the selected property
    $delete_query = "DELETE FROM sell_hive WHERE property_id = '$property_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        echo "Data rejected and removed from sell_hive successfully!";
    } else {
        echo "Error deleting data from sell_hive: " . mysqli_error($con);
    }
}




// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Replace 'login.php' with the actual login page URL
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];


// You can fetch data from your admin table or perform other actions here as needed
 $query = "SELECT * FROM admin_users WHERE UserName = '$username'";
 $result = mysqli_query($con, $query);

// Close the database connection when done
// Example: mysqli_close($con);
$query = "SELECT * FROM sell_hive";
$result = mysqli_query($con, $query);


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#dashboard" data-toggle="tab">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#feedback" data-toggle="tab">Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#property-lists" data-toggle="tab">Property Lists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#rent-buy" data-toggle="tab">Renting & Buying Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#user-profile" data-toggle="tab">User Profile Management</a>
            </li>
            
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <?php
                // Check if the username is set in the session
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    echo 'Welcome, ' . $username;
                    echo '</a>';
                }
                ?>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logoutadmin.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Tab Content -->
<div class="container-fluid mt-4">
    <div class="tab-content">
        <!-- Dashboard Tab -->
        <div class="tab-pane active" id="dashboard">
            <!-- Main Content for Dashboard -->
            <!-- Main Content -->
    <div class="container-fluid mt-4">
        <h2>Dashboard</h2>
        <!-- Property Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Seller Name</th>
                    <th>Seller Info</th>
                    <th>Property Type</th>
                    <th>Property Description</th>
                    <th>Photos</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
// Loop through each property and display it in a table row
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['property_id']}</td>";
    echo "<td>{$row['fname']}&nbsp; {$row['lname']}</td>";
    echo "<td>{$row['phone']}/{$row['email']}</td>";
    echo "<td>{$row['proptype']}</td>";
    echo "<td>{$row['description']}</td>";
    echo "<td>";

    // Display photo buttons
    $photoURLs = explode(',', $row['files']);
    $photoURLsImploded = implode(',', $photoURLs);

    echo '<button class="btn btn-info btn-sm view-photos" data-toggle="modal" data-target="#photoModal" data-photo-urls="' . $photoURLsImploded . '">View Photos</button>';

    echo "</td>";
    echo "<td>{$row['location']}</td>";
    echo "<td>{$row['price']}</td>";
    echo '<td>';
    
    // Add the form for approval and rejection
    echo '<form method="post">';
    echo '<input type="hidden" name="property_id" value="' . $row['property_id'] . '">'; // Hidden input to store property ID
    echo '<button type="submit" name="approve" class="btn btn-primary btn-sm">Approve</button>';
    echo '<button type="submit" name="reject" class="btn btn-danger btn-sm">Reject</button>';
    echo '</form>';

    echo '</td>';
    echo "</tr>";
}
?>
</tbody>
        </table>
    </div>

   <!-- Bootstrap Modal -->
<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="photoModalLabel">Photo Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="photoContainer">
                <!-- Photo content will be dynamically added here -->
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS (jQuery and Popper.js required) -->
<script src="/adminscript.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    /* CSS to add space between photos in the modal */
    .modal-body img {
        margin-top: 10px; /* Adjust the spacing as needed */
    }
</style>
<script>
    $(document).ready(function () {
        // Listen for a click on the "View Photos" button
        $('.view-photos').on('click', function () {
            var photoURLs = $(this).data('photo-urls').split(','); // Get the photo URLs as an array
            populateModalWithPhotos(photoURLs);
        });

        // Function to populate the modal with photos
        function populateModalWithPhotos(photoURLs) {
            var photoContainer = $('#photoContainer');
            photoContainer.empty(); // Clear any previous photos

            // Loop through the photo URLs and add them to the modal
            photoURLs.forEach(function (photoURL) {
                var img = $('<img>').attr('src', photoURL).addClass('img-fluid');
                photoContainer.append(img);
            });

            // Show the modal
            $('#photoModal').modal('show');
        }
    });
</script>
        </div>
        
        <!-- Feedback Tab -->
        <div class="tab-pane" id="feedback">
            <!-- Content for Feedback -->
            <div class="tab-pane" id="feedback">
    <div class="container mt-4">
        <h3>Feedback</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Text</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have a database connection established

                // Query to fetch data from the "feedback" table
                $query = "SELECT name, email, text FROM feedback";
                $result = mysqli_query($con, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['text']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Error fetching data: " . mysqli_error($con);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
        </div>
        
        
<!-- Property Lists Tab -->
<div class="tab-pane" id="property-lists">
    <div class="container-fluid mt-4">
        <h3>Property Lists</h3>
        <table id="property-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Seller Name</th>
                    <th>Seller Info</th>
                    <th>Property Type</th>
                    <th>Property Description</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Approval Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Property data will be populated here using PHP -->
                <?php
                // Fetch data from the property_list table
                $query = "SELECT * FROM property_list";
                $result = mysqli_query($con, $query);

                // Initialize an empty array to store property data
                $propertyData = [];

                // Check if there are results
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Extract data from each row and add it to the propertyData array
                        $sellerInfo = "Phone: {$row['seller_info']}";
                        if (!empty($row['email'])) {
                            $sellerInfo .= " / Email: {$row['email']}";
                        } else {
                            $sellerInfo .= " / Email: N/A";
                        }
                        $propertyData[] = [
                            $row['property_id'],
                            $row['seller_name'],
                            $sellerInfo,
                            $row['property_type'],
                            $row['property_description'],
                            $row['location'],
                            $row['price'],
                            $row['approval_status'],
                        ];
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Include DataTables CSS and JavaScript -->
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    // Initialize DataTable
    $(document).ready(function () {
        $('#property-table').DataTable({
            data: <?php echo json_encode($propertyData); ?>,
            columns: [
                { title: 'ID' },
                { title: 'Seller Name' },
                { title: 'Seller Info' },
                { title: 'Property Type' },
                { title: 'Property Description' },
                { title: 'Location' },
                { title: 'Price' },
                { title: 'Approval Status' }
            ],
            "pageLength": 10, // Set the number of rows per page
            "lengthChange": false, // Hide the "Show [x] entries" dropdown
            "searching": true, // Enable searching
            "ordering": true, // Enable column sorting
            "info": true, // Show table info
            "responsive": true // Enable responsive design
        });
    });
</script>

<!-- Rent & Buy Tab -->
<div class="tab-pane" id="rent-buy">
    <div class="container mt-4">
        <h3>Rent & Buy Details</h3>

        <!-- Rent Hive Table -->
        <h4>Rent Hive</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    
                    <th>Description</th>
                    <th>Interested Property</th>
                    <th>Price</th>
                    <th>Agree</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have a database connection established

                // Query to fetch data from the "rent_hive" table
                $rentQuery = "SELECT * FROM rent_hive";
                $rentResult = mysqli_query($con, $rentQuery);

                if ($rentResult) {
                    while ($row = mysqli_fetch_assoc($rentResult)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['firstname']}</td>";
                        echo "<td>{$row['lastname']}</td>";
                        echo "<td>{$row['rentemail']}</td>";
                        echo "<td>{$row['country']}</td>";
                        echo "<td>{$row['city']}</td>";
                        
                        echo "<td>{$row['rentdescription']}</td>";
                        echo "<td>{$row['intrestedproperty']}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "<td>{$row['agree']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Error fetching rent data: " . mysqli_error($con);
                }
                ?>
            </tbody>
        </table>

        <!-- Buy Hive Table -->
        <h4>Buy Hive</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Interested Property</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to fetch data from the "buy_hive" table
                $buyQuery = "SELECT * FROM buy_hive";
                $buyResult = mysqli_query($con, $buyQuery);

                if ($buyResult) {
                    while ($row = mysqli_fetch_assoc($buyResult)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['fname']}</td>";
                        echo "<td>{$row['lname']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['description']}</td>";
                        echo "<td>{$row['intrestedproperty']}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Error fetching buy data: " . mysqli_error($con);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
function displayUsers($con)
{
    $query = "SELECT * FROM Users";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['userid'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '<td><button class="btn btn-danger delete-user" data-user-id="' . $row['userid'] . '">Delete</button></td>';
            echo '</tr>';
        }
    }
}


?>


        
        <!-- User Profile Tab -->
        <div class="tab-pane" id="user-profile">
            <!-- User Table -->
    <div class="container mt-4">
        <h2>User List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php displayUsers($con); ?>
            </tbody>
        </table>
    </div>
            
        </div>
        <script>
    $(document).ready(function () {
        // Handle user deletion when the "Delete" button is clicked
        $('.delete-user').on('click', function () {
            var userId = $(this).data('user-id');
            if (confirm("Are you sure you want to delete this user?")) {
                // Send an AJAX request to delete the user
                $.ajax({
                    url: 'delete_user.php', // Create a separate PHP file for user deletion logic
                    type: 'POST',
                    data: { userId: userId },
                    success: function (response) {
                        if (response === 'success') {
                            // User deleted successfully, remove the row from the table
                            $(this).closest('tr').remove();
                        } else {
                            alert("Failed to delete user: " + response);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error deleting user: " + error);
                    }
                });
            }
        });
    });
</script>
    </div>
</div>

<script>$(document).ready(function() {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        // Code to handle tab change, if needed
    });
});</script>

    
</body>
</html>
