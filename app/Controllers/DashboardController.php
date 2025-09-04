<?php

namespace App\Controllers;

use App\Controllers\DashboardModules\DashboardOwnerController;
use App\Controllers\DashboardModules\DashboardUserController;
use App\Core\Controller;
use App\services\AccessProfileService;
use App\services\OwnerService;
use App\services\UserService;

class DashboardController extends Controller
{
  public function __construct(
    private $ownerService = new OwnerService(),
    private $userService = new UserService(),
    private $accessProfileService = new AccessProfileService(),
  ) {}

  public function index()
  {
    $this->view('dashboard/index');
  }

  public function owner($param = 'index', ?int $id = null)
  {
    $controller = new DashboardOwnerController(
      $this->ownerService
    );

    $result = $controller->handle($param, $id);

    $this->view("dashboard/owner/$param", $result);
  }

  public function user($param = 'index', ?int $id = null)
  {
    $controller = new DashboardUserController(
      $this->userService,
      $this->accessProfileService
    );

    $result = $controller->handle($param, $id);

    $this->view("dashboard/user/$param", $result);
  }
}
