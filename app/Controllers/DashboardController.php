<?php

namespace App\Controllers;

use App\Core\Controller;
use App\services\OwnerService;
use Exception;
use InvalidArgumentException;

class DashboardController extends Controller
{
  public function __construct(
    private $ownerService = new OwnerService()
  ) {}

  public function index()
  {
    $this->view('dashboard/index');
  }

  public function owner($param = 'index')
  {
    $result = [];
    if ($_POST) $result = $this->$param('owner', $_POST);
    if ($param === 'index') $result = ['owners' => $this->getAll('owner')];

    $this->view("dashboard/owner/$param", $result);
  }

  public function getAll(string $service)
  {
    $service = $service . 'Service';

    try {
      return $this->$service->getAll();
    } catch (Exception $e) {
      echo 'Error' . $e->getMessage();
    }
  }

  public function register(string $service, array $data)
  {
    $service = $service . 'Service';

    try {
      $this->$service->register($data);

      sleep(2);

      return ['success' => 'Proprietário cadastrado com sucesso!'];
    } catch (InvalidArgumentException $e) {

      sleep(2);

      return ['error' => $e->getMessage()];
    }
  }

  public function update() {}
  public function delete() {}
}
