<?php
// Include your database connection
require_once 'db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include cryptographic functions
require_once 'crypto.php'; // File where cryptographic functions like key generation are defined

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if the user is logged in
        if (!isset($_SESSION['CustomerID'])) {
            throw new Exception('User not logged in.');
        }

        // Get the logged-in user's CustomerID
        $customerID = $_SESSION['CustomerID'];

        if (isset($_POST['generate_wallet'])) {
            // Check if the customer already has a wallet
            $query = "SELECT * FROM wallets WHERE CustomerID = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $customerID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                throw new Exception('Wallet already exists for this customer.');
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

            // Respond with wallet creation success
            header('Content-Type: application/json');
            echo json_encode(["message" => "Wallet created successfully!"]);
            exit;
        }

        if (isset($_POST['get_balance'])) {
            // Fetch and return the balance
            $query = "SELECT * FROM wallets WHERE CustomerID = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $customerID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                throw new Exception('No wallet found for this customer.');
            }

            $wallet = $result->fetch_assoc();
            $balance = $wallet['Balance'];

            // Respond with wallet balance
            header('Content-Type: application/json');
            echo json_encode(["balance" => $balance]);
            exit;
        }

        if (isset($_POST['top_up_amount'])) {
            // Handle Top-Up functionality
            $topUpAmount = floatval($_POST['top_up_amount']);

            if ($topUpAmount <= 0) {
                throw new Exception('Invalid top-up amount.');
            }

            // Fetch the customer's wallet
            $query = "SELECT * FROM wallets WHERE CustomerID = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $customerID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                throw new Exception('No wallet found for this customer.');
            }

            $wallet = $result->fetch_assoc();

            // Interact with Python blockchain API to create a transaction
            $data = [
                'sender' => 'SYSTEM', // Replace with your system wallet address
                'recipient' => $wallet['WalletAddress'],
                'amount' => $topUpAmount
            ];

            $ch = curl_init('http://localhost:5001/transactions/new'); // Python API endpoint
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($ch);
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Check if the transaction was successfully added
            if ($httpStatus !== 201) {
                error_log("Failed to add transaction to blockchain: $response");
                throw new Exception('Blockchain transaction failed.');
            }

            // Mine a block to add the transaction to the blockchain
            $ch = curl_init("http://localhost:5001/mine?wallet_address=" . $wallet['WalletAddress']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $mineResponse = curl_exec($ch);
            $mineStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Check if the block was successfully mined
            if ($mineStatus !== 200) {
                error_log("Failed to mine block: $mineResponse");
                throw new Exception('Mining block failed.');
            }

            $blockchainResponse = json_decode($mineResponse, true);

            // Update the wallet balance in the database
            $newBalance = $wallet['Balance'] + $topUpAmount;
            $updateQuery = "UPDATE wallets SET Balance = ? WHERE WalletID = ?";
            $updateStmt = $con->prepare($updateQuery);
            $updateStmt->bind_param("di", $newBalance, $wallet['WalletID']);
            $updateStmt->execute();

            // Respond with success message
            header('Content-Type: application/json');
            echo json_encode([
                "message" => "Balance updated successfully!",
                "new_balance" => $newBalance
            ]);
            exit;
        }
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
    <title>Wallet Management</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
</head>

<body>
    <?php include 'header.php'; ?> <!-- Include the header -->

    <div class="container">
        <h1>Your Wallet</h1>

        <!-- Generate Wallet Button -->
        <button id="generateWallet">Generate Wallet</button>

        <!-- Check Balance Button -->
        <button id="getBalance">Check Balance</button>

        <div id="walletDetails" style="margin-top: 20px;">
            <h3>Wallet Details</h3>
            <p><b>Balance:</b> <span id="walletBalance">--</span></p>
        </div>

        <div class="top-up-section" style="margin-top: 20px;">
            <h3>Top-Up Balance</h3>
            <input type="number" id="topUpAmount" placeholder="Enter amount" min="0.01" step="0.01">
            <button id="topUpBalance">Top Up</button>
        </div>

        <div id="topUpMessage" style="margin-top: 20px;"></div>
    </div>

    <script>
        // Handle wallet generation
        document.getElementById('generateWallet').addEventListener('click', async () => {
            try {
                const response = await fetch('wallet.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ generate_wallet: true }),
                });

                const data = await response.json();
                if (response.ok) {
                    alert(data.message || 'Wallet generated successfully!');
                } else {
                    alert(data.error || 'Failed to generate wallet.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while generating the wallet.');
            }
        });

        // Handle balance retrieval
        document.getElementById('getBalance').addEventListener('click', async () => {
            try {
                const response = await fetch('wallet.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ get_balance: true }),
                });

                const data = await response.json();
                if (response.ok) {
                    document.getElementById('walletBalance').textContent = parseFloat(data.balance).toFixed(2);
                } else {
                    alert(data.error || 'Failed to fetch balance.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while fetching the balance.');
            }
        });

        // Handle balance top-up
        document.getElementById('topUpBalance').addEventListener('click', async () => {
            const topUpAmount = parseFloat(document.getElementById('topUpAmount').value);

            if (isNaN(topUpAmount) || topUpAmount <= 0) {
                alert('Please enter a valid top-up amount.');
                return;
            }

            try {
                const response = await fetch('wallet.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ top_up_amount: topUpAmount }),
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('walletBalance').textContent = parseFloat(data.new_balance).toFixed(2);
                    document.getElementById('topUpMessage').textContent = data.message;
                    document.getElementById('topUpMessage').style.color = 'green';
                } else {
                    alert(data.error || 'Failed to top up balance.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while processing the top-up.');
            }
        });
    </script>
</body>

</html>
