<?php include('dbconnect.php'); ?>
<?php
include('dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $speciality = $_POST['speciality'];
    $chef_name = $_POST['chef_name'];

    // Check if chef name is valid
    if (empty($chef_name)) {
        echo "Chef's name is required.";
        exit;
    }

    // Check if the chef exists
    $sqlChef = "SELECT chef_id FROM chef WHERE name='$chef_name'";
    $resultChef = mysqli_query($conn, $sqlChef);
    
    if (mysqli_num_rows($resultChef) == 0) {
        echo "Chef not found.";
        exit;
    }
    
    $rowChef = mysqli_fetch_assoc($resultChef);
    $chef_id = $rowChef['chef_id'];

    // SQL query to update post data
    $sql = "UPDATE posts SET title='$title', description='$description', price='$price', speciality='$speciality' WHERE chef_id='$chef_id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: chefprofile.php");
    } else {
        echo "Error updating post data: " . $conn->error;
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chef's Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <?php include("nav.php"); ?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center">Create Post</h2>
            <form action="edit_post.php" method="post">
            <div class="mb-3">
                <label for="chef_name" class="form-label">Chef's Name:</label>
                <input type="text" class="form-control" id="chef_name" name="chef_name" required>
            </div>
              <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
              </div>
              <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" class="form-control" id="price" name="price" required>
              </div>
              <div class="mb-3">
                <label for="speciality" class="form-label">Speciality:</label>
                <input type="text" class="form-control" id="speciality" name="speciality" required>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
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
