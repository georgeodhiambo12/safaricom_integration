<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

return function (App $app) {
    // Authorization token for Tendersoko.com
    $client = new Client([
        'headers' => ['Authorization' => 'Bearer cfd147a47a2f013277eddd9063b010c401a3144e']
    ]);

    // Endpoint for fetching latest tenders
    $app->get('/api/tenders/latest', function (Request $request, Response $response) use ($client) {
        try {
            $todayTenders = json_decode($client->get('https://api.tendersoko.com/today/')->getBody(), true);
            $response->getBody()->write(json_encode($todayTenders));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (RequestException $e) {
            error_log($e->getMessage());
            $response->getBody()->write(json_encode(['error' => 'Unable to fetch latest tenders']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    });

    // Endpoint for fetching user's tenders
    $app->get('/api/tenders/my', function (Request $request, Response $response) use ($client) {
        try {
            // Example logic: Fetching a combination of today and valid tenders
            $todayTenders = json_decode($client->get('https://api.tendersoko.com/today/')->getBody(), true);
            $validTenders = json_decode($client->get('https://api.tendersoko.com/valid/')->getBody(), true);
            $myTenders = array_merge($todayTenders, $validTenders);
            $response->getBody()->write(json_encode($myTenders));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (RequestException $e) {
            error_log($e->getMessage());
            $response->getBody()->write(json_encode(['error' => 'Unable to fetch my tenders']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    });

    // Endpoint for fetching valid tenders
    $app->get('/api/tenders/valid', function (Request $request, Response $response) use ($client) {
        try {
            $validTenders = json_decode($client->get('https://api.tendersoko.com/valid/')->getBody(), true);
            $response->getBody()->write(json_encode($validTenders));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (RequestException $e) {
            error_log($e->getMessage());
            $response->getBody()->write(json_encode(['error' => 'Unable to fetch valid tenders']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    });

    // Endpoint for fetching closing tenders
    $app->get('/api/tenders/closing', function (Request $request, Response $response) use ($client) {
        try {
            $closingTenders = json_decode($client->get('https://api.tendersoko.com/closing/')->getBody(), true);
            $response->getBody()->write(json_encode($closingTenders));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (RequestException $e) {
            error_log($e->getMessage());
            $response->getBody()->write(json_encode(['error' => 'Unable to fetch closing tenders']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    });

    // Endpoint for fetching companies
    $app->get('/api/companies', function (Request $request, Response $response) use ($client) {
        try {
            $companies = json_decode($client->get('https://api.tendersoko.com/companies/')->getBody(), true);
            $response->getBody()->write(json_encode($companies));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (RequestException $e) {
            error_log($e->getMessage());
            $response->getBody()->write(json_encode(['error' => 'Unable to fetch companies']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    });

    // Endpoint for fetching sectors
    $app->get('/api/sectors', function (Request $request, Response $response) use ($client) {
        try {
            $sectors = json_decode($client->get('https://api.tendersoko.com/sectors/')->getBody(), true);
            $response->getBody()->write(json_encode($sectors));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (RequestException $e) {
            error_log($e->getMessage());
            $response->getBody()->write(json_encode(['error' => 'Unable to fetch sectors']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    });

    // Endpoint for fetching categories
    $app->get('/api/categories', function (Request $request, Response $response) use ($client) {
        try {
            $categories = json_decode($client->get('https://api.tendersoko.com/categories/')->getBody(), true);
            $response->getBody()->write(json_encode($categories));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (RequestException $e) {
            error_log($e->getMessage());
            $response->getBody()->write(json_encode(['error' => 'Unable to fetch categories']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    });
};
