<?php

namespace App\Core;

use App\Controllers\Errors\HttpErrorController;

class Router
{
  public function dispatch($url)
  {
    $url = trim($url, '/');
    $parts = $url ? explode('/', $url) : [];

    $controllerName = $parts[0] ?? 'home';
    $controllerName =
      "App\Controllers\\" . ucfirst($controllerName) . 'Controller';

    if (!class_exists($controllerName)) {
      (new HttpErrorController())->notFound();
      return;
    }

    $actionName = $parts[1] ?? 'index';

    if (!method_exists($controllerName, $actionName)) {
      (new HttpErrorController())->notFound();
      return;
    }

    $params = array_slice($parts, 2);

    $controller = new $controllerName();

    call_user_func_array([$controller, $actionName], $params);
  }
}
