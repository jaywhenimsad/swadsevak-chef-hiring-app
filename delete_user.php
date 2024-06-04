<?php
// Include the database connection file
include('dbconnect.php');

// Check if user ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the user ID
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL query to delete the user with the provided ID
    $sql = "DELETE FROM auser WHERE id = '$id'";

    if(mysqli_query($conn, $sql)) {
        // Deletion successful
        echo "User deleted successfully.";
        // Redirect to manageusers.php after deletion
        header( 'Location: manageusers.php' ) ;
        
        exit;
    } else {
        // Error in deletion
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    // User ID not provided in the URL
    echo "User ID not provided.";
}

