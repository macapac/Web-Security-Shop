<?php 
session_start();
include 'header.php'; // Include header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/account.css"> <!-- Link to external CSS -->
    <title>AJ-Garments</title>
</head>
<body>
    <!-- Wallet Section -->
    <div class="content">
        <p><a class="word" href="wallet.php">Your Wallet</a></p>
    </div>

    <!-- Sign In Section -->
    <div class="content">
        <p><a class="word" href="login.php">SIGN IN</a></p>
    </div>
    <div class="footer">
        <p>You must be signed in to access the shop and purchase items.</p>
    </div>

    <!-- Create Account Section -->
    <div class="content">
        <p><a class="word" href="registration.php">CREATE ACCOUNT</a></p>
    </div>
    <div class="footer">
        <p>
            <span>New to AJ-Garments? Register today! Be the first to receive special discounts and 
            notifications about exclusive sales. Creating an account is free!</span>
        </p>
    </div>
</body>
</html>
