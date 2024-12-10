<?php
class Block {
    public $index;
    public $timestamp;
    public $transactions;
    public $previousHash;
    public $nonce;
    public $hash;

    public function __construct($index, $transactions, $previousHash) {
        $this->index = $index;
        $this->timestamp = time();
        $this->transactions = $transactions;
        $this->previousHash = $previousHash;
        $this->nonce = 0;
        $this->hash = $this->calculateHash();
    }

    public function calculateHash() {
        return hash('sha256', $this->index . $this->timestamp . json_encode($this->transactions) . $this->previousHash . $this->nonce);
    }

    public function mineBlock($difficulty) {
        $target = str_repeat('0', $difficulty);
        while (substr($this->hash, 0, $difficulty) !== $target) {
            $this->nonce++;
            $this->hash = $this->calculateHash();
        }
    }
}

class Blockchain {
    public $chain;
    public $difficulty;
    public $pendingTransactions;

    public function __construct() {
        $this->chain = [$this->createGenesisBlock()];
        $this->difficulty = 3;
        $this->pendingTransactions = [];
    }

    private function createGenesisBlock() {
        return new Block(0, [], "0");
    }

    public function getLatestBlock() {
        return $this->chain[count($this->chain) - 1];
    }

    public function addTransaction($transaction) {
        array_push($this->pendingTransactions, $transaction);
    }

    public function minePendingTransactions() {
        $newBlock = new Block(count($this->chain), $this->pendingTransactions, $this->getLatestBlock()->hash);
        $newBlock->mineBlock($this->difficulty);

        array_push($this->chain, $newBlock);
        $this->pendingTransactions = [];
    }
}
?>
