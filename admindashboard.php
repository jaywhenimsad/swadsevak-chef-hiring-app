<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h3{
            border-bottom-style: solid;
            border-color: black;
        }
        h4{
            margin: auto;
            padding: 4px;

        }
    </style>
</head>
<body>
    <?php include('adminmenubar.php'); ?>

    <!-- Dashboard Overview -->
    <div class="container mt-3">
        <h3>Dashboard Overview</h3>

        <!-- Include summary statistics or metrics here -->
    </div>

    <!-- Main Content Area -->
    <div class="container mt-3">
    <h4>Feedback Messages</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include database connection
            include("dbconnect.php");

            // Select all data from 'feedback' table
            $sql = "SELECT name, email, message FROM feedback";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["message"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No feedback messages found.</td></tr>";
            }

            // Close database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
