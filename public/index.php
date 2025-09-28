<?php

require_once '/var/www/project/vendor/autoload.php';

use App\Core\Router;

$url = $_SERVER['REQUEST_URI'];

$router = new Router();
$router->dispatch($url);
