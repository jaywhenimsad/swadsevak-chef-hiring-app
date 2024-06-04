<?php
// Include the database connection file
include("dbconnect.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Retrieve user data from the database based on the email stored in the session
$email = $_SESSION['email'];
$sql = "SELECT * FROM auser WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    // User found, fetch user data
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $mobile = $row['mobile'];
    $address = $row['address'];
    // You can fetch other user data similarly
} else {
    // User not found or multiple users found (which should not happen)
    // Redirect to the login page
    header('Location: login.php');
    exit;
}

// Fetch bookings for the current user along with associated post, chef details, and payment status
$booking_query = "SELECT DISTINCT booking.booking_id, booking.status, posts.description, posts.price, chef.name AS chef_name, payment.status AS payment_status
                  FROM booking 
                  INNER JOIN posts ON booking.post_id = posts.id
                  INNER JOIN chef ON posts.chef_id = chef.chef_id
                  LEFT JOIN payment ON booking.booking_id = payment.booking_id
                  WHERE booking.email='$email'";
$booking_result = mysqli_query($conn, $booking_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("nav.php") ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">User Profile</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="logo-container">
                        <!-- User Information -->
                        <div>
                            <p><strong>Name:</strong> <?php echo $name; ?></p>
                            <p><strong>Mobile:</strong> <?php echo $mobile; ?></p>
                            <p><strong>Address:</strong> <?php echo $address; ?></p>
                            <!-- Display other user data as needed -->
                        </div>
                        <!-- Logo -->
                        <img src="./images/logo2.png" alt="Pizza Logo" class="logo ms-3">
                    </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h3>Bookings</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Chef Name</th>
                            <th>Post Description</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($booking_row = mysqli_fetch_assoc($booking_result)) {
                            echo "<tr>";
                            echo "<td>{$booking_row['booking_id']}</td>";
                            echo "<td>{$booking_row['chef_name']}</td>";
                            echo "<td>{$booking_row['description']}</td>";
                            echo "<td>{$booking_row['price']}</td>";
                            echo "<td>{$booking_row['status']}</td>";
                            echo "<td>{$booking_row['payment_status']}</td>";
                            echo "<td>";
                            if ($booking_row['status'] == 'confirmed') {
                                echo "<button class='btn btn-primary make-payment-btn' data-booking-id='{$booking_row['booking_id']}'>Make Payment</button>";
                            } elseif ($booking_row['status'] == 'pending') {
                                echo "<button class='btn btn-danger cancel-btn' data-booking-id='{$booking_row['booking_id']}'>Cancel</button>";
                            } else {
                                // For other status, display nothing or appropriate message
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add event listener to handle make payment button click
        document.querySelectorAll('.make-payment-btn').forEach(button => {
            button.addEventListener('click', function() {
                const bookingId = this.dataset.bookingId;

                // Redirect to payment page or handle payment process as per your requirement
                // Example:
                window.location.href = 'payment.php?booking_id=' + bookingId;
            });
        });

        // Add event listener to handle cancel button click
        document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', function() {
                const bookingId = this.dataset.bookingId;

                // Send AJAX request to cancel booking
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'cancel_booking.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Check if the response text is 'success'
                        if (xhr.responseText.trim() === 'success') {
                            // Handle success response
                            alert('Booking canceled successfully');
                            // Optionally, remove the canceled booking row from the table
                            button.closest('tr').remove();
                        } else {
                            // Handle error response from cancel_booking.php
                            alert(xhr.responseText);
                        }
                    } else {
                        // Handle error response
                        alert('Error: ' + xhr.statusText);
                    }
                };
                xhr.send('booking_id=' + bookingId);
            });
        });
    </script>
</body>
</html>
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