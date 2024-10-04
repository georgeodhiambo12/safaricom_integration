<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

header('Content-Type: text/html; charset=UTF-8');

$client = new Client();

$tenderId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$tenderId) {
    echo 'Tender ID is required';
    exit;
}

try {
    $response = $client->get("https://api.tendersoko.com/tender/{$tenderId}/json/?token=cfd147a47a2f013277eddd9063b010c401a3144e", [
        'headers' => [
            'Accept' => 'application/json',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Referer' => 'https://api.tendersoko.com/',
            'Origin' => 'https://api.tendersoko.com'
        ]
    ]);

    $body = $response->getBody();
    $data = json_decode($body, true);

    if (!isset($data['status']) || !$data['status']) {
        throw new Exception('Invalid data received.');
    }

    $tender = $data['tender'];

    echo '<div style="padding: 20px; font-family: Arial, sans-serif;">';
    echo '<h2>' . htmlspecialchars($tender['title']) . '</h2>';
    echo '<p><strong>Company:</strong> ' . htmlspecialchars($tender['company']) . '</p>';
    echo '<p><strong>Closing Date:</strong> ' . htmlspecialchars($tender['closing_date']) . '</p>';
    echo '<p><strong>Sector:</strong> ' . htmlspecialchars($tender['sector']) . '</p>';
    echo '<p><strong>Category:</strong> ' . htmlspecialchars($tender['category']) . '</p>';
    echo '<p>' . base64_decode($tender['description']) . '</p>';
    
    if (isset($tender['downloadLink'])) {
        echo '<a href="' . htmlspecialchars($tender['downloadLink']) . '" class="button download-advert" target="_blank" download>View Tender Advert</a>';
    }

    if (isset($tender['documents']) && count($tender['documents']) > 0) {
        $documents = array_unique($tender['documents'], SORT_REGULAR); // Ensure unique documents
        $docCount = count($documents);
        
        echo '<div class="tender-documents-list" style="margin-top: 20px;">';
        echo '<h3>Tender Documents ' . $docCount . '</h3>';
        echo '<ul style="list-style: none; padding: 0;">';
        foreach ($documents as $doc) {
            $documentTitle = htmlspecialchars($doc['title']);
            $downloadLink = htmlspecialchars($doc['download']);
            $filename = $documentTitle . '.pdf'; // Replace the serial number with the title of the document

            echo '<li style="margin-bottom: 10px; display: flex; align-items: center;">';
            echo '<a href="' . $downloadLink . '" class="document-link" target="_blank" download="' . $filename . '" style="flex: 1;">' . $documentTitle . '</a>';
            echo '<a href="' . $downloadLink . '" target="_blank" download="' . $filename . '" style="text-decoration: none; color: #0288d1; margin-left: 10px;">&#128190;</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    echo '</div>';

} catch (RequestException $e) {
    echo 'Error fetching tender description: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}
?>

