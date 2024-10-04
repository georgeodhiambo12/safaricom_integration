<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

header('Content-Type: application/json');

$country = isset($_GET['country']) ? $_GET['country'] : 'kenya';

$client = new Client();

try {
    $response = $client->get("https://api.tendersoko.com/companies/?token=cfd147a47a2f013277eddd9063b010c401a3144e&country={$country}", [
        'headers' => [
            'Accept' => 'application/json',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Referer' => 'https://api.tendersoko.com/',
            'Origin' => 'https://api.tendersoko.com'
        ]
    ]);
    echo $response->getBody();
} catch (RequestException $e) {
    echo json_encode([
        'status' => false,
        'message' => 'Error fetching companies: ' . $e->getMessage()
    ]);
}
