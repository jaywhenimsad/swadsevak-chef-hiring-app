<?php
include('dbconnect.php');
if (session_status() === PHP_SESSION_NONE) {
  session_start();
} // Start the session to access user_type

// Fetch all approved posts with the chef's name and address
$sql = "SELECT posts.*, chef.name, chef.address FROM posts INNER JOIN chef ON posts.chef_id = chef.chef_id WHERE posts.status = 'approved'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Approved Posts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Optional: Add some basic table styling */
    table {
      width: 100%;
      table-layout: fixed; /* Ensures columns have equal width */
    }
    th {
      text-align: left; /* Align headers to the left */
    }
  </style>
</head>
<body>
  <div class="container mt-3">
    <h2>Chef List</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Title</th>
          <th>Description</th>
          <th>Speciality</th>
          <th>Price</th>
          <th>Chef Name</th>
          <th>Chef Address</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      if (mysqli_num_rows($result) > 0) {
        $count = 1;
        while ($post_row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>{$count}</td>";
          echo "<td>{$post_row['title']}</td>";
          echo "<td>{$post_row['description']}</td>";
          echo "<td>{$post_row['speciality']}</td>";
          echo "<td>{$post_row['price']}</td>";
          echo "<td>{$post_row['name']}</td>"; // Updated to use 'name' column
          echo "<td>{$post_row['address']}</td>"; // Updated to use 'address' column

          // Check if user is logged in
          if (isset($_SESSION['loggedIn'])) {
            // If user is logged in, show 'Book' button
            echo "<td><button type='button' class='btn btn-sm btn-success book-btn' data-id='{$post_row['id']}'> Book </button></td>";
          } else {
            // If user is not logged in, show 'Login to Book' button
            echo "<td><a href='login.php' class='btn btn-sm btn-primary'>Login to Book</a></td>";
          }

          echo "</tr>";
          $count++;
        }
      } else {
        echo "<tr><td colspan='7'>No approved posts found.</td></tr>";
      }
      ?>
    </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-Ogwbqwo1XmJhANw6n0TprCMeDK8lELC8VDvxyRbM8PWvpbzE5gTOHdqwjDmhdyZXe" crossorigin="anonymous"></script>
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

</body>
</html>
