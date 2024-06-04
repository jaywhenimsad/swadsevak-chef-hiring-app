<?php include("dbconnect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" src="./style.css"></link>
    <title>Register Page</title>
</head>
<body>
             <?php include("nav.php") ?>
        
            <div class="container mt-5">
            <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Register</h2>
                 <?php
                    if(isset( $_POST["submit"])){
                        
                        $name = $_POST["username"]; 
                        $email = $_POST["email"];
                        $mobile = $_POST["mobile"];
                        $address = $_POST["address"];
                        $password = $_POST["password"];
                        $cpassword = $_POST["confirmPassword"];
                        $errors = array();
                        if(empty($name) OR empty($email) OR empty($mobile) OR empty($address) OR empty($password) OR empty($cpassword)){
                            array_push($errors, "all the fields are empty");
                        }
                        if(strlen($password)<8){
                            array_push($errors,"password should be of min. 8 character");
                        }
                        if($password!==$cpassword){
                            array_push($errors, "Password is not matching");
                        }

                       $sql = "INSERT INTO chef(chef_id, name , email , mobile, address, password, cpassword) VALUES (NULL, '$name', '$email', '$mobile', '$address', '$password', '$cpassword')";
                      if(mysqli_query($conn,$sql))
                      {
                        echo"connected.";
                        header("location: login.php");
                      }
                      else
                      echo"Not.";
                       
                    }
                   ?>
                <form  method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="tel" pattern="[0-9]{10}" class="form-control" id="mobile" name="mobile" aria-describedby="mobileHelp" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" aria-describedby="addressHelp" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Register</button>
                <a href="./login.php">already have an account ?</a>
                </form>
            </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>