<?php include("dbconnect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" src="./style.css"></link>
  <title>Login Page</title>
</head>
<body>
  <?php include("nav.php") ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mb-4">Login</h2>

        <?php
          if(isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $errors = array();

            if(empty($email) OR empty($password)) {
              array_push($errors, "Email and Password are required");
            }

            $sql = "SELECT * FROM chef WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if($count == 1) {
              // Login Successful
              session_start(); // Start session to store user information
              $_SESSION['loggedIn'] = true; // Set a session variable to indicate login
              $_SESSION['email'] = $email; // Store user email in session
              // Redirect to index page after successful login
              header('Location: index.php');
              exit; // Exit script after redirection
            } else {
              // Login Failed
              array_push($errors, "Invalid Email/Password combination");
              echo "<p class='alert alert-danger'>".implode('<br>', $errors)."</p>";
            }
          }
        ?>

        <form  method="post">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary" name="login">Login</button>
          <a href="./register.php">Don't have an account? Register Here</a>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
