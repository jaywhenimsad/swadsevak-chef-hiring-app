<?php include("dbconnect.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="height: 80px;">
        <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
            <img src="./images/logo.jpg" alt="Your Logo" style="border-radius: 5px;">
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./chef.php">Chef's</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login/Register
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./login.php">Log In</a></li>
                            <li><a class="dropdown-item" href="./register.php">Register</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./adminlogin.php">Admin Log In</a></li>
                        </ul>
                    </li>

                    <?php
                    // Check if the user is logged in
                   
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
                        echo '<li class="nav-item">
                                  <a class="nav-link" href="./logout.php">Log Out</a>
                              </li>';

                        // Determine user type and redirect accordingly
                        if($_SESSION['userType'] === 'user') {
                            echo '<li class="nav-item">
                                      <a class="nav-link" href="./profile.php">
                                         <img src="./images/logo1.png" />
                                      </a>
                                  </li>';
                        } elseif ($_SESSION['userType'] === 'chef') {
                            echo '<li class="nav-item">
                                      <a class="nav-link" href="./chefprofile.php">Chef Profile</a>
                                  </li>';
                        }
                    }
                    ?>
                </ul>
                <form action="filtered_chef.php" class="d-flex" method="GET" role="search">
                    <input class="form-control me-2" type="search" name="location" placeholder="Search Location" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</body>
</html>
