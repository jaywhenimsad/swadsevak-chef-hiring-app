<?php
// Include database connection
include('dbconnect.php');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the request is made using POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the request
    $email = $_SESSION['email']; // Assuming user email is stored in session
    $postId = $_POST['post_id'];

    // Check if the user has already made a booking on the selected post
    $existing_booking_query = "SELECT * FROM booking WHERE email='$email' AND post_id=$postId";
    $existing_booking_result = mysqli_query($conn, $existing_booking_query);
    if (mysqli_num_rows($existing_booking_result) > 0) {
        // If the user has already made a booking on the selected post, display a message or handle as needed
        echo "You have already made a booking on this post.";
    } else {
        // Insert data into the booking table
        $sql = "INSERT INTO booking (email, post_id, status) VALUES ('$email', '$postId', 'pending')";

        // Execute the SQL query
        if (mysqli_query($conn, $sql)) {
            echo 'success';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Invalid request method";
}

