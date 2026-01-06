<?php

use Controller\AppController;
use Controller\PingApiController;
use Core\Database;
use Core\Response;
use Core\Session;
use Core\Request;
use Core\Router;
use Repository\GamesRepository;

session_start();
require __DIR__ . '/../autoload.php';
$registerRoutes = require __DIR__ . '/../config/routes.php';


$config = require_once __DIR__ . '/../config/db.php';

//$path = $_SERVER['REQUEST_URI'];

$response = new Response();
$repository = new GamesRepository(Database::makePdo($config['db']));
$session = new Session();
$request = new Request();
$router = new Router();

$appController = new AppController($response, $repository, $session, $request);
$pingApiController = new PingApiController();

$registerRoutes($router, $appController, $pingApiController);
$router->dispatch($request, $response);

//$appController->handleRequest($path);
//$appController->handleRequest($request->path());
