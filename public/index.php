<?php

require_once '/var/www/project/vendor/autoload.php';
require_once '/var/www/project/app/consts/consts.php';

use App\Core\Router;

$url = $_GET['url'] ?? '';

$router = new Router();
$router->dispatch($url);
