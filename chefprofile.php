<?php
include('dbconnect.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = $_SESSION['email']; // Retrieve user email from session

// Retrieve chef's information from the database based on the email
$sqlChef = "SELECT * FROM chef WHERE email='$email'";
$resultChef = mysqli_query($conn, $sqlChef);
$rowChef = mysqli_fetch_assoc($resultChef);
$chefId = $rowChef['chef_id'];

// Fetch all posts made by the logged-in chef
$sqlPosts = "SELECT * FROM posts WHERE chef_id='$chefId'";
$resultPosts = mysqli_query($conn, $sqlPosts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         .table {
            width: 100%;
        }
        .table td, .table th {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px; /* Adjust the max-width as needed */
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>
    <?php include("nav.php") ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="logo-container">
                        <!-- Chef's Information -->
                        <div>
                            <p><strong>Name:</strong> <?php echo $rowChef['name']; ?></p>
                            <p><strong>Email:</strong> <?php echo $rowChef['email']; ?></p>
                            <p><strong>Address:</strong> <?php echo $rowChef['address']; ?></p>
                            <p><strong>Mobile:</strong> <?php echo $rowChef['mobile']; ?></p>
                            <!-- Add other chef information here -->
                        </div>
                        <!-- Logo -->
                        <img src="./images/logo2.png" alt="Pizza Logo" class="logo ms-3">
                    </div>
                <!-- Create Post Button -->
                <a href="createpost.php" class="btn btn-primary mb-3">Create Post</a>
                <a href="editprofilechef.php" class="btn btn-success mb-3">Edit Profile</a>
                <a href="viewrequests.php" class="btn btn-info mb-3">View Requests</a>
                <!-- Table for Previous Posts -->
                <h3>Previous Posts</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Speciality</th>
                            <th>Status</th>
                            <th>Date Posted</th>
                            <th>Request</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(mysqli_num_rows($resultPosts) > 0) {
                            $count = 1;
                            while($post_row = mysqli_fetch_assoc($resultPosts)) {
                                echo "<tr>";
                                echo "<td>{$count}</td>";
                                echo "<td>{$post_row['title']}</td>";
                                echo "<td>{$post_row['description']}</td>";
                                echo "<td>{$post_row['price']}</td>";
                                echo "<td>{$post_row['speciality']}</td>";
                                echo "<td>{$post_row['status']}</td>";
                                echo "<td>{$post_row['date_posted']}</td>";
                                echo "<td>";
                                echo "<a href='edit_post.php?id={$post_row['id']}' class='btn btn-primary'>Edit</a>";
                                echo "<a href='delete_post.php?id={$post_row['id']}' class='btn btn-danger ms-2'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='8'>No previous posts found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
