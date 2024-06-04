<?php
// Include database connection
include('dbconnect.php');

// Check if the request is made using POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve booking ID from the request
    $bookingId = $_POST['booking_id'];

    // Validate booking ID
    if (!is_numeric($bookingId) || $bookingId <= 0) {
        echo "Invalid booking ID";
        exit; // Stop further execution
    }

    // Perform cancellation by updating the status of the booking to 'cancelled'
    $update_query = "UPDATE booking SET status = 'cancelled' WHERE booking_id = $bookingId";
    if (mysqli_query($conn, $update_query)) {
        // Cancellation successful
        echo "success";
    } else {
        // Error during cancellation
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}

