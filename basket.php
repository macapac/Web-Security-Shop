<?php
include("auth_session.php");
include 'header.php'; // Include the header
require('db.php'); // Include the database connection

// Initialize basket if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle removing an item from the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $itemID = $_POST['item_id'];
    unset($_SESSION['cart'][$itemID]);
}

// Handle checkout process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    // Fetch wallet details
    $stmt = $con->prepare("SELECT * FROM wallets WHERE CustomerID = ?");
    $stmt->bind_param("i", $_SESSION['CustomerID']);
    $stmt->execute();
    $result = $stmt->get_result();
    $wallet = $result->fetch_assoc();

    if (!$wallet) {
        echo "<script>alert('No wallet found. Please create one.');</script>";
        exit;
    }

    $totalCost = 0;

    // Calculate total cost
    foreach ($_SESSION['cart'] as $itemID => $cartItem) {
        $stmt = $con->prepare("SELECT * FROM Products WHERE ItemID = ?");
        $stmt->bind_param("i", $itemID);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if (!$product || $product['Stock'] < $cartItem['quantity']) {
            echo "<script>alert('Insufficient stock for " . $product['ItemName'] . "');</script>";
            exit;
        }

        $totalCost += $product['Price'] * $cartItem['quantity'];
    }

    if ($wallet['Balance'] < $totalCost) {
        echo "<script>alert('Insufficient balance. Please top up your wallet.');</script>";
        exit;
    }

    // Deduct balance from wallet and update stock
    $newBalance = $wallet['Balance'] - $totalCost;
    $stmt = $con->prepare("UPDATE wallets SET Balance = ? WHERE WalletID = ?");
    $stmt->bind_param("di", $newBalance, $wallet['WalletID']);
    $stmt->execute();

    foreach ($_SESSION['cart'] as $itemID => $cartItem) {
        $stmt = $con->prepare("UPDATE Products SET Stock = Stock - ? WHERE ItemID = ?");
        $stmt->bind_param("ii", $cartItem['quantity'], $itemID);
        $stmt->execute();
    }

    // Add transaction to blockchain
    $transaction = [
        'sender' => $wallet['WalletAddress'],
        'recipient' => 'SHOP',
        'amount' => $totalCost
    ];
    $ch = curl_init('http://localhost:5001/transactions/new');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($transaction));
    $response = curl_exec($ch);
    curl_close($ch);

    // Mine the block
    $ch = curl_init("http://localhost:5001/mine");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // Clear the cart
    $_SESSION['cart'] = [];
    echo "<script>alert('Purchase successful!'); window.location.href='shop.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="basket-container">
    <h1>Your Basket</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your basket is empty. <a href="shop.php">Go back to shop</a>.</p>
    <?php else: ?>
        <table class="basket-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandTotal = 0;
                foreach ($_SESSION['cart'] as $itemID => $cartItem):
                    $stmt = $con->prepare("SELECT * FROM Products WHERE ItemID = ?");
                    $stmt->bind_param("i", $itemID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $product = $result->fetch_assoc();
                    if (!$product) continue;

                    $itemTotal = $product['Price'] * $cartItem['quantity'];
                    $grandTotal += $itemTotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['ItemName']); ?></td>
                        <td><?php echo $cartItem['quantity']; ?></td>
                        <td>£<?php echo number_format($product['Price'], 2); ?></td>
                        <td>£<?php echo number_format($itemTotal, 2); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $itemID; ?>">
                                <button type="submit" name="remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Grand Total:</strong> £<?php echo number_format($grandTotal, 2); ?></p>
        <form method="post">
            <button type="submit" name="checkout">Checkout</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>

<style>
.basket-container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    text-align: center;
}

.basket-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.basket-table th, .basket-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.basket-table th {
    background-color: #f2f2f2;
}

button {
    padding: 8px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>
