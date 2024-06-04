<?php
include('dbconnect.php');

// Fetch all posts from the posts table
$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the post_id is set and not empty
    if (isset($_POST['post_id']) && !empty($_POST['post_id'])) {
        $post_id = $_POST['post_id'];

        // Update the status of the post to 'approved' in the posts table
        $sql = "UPDATE posts SET status = 'approved' WHERE id = $post_id";

        if (mysqli_query($conn, $sql)) {
            // If the query is successful, redirect back to the admin dashboard or any desired page
            header("Location: approveposts.php");
            exit();
        } else {
            // If there's an error with the query, display an error message
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // If post_id is not set or empty, display an error message
        echo "Post ID is missing.";
    }
} else {
    // If the request method is not POST, redirect to the admin dashboard or any desired page
    header("Location: approveposts.php");
    exit();
}

