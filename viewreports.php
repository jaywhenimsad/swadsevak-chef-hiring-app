<?php
// Database configuration
include('dbconnect.php');

// Define queries for each table
$tables= array(
    // "admin" => "SELECT * FROM admin",
    "auser" => "SELECT * FROM auser",
    "booking" => "SELECT * FROM booking",
    "chef" => "SELECT * FROM chef",
    "feedback" => "SELECT * FROM feedback",
    "payment" => "SELECT * FROM payment",
    "posts" => "SELECT * FROM posts"
);


$data = array();

foreach ($tables as $tableName => $query) {
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch data from each table
        while ($row = $result->fetch_assoc()) {
            // Store data into the $data array with the table name as key
            $data[$tableName][] = $row;
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
        <h3>Data from Database Tables</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Table Name</th>
                        <th>Table Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $tableName => $rows): ?>
                        <tr>
                            <td><?php echo $tableName; ?></td>
                            <td>
                                <table class="table">
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <?php foreach ($row as $key => $value): ?>
                                                <td><?php echo $value; ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include('reports.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
