<?php

namespace App\Controllers;

use App\Core\Controller;
use App\services\AuthService;

class AuthController extends Controller
{
  public function __construct(private $authService = new AuthService()) {}

  public function signin(): void
  {
    $result = [];


    if ($_POST) {
      $result = $this->authService->signIn($_POST);
    }

    $this->view('auth/signin', $result);
  }

  public function signout()
  {
    $_SESSION = [];
    session_destroy();

    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
      );
    }

    header('location: /');
  }
}
