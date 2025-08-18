<?php

namespace App\Controllers\Errors;

use App\Core\Controller;

class HttpErrorController extends Controller
{
  public function notFound(): void
  {
    $this->view('errors/notFound');
    http_response_code(404);
  }
}
