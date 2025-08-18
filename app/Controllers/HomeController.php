<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class HomeController extends Controller
{
  public function index(): void
  {
    $userModel = new User();
    $data = $userModel->getUserData();

    $this->view('home/index', $data);
  }
}
