<?php
class Transaction {
    public $sender;
    public $receiver;
    public $amount;
    public $signature;

    public function __construct($sender, $receiver, $amount) {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;
    }

    public function signTransaction($privateKey) {
        $data = $this->sender . $this->receiver . $this->amount;
        $this->signature = base64_encode(openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256));
    }

    public function isValid($publicKey) {
        $data = $this->sender . $this->receiver . $this->amount;
        return openssl_verify($data, base64_decode($this->signature), $publicKey, OPENSSL_ALGO_SHA256);
    }
}
?>
