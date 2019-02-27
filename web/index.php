<?php

require dirname(__DIR__) . '/vendor/autoload.php';
session_start();

error_reporting (E_ALL);

$router = new \core\Router();

$router->dispatch();
