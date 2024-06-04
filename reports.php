<!-- <?php
// Database configuration
include('dbconnect.php');

// Define queries for each table
$tables = array(
    "admin",
    "auser",
    "booking",
    "chef",
    "feedback",
    "payment",
    "posts"
);

// Initialize variables
$mostPaidChef = "";
$mostVisitedChef = "";
$registeredUsersCount = 0;
$registeredUsersTodayCount = 0;

foreach ($tables as $table) {
    // Count registered users
    if ($table === "auser") {
        $sql = "SELECT COUNT(*) as user_count FROM $table";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $registeredUsersCount = $row['user_count'];
    }

    // Count registered users today
    // if ($table === "auser") {
    //     $today = date("Y-m-d");
    //     $sql = "SELECT COUNT(*) as user_count FROM $table WHER  E DATE(created_at) = '$today'";
    //     $result = $conn->query($sql);
    //     $row = $result->fetch_assoc();
    //     $registeredUsersTodayCount = $row['user_count'];
    // }

    // Find the most paid chef
    if ($table === "chef") {
        $sql = "SELECT chef_id, SUM(amount) as total_amount FROM payment GROUP BY chef_id ORDER BY total_amount DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mostPaidChef = $row['chef_id'];
        }
    }

    // Find the most visited chef
    if ($table === "chef") {
        $sql = "SELECT chef_id, COUNT(*) as visits FROM booking GROUP BY chef_id ORDER BY visits DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mostVisitedChef = $row['chef_id'];
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('adminmenubar.php'); ?>

    <!-- Dashboard Overview -->
    <div class="container mt-3">
        <h3>Dashboard Overview</h3>
        <div class="row">
            <div class="col-md-6">
                <p>Most Paid Chef: <?php echo $mostPaidChef; ?></p>
                <p>Most Visited Chef: <?php echo $mostVisitedChef; ?></p>
            </div>
            <div class="col-md-6">
                <p>Total Registered Users: <?php echo $registeredUsersCount; ?></p>
                <p>Registered Users Today: <?php echo $registeredUsersTodayCount; ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
