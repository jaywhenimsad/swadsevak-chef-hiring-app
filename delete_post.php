<?php
include('dbconnect.php');

// Check if the post ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the post ID to prevent SQL injection
    $post_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // SQL query to delete the post with the provided ID
    $sql = "DELETE FROM posts WHERE id = '$post_id'";
    
    // Execute the query
    if(mysqli_query($conn, $sql)) {
        // Post deleted successfully, redirect back to the chef's profile page
        header('Location: chefprofile.php');
        exit;
    } else {
        // Error occurred while deleting the post
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // No post ID provided in the URL, redirect back to the chef's profile page
    header('Location: chefprofile.php');
    exit;
}
