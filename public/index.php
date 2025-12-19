<?php

require_once __DIR__ . '/../src/controllers/AppController.php';
require_once __DIR__ . '/../src/helpers/debug.php';

$path = $_SERVER['REQUEST_URI'];

//dump_block('REQUEST URI', $path);

$appController = new AppController();

$appController->handleRequest($path);
