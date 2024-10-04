<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

header('Content-Type: application/json');

// Define the error log file path
define('ERROR_LOG_FILE', '/path/to/your/error.log'); // Change this to your desired path

$tenderId = isset($_GET['id']) ? $_GET['id'] : '';

if (!$tenderId) {
    error_log("Tender ID is required\n", 3, ERROR_LOG_FILE);
    echo json_encode([
        'status' => false,
        'message' => 'Tender ID is required'
    ]);
    exit;
}

$client = new Client();

try {
    $response = $client->get("https://api.tendersoko.com/tender/{$tenderId}/json/?token=YOUR_API_TOKEN", [
        'headers' => [
            'Accept' => 'application/json',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Referer' => 'https://api.tendersoko.com/',
            'Origin' => 'https://api.tendersoko.com'
        ]
    ]);

    echo $response->getBody();

} catch (RequestException $e) {
    error_log("Error fetching tender details: " . $e->getMessage() . "\n", 3, ERROR_LOG_FILE);
    error_log("Request details: " . print_r($e->getRequest(), true) . "\n", 3, ERROR_LOG_FILE);
    if ($e->hasResponse()) {
        error_log("Response: " . $e->getResponse()->getBody() . "\n", 3, ERROR_LOG_FILE);
    }
    echo json_encode([
        'status' => false,
        'message' => 'Error fetching tender details: ' . $e->getMessage()
    ]);
}
?>
