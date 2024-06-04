<?php
include('dbconnect.php');

// Fetch data from form
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$speciality = $_POST['speciality'];
$chef_name = $_POST['chef_name']; // Fetch chef's name from the form

// Check if chef's name is valid
if (empty($chef_name)) {
    echo "Chef's name is missing.";
    exit;
}

// Assuming 'chef' table has a column named 'name' for chef's name
// Check if the chef exists in the database
$sql = "SELECT chef_id FROM chef WHERE name = '$chef_name'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Chef not found.";
    exit;
}

$row = $result->fetch_assoc();
$chef_id = $row['chef_id']; // Get the chef's ID from the database

// SQL query to insert data into 'posts' table
$sql = "INSERT INTO posts (title, description, price, speciality, chef_id)
        VALUES ('$title', '$description', '$price', '$speciality', '$chef_id')";

if ($conn->query($sql) === TRUE) {
    // Show success message
    echo '<div class="alert alert-success" role="alert">New record created successfully</div>';
    // Redirect back to createpost.php
    header("Location: chefprofile.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
