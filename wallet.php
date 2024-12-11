<?php

// Include your database connection
require_once 'db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include cryptographic functions
require_once 'crypto.php'; // File where cryptographic functions like key generation are defined

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        session_start(); // Start the session
        // Check if the user is logged in
        if (!isset($_SESSION['CustomerID'])) {
            throw new Exception('User not logged in.');
        }

        // Get the logged-in user's CustomerID
        $customerID = $_SESSION['CustomerID'];

        // Check if the customer already has a wallet
        $query = "SELECT * FROM wallets WHERE CustomerID = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(["message" => "Wallet already exists for this customer!"]);
            exit;
        }

        // Generate RSA key pair
        $keys = generateKeyPair();
        $publicKey = $keys['publicKey'];
        $privateKey = $keys['privateKey'];

        // Derive wallet address (e.g., hash of the public key)
        $walletAddress = hash('sha256', $publicKey);

        // Insert the wallet into the database
        $stmt = $con->prepare(
            "INSERT INTO wallets (CustomerID, WalletAddress, PublicKey, PrivateKey, Balance) 
            VALUES (?, ?, ?, ?, 0.00000000)"
        );
        $stmt->bind_param('isss', $customerID, $walletAddress, $publicKey, $privateKey);
        
        $stmt->execute();

        // Return wallet details as a JSON response
        header('Content-Type: application/json');
        echo json_encode([
            "message" => "Wallet created successfully!",
            "wallet_address" => $walletAddress,
            "public_key" => $publicKey
        ]);
        exit;
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        header('Content-Type: application/json');
        echo json_encode(["error" => $e->getMessage()]);
        http_response_code(500);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet Generator</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your website's CSS -->
</head>

<body>
    <?php include 'header.php'; ?> <!-- Include the header of the website -->

    <div class="container">
        <h1>Generate Your Blockchain Wallet</h1>
        <button id="generateWallet">Generate Wallet</button>
        <div id="walletDetails" style="display: none; margin-top: 20px;">
            <h3>Your Wallet Details</h3>
            <p><b>Wallet Address:</b>
            <pre id="walletAddress"></pre>
            </p>
            <p><b>Balance:</b> <span id="walletBalance"></span></p>
            <p><b>Created At:</b> <span id="walletCreatedAt"></span></p>
        </div>
        <div class="top-up-section">
            <h3>Top-Up Balance</h3>
            <input type="number" id="topUpAmount" placeholder="Enter amount" min="0.01" step="0.01">
            <button id="topUpBalance">Top Up</button>
        </div>
        <div id="topUpMessage" style="margin-top: 20px;"></div>
    </div>

    <script>
        // Handle button click for wallet generation
        document.getElementById('generateWallet').addEventListener('click', async () => {
            try {
                // Send POST request to wallet.php
                const response = await fetch('wallet.php', {
                    method: 'POST'
                });
                const data = await response.json();

                if (response.ok) {
                    // Check if wallet creation was successful
                    if (data.message === 'Wallet created successfully!') {
                        // Display wallet details
                        document.getElementById('walletAddress').textContent = data.wallet_address;
                        document.getElementById('walletBalance').textContent = data.balance;
                        document.getElementById('walletCreatedAt').textContent = data.created_at;
                        document.getElementById('walletDetails').style.display = 'block';
                    } else {
                        alert(data.message || 'Failed to generate wallet.');
                    }
                } else {
                    // Handle errors returned by the server
                    alert(data.error || 'An error occurred while generating the wallet.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while generating the wallet.');
            }
        });
    </script>
</body>

</html>