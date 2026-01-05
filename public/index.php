<?php

use Controller\AppController;
use Core\Database;
use Core\Response;
use Core\Session;
use Core\Request;
use Repository\GamesRepository;

session_start();
require __DIR__ . '/../autoload.php';
$config = require_once __DIR__ . '/../config/db.php';

//$path = $_SERVER['REQUEST_URI'];

$response = new Response();
$repository = new GamesRepository(Database::makePdo($config['db']));
$session = new Session();
$request = new Request();

$appController = new AppController($response, $repository, $session, $request);

//$appController->handleRequest($path);
$appController->handleRequest($request->path());
