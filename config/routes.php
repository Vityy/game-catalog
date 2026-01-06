<?php

use Controller\AppController;
use Controller\GameApiController;
use Controller\PingApiController;
use Core\Request;
use Core\Response;
use Core\Router;
use Repository\GamesRepository;

return function(Router $router, AppController $controller, PingApiController $pingApiController, GameApiController $gameApiController, GamesRepository $repository) {
    $router->get('/', [$controller, 'home']);
    $router->get('/add', [$controller, 'add']);
    $router->get('/games', [$controller, 'games']);
    $router->get('/random', [$controller, 'random']);

    $router->post('/add', [$controller, 'handleAddGame']);

    $router->getRegex('#^/games/(\d+)$#', function(Request $req, Response $res, array $m) use($controller) {
        $controller->gameById((int)$m[1]);
    });

    $router->get('/api/ping', [$pingApiController, 'ping']);

    $router->get('/api/games/top', function(Request $req, Response $res) use ($gameApiController, $repository) {
        $gameApiController->getTop($req, $repository, $res);
    });

    $router->get('/api/games/recent', function(Request $req, Response $res) use ($gameApiController, $repository) {
        $gameApiController->getMostRecent($req, $repository, $res);
    });

    $router->get('/api/games/ratings', function(Request $req, Response $res) use ($gameApiController, $repository) {
        $gameApiController->groupAllWithRating($req, $repository, $res);
    });
//    $router->get('/api/games/recent', [$gameApiController, 'getMostRecent']);
//    $router->get('/api/games/ratings', [$gameApiController, 'getAllWithRating']);
};