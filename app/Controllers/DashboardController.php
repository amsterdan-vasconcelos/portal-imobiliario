<?php

namespace App\Controllers;

use App\Core\Controller;
use App\services\OwnerService;
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

    if ($_POST) {
      $result = $this->$param('owner', $_POST);
    }

    $this->view("dashboard/owner/$param", $result);
  }

  public function register(string $service, array $data)
  {
    $service = $service . 'Service';

    try {
      $this->$service->register($data);

      sleep(.5);

      return ['success' => 'Proprietário cadastrado com sucesso!'];
    } catch (InvalidArgumentException $e) {

      sleep(.5);

      return ['error' => $e->getMessage()];
    }

    // echo '<pre>';
    // var_dump("Deu certo $result");
    // die();
  }

  public function update() {}
  public function delete() {}
}
