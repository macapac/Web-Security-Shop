<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
<header>
    <!-- Navbar (sit on top) -->
    <ul class="nav">
        <li><b><a href="logout.php">LOGOUT</a></b></li>
        <li><b><a href="basket.php">BASKET</a></b></li>
        <li><b><a href="account.php">ACCOUNT</a></b></li>
        <li><b><a href="shop.php">SHOP</a></b></li>
        <li><b><a href="dashboard.php">HOME</a></b></li>
    </ul>
</header>

<?php
// Database configuration
$host = 'localhost';
$user = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP is empty
$database = 'mysql'; // Replace with your actual database name

// Create a connection
$con = mysqli_connect($host, $user, $password, $database);

// Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "<p style='color: green; text-align: center;'>Connected to the database successfully.</p>";
}
?>

