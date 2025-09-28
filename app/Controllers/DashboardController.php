<?php

namespace App\Controllers;

session_start();

use App\Controllers\DashboardModules\DashboardOwnerController;
use App\Controllers\DashboardModules\DashboardPropertyController;
use App\Controllers\DashboardModules\DashboardUserController;
use App\Core\Controller;
use App\services\AccessProfileService;
use App\services\OwnerService;
use App\services\PropertyService;
use App\services\PropertyTypeService;
use App\services\PropertyImageService;
use App\services\PurposeService;
use App\services\UserService;

class DashboardController extends Controller
{
  public function __construct(
    private $ownerService = new OwnerService(),
    private $userService = new UserService(),
    private $accessProfileService = new AccessProfileService(),
    private $propertyService = new PropertyService(),
    private $propertyTypeService = new PropertyTypeService(),
    private $propertyImageService = new PropertyImageService(),
    private $purposeService = new PurposeService(),
  ) {
    if (!isset($_SESSION['user'])) {
      header('location: /auth/signin');
    }
  }

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

  public function property($param = 'index', ?int $id = null)
  {
    $controller = new DashboardPropertyController(
      $this->propertyService,
      $this->propertyTypeService,
      $this->purposeService,
      $this->ownerService,
      $this->propertyImageService,
    );

    $result = $controller->handle($param, $id);

    $this->view("dashboard/property/$param", $result);
  }
}
