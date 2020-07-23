<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Controllers\ProductController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/prices[/]', ProductController::class . ':getPrices');
$app->get('/prices/{id}[/]', ProductController::class . ':getPrice');

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("");
    return $response;
});

$app->run();
