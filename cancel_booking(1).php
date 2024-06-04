<?php
// Include database connection
include('dbconnect.php');

// Check if the request is made using GET method
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Retrieve booking ID from the request
    $bookingId = $_GET['id'];

    // Validate booking ID
    if (!is_numeric($bookingId) || $bookingId <= 0) {
        echo "Invalid booking ID";
        exit; // Stop further execution
    }

    // Perform cancellation by updating the status of the booking to 'cancelled'
    $update_query = "UPDATE booking SET status = 'cancelled' WHERE booking_id = $bookingId";
    if (mysqli_query($conn, $update_query)) {
        header("Location: chefprofile.php");
        exit;
    } else {
        // Error during cancellation
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}
