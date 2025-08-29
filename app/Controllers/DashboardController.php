<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
  public function index()
  {
    $this->view('dashboard/index');
  }

  public function owner($param = 'index')
  {
    $this->view("dashboard/owner/$param");
  }
}
