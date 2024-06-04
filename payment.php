<?php
// Include database connection
include('dbconnect.php');

// Retrieve booking ID from query parameters
$bookingId = $_GET['booking_id'];

// Retrieve booking details from the database based on the booking ID
// Implement SQL query to fetch booking details and user information
$sql = "SELECT booking.*, auser.name AS user_name, auser.mobile AS user_mobile, auser.address AS user_address, 
        posts.title AS post_title, posts.description AS post_description, posts.price AS post_price 
        FROM booking 
        INNER JOIN auser ON booking.email = auser.email 
        INNER JOIN posts ON booking.post_id = posts.id 
        WHERE booking.booking_id = '$bookingId'";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Fetch the booking details and user information
    $bookingData = mysqli_fetch_assoc($result);

    // Extract post price from the fetched data
    $postPrice = $bookingData['post_price'];

    // You can use $postPrice to display the post price in the HTML form
} else {
    // Handle error if the query fails
    echo "Error fetching booking details: " . mysqli_error($conn);
}

// Define default payment method
$defaultPaymentMethod = 'cash';

// Process payment form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle payment processing
    // Implement payment processing logic here

    // If payment is successful, update booking status in the database
    // Update booking status to indicate that payment has been made
    // Example SQL query: UPDATE booking SET status = 'paid' WHERE booking_id = $bookingId

    // Insert payment details into payment table
    $fullAmount = $_POST['full_amount'];
    $paymentMethod = $_POST['payment_method'];

    // Example SQL query to insert payment details
    $insertPaymentQuery = "INSERT INTO payment (booking_id, amount, payment_method, status)
                           VALUES ('$bookingId', '$fullAmount', '$paymentMethod', 'paid')";

    if (mysqli_query($conn, $insertPaymentQuery)) {
        // Payment successfully inserted into payment table
        // Update booking status to 'paid' in booking table (if needed)
        $updateBookingQuery = "UPDATE booking SET status = 'paid' WHERE booking_id = '$bookingId'";
        if (mysqli_query($conn, $updateBookingQuery)) {

            echo "<script>alert('Payment Is Successful'); window.location.href = 'profile.php';</script>";
            exit;
            // Booking status successfully updated
        } else {
            echo "Error updating booking status: " . mysqli_error($conn);
        }
    } else {
        // Error occurred while inserting payment details
        echo "Error inserting payment details: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Payment Details</h2>
        <form method="post" action="" class="needs-validation" novalidate>
            <!-- Display booking details, user information, and payment amount -->
            <!-- Replace placeholders with actual data retrieved from the database -->
            <div class="mb-3">
                <label for="booking_id" class="form-label">Booking ID:</label>
                <input type="text" class="form-control" id="booking_id" name="booking_id" value="<?php echo $bookingId; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $postPrice; ?>" readonly>
            </div>
            <!-- Payment form -->
            <div class="mb-3">
                <label for="full_amount" class="form-label">Full Amount:</label>
                <input type="text" class="form-control" id="full_amount" name="full_amount" required>
                <div class="invalid-feedback">Please enter the full amount.</div>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method:</label>
                <select class="form-select" id="payment_method" name="payment_method">
                    <option value="cash" selected>Cash</option>
                    <!-- Add other payment method options here -->
                </select>
            </div>
            <!-- Pay button -->
            <button type="submit" class="btn btn-primary">Pay</button>
        </form>
        <!-- Handle payment form submission -->
    </div>

    <!-- Bootstrap JS (optional, for certain Bootstrap components that require JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to add form validation using Bootstrap's built-in validation classes
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
    </script>
</body>
</html>
