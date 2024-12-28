<?php
$api_url = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,ripple&vs_currencies=usd';

$response = file_get_contents($api_url);
if ($response === FALSE) {
    die('Error occurred');
}

$data = json_decode($response, true);

echo json_encode($data);
