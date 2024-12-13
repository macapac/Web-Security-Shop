<?php
function generateKeyPair() {
    $config = [
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
        "config" => 'C:/xampp/php/extras/openssl\openssl.cnf', // Update this path
    ];

    $privateKeyResource = openssl_pkey_new($config);

    if (!$privateKeyResource) {
        throw new Exception("Failed to generate private key: " . openssl_error_string());
    }

    openssl_pkey_export($privateKeyResource, $privateKey, NULL, $config);

    $publicKeyDetails = openssl_pkey_get_details($privateKeyResource);
    $publicKey = $publicKeyDetails['key'];

    return [
        'privateKey' => $privateKey,
        'publicKey' => $publicKey
    ];
}

?>