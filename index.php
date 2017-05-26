<?php
$package = [
  "refid" => "12345612",
  "pubkey" => "037357fa84fff4f93a77248f1fd103fb5370ffd2f80963524d3159174b39432984",
  "signature" => "304402202330dc190adc102c72e2f4d738854dd444701b2afeec8ee41542b8bc015a431c022038031b5d6d85635fc9771c7adc517c16a43f8f5d9c0ec86e7556d8b69d7d2b20"
];

$context = secp256k1_context_create(SECP256K1_CONTEXT_SIGN | SECP256K1_CONTEXT_VERIFY);
$msg32 = hash('sha256', $package['refid'].$package['pubkey'], true);
// uncomment if need double hash
// $msg32 = hash('sha256', $msg32, true);

$signatureRaw = hex2bin($package['signature']);
$publicKeyRaw = hex2bin($package['pubkey']);

// Load up the public key from its bytes (into $publicKey):
/** @var resource $publicKey */
$publicKey = '';
secp256k1_ec_pubkey_parse($context, $publicKey, $publicKeyRaw);

// Load up the signature from its bytes (into $signature):
/** @var resource $signature */
$signature = '';
secp256k1_ecdsa_signature_parse_der($context, $signature, $signatureRaw);

// Verify:
$result = secp256k1_ecdsa_verify($context, $signature, $msg32, $publicKey);
if ($result == 1) {
	echo "Signature was verified\n";
} else {
	echo "Signature was NOT VERIFIED\n";
}