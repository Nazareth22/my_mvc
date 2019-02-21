<?php

require dirname(__DIR__) . '/vendor/autoload.php';

error_reporting (E_ALL);

$router = new \core\Router();
$router->add('/', ['controller' => 'Home', 'action' => 'index']);

$router->dispatch($_SERVER['REQUEST_URI']);
