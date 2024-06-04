<?php
include('dbconnect.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    
    // Sanitize form inputs to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $address = mysqli_real_escape_string($conn, $address);
    
    // Update chef data in the database
    $sql = "UPDATE chef SET name='$name', email='$email', mobile='$mobile', address='$address' WHERE email='$email'";
    
    if (mysqli_query($conn, $sql)) {
        // Chef data updated successfully
        header("Location: chefprofile.php");
    } else {
        // Error occurred while updating chef data
        echo "Error updating chef data: " . mysqli_error($conn);
    }
}

// Fetch chef data from the database based on session email
$email = $_SESSION['email'];
$sql = "SELECT * FROM chef WHERE email='$email'";
$result = mysqli_query($conn, $sql);

// Check if chef data exists
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $address = $row['address'];
} else {
    // Chef data not found or multiple chefs found (which should not happen)
    echo "Chef data not found.";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include("nav.php"); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Edit Profile</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile:</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <textarea class="form-control" id="address" name="address" rows="4" required><?php echo $address; ?></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
