<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Controllers\ProductController;
use Slim\Exception\HttpNotFoundException;
use Config\Configuration;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    $config = new Configuration();
    return $response
            ->withHeader('Access-Control-Allow-Origin', $config->get("frontend_address"))
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
$app->get('/prices[/]', ProductController::class . ':getPrices');
$app->get('/prices/{id}[/]', ProductController::class . ':getPrice');

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("");
    return $response;
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

$app->run();
