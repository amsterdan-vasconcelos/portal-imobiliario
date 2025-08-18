<?php

namespace App\Core;

class Controller
{
  public function view(string $view, array $viewData = [])
  {
    extract($viewData);

    $viewFile = __DIR__ . "/../views/$view.php";

    if (!file_exists($viewFile)) {
      throw new \Exception("View file not found: $viewFile");
    }


    require_once $viewFile;
  }
}
