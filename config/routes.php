<?php

use Controller\AppController;
use Core\Router;

return function(Router $router, AppController $controller) {
    $router->get('/', [$controller, 'home']);
    $router->get('/add', [$controller, 'add']);
    $router->get('/games', [$controller, 'games']);
    $router->get('/random', [$controller, 'random']);

    $router->post('add', [$controller, 'handleAddGame']);
};