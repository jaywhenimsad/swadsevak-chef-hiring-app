<?php
include('dbconnect.php');

// Fetch all posts from the posts table
$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);
?>

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

    <div class="container mt-3">
        <h3>Approve Posts</h3>
    </div>

    <div class="container mt-3">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Sr. No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Speciality</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date Posted</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <!-- Inside the HTML table where posts are displayed -->
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($post_row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$count}</td>";
                        echo "<td>{$post_row['title']}</td>";
                        echo "<td>{$post_row['description']}</td>";
                        echo "<td>{$post_row['price']}</td>";
                        echo "<td>{$post_row['speciality']}</td>";
                        echo "<td>{$post_row['status']}</td>";
                        echo "<td>{$post_row['date_posted']}</td>";

                        
                        if ($post_row['status'] == 'Pending') {
                            echo "<td>
                                    <form action='approve_post.php' method='post'>
                                        <input type='hidden' name='post_id' value='{$post_row['id']}'>
                                        <button type='submit' class='btn btn-primary'>Approve</button>
                                    </form>
                                </td>";
                        } 
                        else {
                            echo "<td>Approved</td>";
                        }

                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='8'>No previous posts found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
