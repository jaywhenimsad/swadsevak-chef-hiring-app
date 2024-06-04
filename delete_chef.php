<?php
// Include the database connection file
include('dbconnect.php');

// Check if Chef ID is provided in the URL
if(isset($_GET['chef_id'])) {
    // Retrieve Chef ID from URL parameter
    $chef_id = $_GET['chef_id'];

    // Prepare and execute SQL query to delete the chef
    $sql = "DELETE FROM chef WHERE chef_id = $chef_id";
    if(mysqli_query($conn, $sql)) {
        // If deletion is successful, redirect back to managechefs.php
        header("Location: manageusers.php");
        exit();
    } else {
        // If deletion fails, display an error message
        echo "Error deleting chef: " . mysqli_error($conn);
    }
} else {
    // If Chef ID is not provided, display an error message
    echo "Chef ID not provided";
}

// Close database connection
mysqli_close($conn);

