<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Swadsevak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .hero {
            position: relative;
            overflow: hidden;
        }
        .hero img {
            width: 100%;
            height: auto;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .about-us {
            background-color: #f8f9fa;
            padding: 50px 20px;
            border-radius: 12px;
        }
        .about-us h2 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .about-us p {
            font-size: 18px;
            line-height: 1.6;
            color: #333;

        }
        .FAQ {
            background-color: #f3f4f6;
            padding: 50px 20px;
            border-radius: 12px;

        }
        .FAQ h4 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .FAQ ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .FAQ li {
            margin-bottom: 10px;
        }
        .contact {
            background-color: #f8f9fa;
            padding: 50px 20px;
            border-radius: 12px;

        }
        .contact h5 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .contact form {
            max-width: 500px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
            border-radius: 12px;

        }
        .contact input,
        .contact textarea {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .contact button {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <?php include("nav.php"); ?>

    <div class="hero">
        <?php include("slider.php"); ?>
    </div>

    <div class="container">
        <h1>Welcome To Swadsevak!</h1>
    </div>

    <div class="container about-us">
        <h2>About Us</h2>
        <p>
            Swadsevak (स्वादसेवक) is a platform that connects people with skilled chefs who can cook delicious and authentic meals.
            We aim to make it easier for people to find great food and for chefs to showcase their culinary talents.
            Our mission is to celebrate the diversity of Indian cuisine and to make it accessible to everyone.
        </p>
    </div>

    <div class="container FAQ">
        <h4>FAQ's</h4>
        <ul>
            <li><b>What kind of chefs can I find on Swadsevak?</b></li>
            <li>On Swadsevak, you can find chefs with a wide range of experience and expertise, from home cooks to professional chefs.</li>
            <li><b>How do I Book a chef?</b></li>
            <li>step 1: Go to 'Chef' or 'Search' Location based on location You're Reciding
                In.<br/>
                step 2: click on to the 'book' tab and if not logged in, log in and 'book'<br/>
                step 3: wait while the request is accepted by the chef and when the request is 'confirmed' Make payment.
            </li>
            <li><b>How much does it cost to book a chef?</b></li>
            <li>well, it's based on the chef on what speciality is providing and what is his displayed price</li>
        </ul>
    </div>

    <div class="container contact">
        <h5>Contact Us</h5>
        <form action="./index.php" class="contact" method="post">
            <input type="text" name="name" placeholder="Your Name">
            <input type="email" name="email" placeholder="Your Email">
            <textarea name="message" rows="5" placeholder="Your Message"></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <div class="footer text-center py-3">
        <h6>&copy; 2024 Swadsevak</h6>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php
include("dbconnect.php");    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details

    // Retrieve form data and sanitize
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into 'feedback' table
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Feedback sent successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    // Close database connection
    $conn->close();
}
?>

