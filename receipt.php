<?php
session_start();
include 'blockchain.php';

// Retrieve blockchain
$blockchain = $_SESSION['blockchain'] ?? null;

if (!$blockchain || !isset($_GET['transaction_id'])) {
    die("Invalid transaction.");
}

$transactionId = $_GET['transaction_id'];
$block = null;

// Search for the transaction in the blockchain
foreach ($blockchain->chain as $b) {
    if ($b->hash === $transactionId) {
        $block = $b;
        break;
    }
}

if (!$block) {
    die("Transaction not found.");
}
?>

<div class="container">
    <h1>Transaction Receipt</h1>
    <p><strong>Transaction ID:</strong> <?php echo htmlspecialchars($block->hash); ?></p>
    <p><strong>Amount Paid:</strong> £<?php echo htmlspecialchars($block->transactions[0]->amount); ?></p>
    <p><strong>Date:</strong> <?php echo date('Y-m-d H:i:s', $block->timestamp); ?></p>
    <p><strong>Recipient:</strong> Shop</p>
</div>
