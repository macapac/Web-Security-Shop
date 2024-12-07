<?php
include("auth_session.php");
include 'header.php'; // Include the header
?>

<div class="container">
    <h1>Your Wallet</h1>
    <p>Here you can view your wallet balance and top up your account.</p>
    <form action="topup.php" method="post">
        <label for="amount">Amount to top up:</label>
        <input type="number" id="amount" name="amount" min="1" required>
    </form>


<?php
include 'footer.php'; // Include the footer
?>