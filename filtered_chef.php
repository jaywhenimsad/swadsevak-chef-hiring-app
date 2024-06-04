
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Filtered Chef</title>
</head>
<body>
    <?php include('nav.php'); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

<?php
// Include dbconnect.php for database connection

include('dbconnect.php');

// Check if a location search query is submitted
if(isset($_GET['location'])) {
    // Sanitize the search query
    $search_location = mysqli_real_escape_string($conn, $_GET['location']);

    // Prepare and execute SQL query to search for chefs based on location
    $sql = "SELECT chef.*, posts.speciality, posts.title, posts.price, posts.id AS post_id FROM chef 
            INNER JOIN posts ON chef.chef_id = posts.chef_id 
            WHERE chef.address LIKE '%$search_location%' AND posts.status = 'approved'
            ORDER BY chef.address";
    $result = mysqli_query($conn, $sql);

    // Display search results in table format
    if(mysqli_num_rows($result) > 0) {
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Chef Search Results</title>";
        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>";
        echo "<style>";
        echo "/* Optional: Add some basic table styling */";
        echo "table {";
        echo "  width: 100%;";
        echo "  table-layout: fixed; /* Ensures columns have equal width */";
        echo "}";
        echo "th {";
        echo "  text-align: left; /* Align headers to the left */";
        echo "}";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container mt-3'>";
        echo "<h2>Chef Search Results</h2>";
        echo "<table class='table table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Chef ID</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Address</th>";
        echo "<th>Speciality</th>";
        echo "<th>Title</th>";
        echo "<th>Price</th>";
        echo "<th>Action</th>"; // Added action column
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Display search results
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['chef_id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['speciality']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['price']}</td>";
            
            // Check if user is logged in
            if (isset($_SESSION['loggedIn'])) {
                // If user is logged in, show 'Book' button
                echo "<td><button type='button' class='btn btn-sm btn-success book-btn' data-id='{$row['post_id']}'> Book </button></td>";
            } else {
                // If user is not logged in, show 'Login to Book' button
                echo "<td><a href='login.php' class='btn btn-sm btn-primary'>Login to Book</a></td>";
            }

            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        // Display message if no chefs match the search query
        echo "No chefs found with the specified location.";
    }
} else {
    // Display message if no search query is provided
    echo "Please enter a location to search.";
}

// Close database connection
mysqli_close($conn);
?>
<script>
    // Add event listener to handle book button click
    document.querySelectorAll('.book-btn').forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.dataset.id;

            // Send AJAX request to book.php
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'book.php');
            
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log('XHR status:', xhr.status);
                if (xhr.status === 200) {
                    // Check if the response text is 'success'
                    if (xhr.responseText.trim() === 'success') {
                        // Handle success response
                        alert('Booking request sent successfully'); // Display success message
                        // Update button text to 'Request Sent'
                        button.textContent = 'Request Sent';
                        button.classList.remove('btn-success');
                        button.classList.add('btn-secondary');
                        button.disabled = true;
                    } else {
                        // Handle error response from book.php
                        alert(xhr.responseText); // Display error message returned by book.php
                    }
                } else {
                    // Handle error response
                    alert('Error: ' + xhr.statusText);
                }
            };
            xhr.send('post_id=' + postId);
        });
    }); 
</script>

