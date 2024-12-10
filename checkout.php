<?php
session_start();
include 'blockchain.php';
include 'transaction.php';

// Initialize blockchain
if (!isset($_SESSION['blockchain'])) {
    $_SESSION['blockchain'] = new Blockchain();
}

$blockchain = $_SESSION['blockchain'];

// Retrieve user's wallet
$userWallet = $_SESSION['wallet'];
$shopWallet = "ShopPublicKeyHere"; // Replace with the shop's wallet address

// Calculate the total from the cart
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['Price'] * $item['Quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction = new Transaction($userWallet['publicKey'], $shopWallet, $total);
    $transaction->signTransaction($userWallet['privateKey']);

    if ($transaction->isValid($userWallet['publicKey'])) {
        $blockchain->addTransaction($transaction);
        $blockchain->minePendingTransactions();

        // Clear the cart and redirect to a receipt page
        $_SESSION['cart'] = [];
        header("Location: receipt.php?transaction_id=" . $blockchain->getLatestBlock()->hash);
        exit();
    } else {
        echo "<p>Payment failed: Invalid transaction.</p>";
    }
}
?>

<div class="container">
    <h1>Checkout</h1>
    <p><strong>Total Amount:</strong> £<?php echo number_format($total, 2); ?></p>
    <p><strong>Send the payment to this address:</strong> <?php echo htmlspecialchars($shopWallet); ?></p>
    <form method="post">
        <button type="submit">Confirm Payment</button>
    </form>
</div>
