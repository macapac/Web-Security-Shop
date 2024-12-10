<?php
include("auth_session.php");
include 'header.php'; 
require 'wallet.php';

// Retrieve or create user wallet
if (!isset($_SESSION['wallet'])) {
    $userWallet = new Wallet();
    $_SESSION['wallet'] = [
        'privateKey' => $userWallet->privateKey,
        'publicKey' => $userWallet->publicKey,
    ];
}

$wallet = $_SESSION['wallet'];
?>
<?php

class Wallet {
    public $privateKey;
    public $publicKey;

    public function __construct() {
        $keyPair = openssl_pkey_new([
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ]);
        openssl_pkey_export($keyPair, $privateKey);
        $keyDetails = openssl_pkey_get_details($keyPair);

        $this->privateKey = $privateKey;
        $this->publicKey = $keyDetails['key'];
    }

    public function signTransaction($data) {
        openssl_sign($data, $signature, $this->privateKey, OPENSSL_ALGO_SHA256);
        return base64_encode($signature);
    }

    public function verifyTransaction($data, $signature, $publicKey) {
        return openssl_verify($data, base64_decode($signature), $publicKey, OPENSSL_ALGO_SHA256);
    }
}
?>


<div class="container">
    <h1>Your Wallet</h1>
    <p><strong>Public Address:</strong> <?php echo htmlspecialchars($wallet['publicKey']); ?></p>
    <p>Use this address to receive funds or make payments.</p>
</div>
