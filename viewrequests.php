<?php
// Include database connection
include('dbconnect.php');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Retrieve chef's information from the session
$email = $_SESSION['email'];

// Fetch pending and confirmed booking requests associated with the current chef
$sql = "SELECT booking.*, posts.title AS post_title, auser.name AS user_name, auser.email AS user_email
        FROM booking
        INNER JOIN posts ON booking.post_id = posts.id
        INNER JOIN auser ON booking.email = auser.email
        WHERE posts.chef_id = (SELECT chef_id FROM chef WHERE email = '$email')
        AND booking.status IN ('pending', 'confirmed')";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booking Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("nav.php") ?>

    <div class="container">
        <h2 class="mt-3">Booking Requests</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Post Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['user_name']}</td>";
                        echo "<td>{$row['user_email']}</td>";
                        echo "<td>{$row['post_title']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "<td>";
                        // Display "Approve" button only if status is "pending"
                        if ($row['status'] == 'pending') {
                            echo "<a href='approve_booking.php?id={$row['booking_id']}' class='btn btn-success'>Approve</a>";
                        }
                        // Display "Cancel" button for both "pending" and "confirmed" status
                        echo "<a href='cancel_booking(1).php?id={$row['booking_id']}' class='btn btn-danger ms-2'>Cancel</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
