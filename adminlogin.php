<?php
// Start the session
session_start();

// Include the database connection file
include("dbconnect.php");

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password for comparison
    $hashed_password = md5($password);

    // SQL query to check if the admin credentials are valid
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if a row is returned
    if(mysqli_num_rows($result) == 1) {
        // Admin login successful, set session variables
        $_SESSION['admin_username'] = $username;

        // Redirect to admin dashboard
        header("location: admindashboard.php");
    } else {
        // Admin login failed, display error message
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Log in page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
     <?php include("nav.php"); ?>
        <div class="container mt-5">
                <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="text-center mb-4">Admin Login</h2>
                    <form id="loginForm" action="adminlogin.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    
                    </form>
                </div>
                </div>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>