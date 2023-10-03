<?php
include "connect.php"; // Include your database connection file

// Create the admin_users table if it doesn't exist
$s = "CREATE TABLE IF NOT EXISTS admin_users (
    Admin_Id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserName VARCHAR(200) DEFAULT NULL,
    Password VARCHAR(200) DEFAULT NULL,
    Contact BIGINT(10) DEFAULT NULL,
    Email VARCHAR(200) DEFAULT NULL,
    Position VARCHAR(200) DEFAULT NULL
)";
$res = mysqli_query($con, $s);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $position = $_POST["position"];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Create the admin user in the database
    $query = "INSERT INTO admin_users (UserName, Password, Contact, Email, Position) 
              VALUES ('$username', '$hashedPassword', '$contact', '$email', '$position')";
    
    if (mysqli_query($con, $query)) {
        // User creation successful, redirect to admindash.php
        header("Location: admindash.php");
        exit();
    } else {
        // Error handling
        echo "Error: " . mysqli_error($con);
    }
    
    // Close the database connection
    mysqli_close($con);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query to fetch the user's data
    $query = "SELECT * FROM admin_users WHERE UserName = '$username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the hashed password
        if (password_verify($password, $row["Password"])) {
            // Password is correct, store user data in session
            $_SESSION["user_id"] = $row["Admin_Id"];
            $_SESSION["username"] = $row["UserName"];

            // Redirect to the admin dashboard
            header("Location: admindash.php");
            exit();
        } else {
            // Incorrect password
            $loginError = "Incorrect username or password";
        }
    } else {
        // User not found
        $loginError = "User not found";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin User</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<script>
    // Disable Back and Forward buttons
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });
</script>
<body style="background-color:black">
<div class="container text-white bg-danger" style="margin-top:10%; border-radius:8px">
    <div class="row">
        <div class="col-md-6">
            <div class="container mt-4">
                <h2>Login Admin User</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                    <?php if (isset($loginError)) { ?>
                        <p class="text-danger"><?php echo $loginError; ?></p>
                    <?php } ?>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="container mt-5">
                <h2>Admin User Registration</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact:</label>
                        <input type="tel" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
<!-- Include Bootstrap JS (jQuery and Popper.js required) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
