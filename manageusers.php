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
    </style>
</head>
<body>
    <?php include('adminmenubar.php'); ?>

    <!-- Dashboard Overview -->
    <div class="container mt-3">
        <h3>Manage Users</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include('dbconnect.php');

                // Fetch all users from the 'auser' table
                $sql = "SELECT * FROM auser";
                $result = mysqli_query($conn, $sql);

                // Check if any users exist
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td><button class='btn btn-danger' onclick='deleteUser({$row['id']})'>Delete User</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to delete user
        function deleteUser($id) {
            // Confirm deletion
            if(confirm("Are you sure you want to delete this user?")) {
                // Redirect to delete_user.php with user ID parameter
                window.location = "delete_user.php?id=" + $id;
            }
        }
    </script>

    <!-- //managing chef' -->

    <div class="container mt-3">
        <h3>Manage Chefs</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Chef ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include('dbconnect.php');

                // Fetch all chefs from the 'chef' table
                $sql = "SELECT * FROM chef";
                $result = mysqli_query($conn, $sql);

                // Check if any chefs exist
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['chef_id']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td><button class='btn btn-danger' onclick='deleteChef({$row['chef_id']})'>Delete Chef</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No chefs found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to delete chef
        function deleteChef(chef_id) {
    // Confirm deletion
            if(confirm("Are you sure you want to delete this chef?")) {
                // Redirect to delete_chef.php with chef ID parameter
                window.location = "delete_chef.php?chef_id=" + chef_id;

            }
        }

    </script>
</body>
</html>
