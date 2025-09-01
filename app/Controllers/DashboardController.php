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

  public function owner($param = 'index', $id = null)
  {
    $result = [];

    if ($_POST && $param === 'register') $result = $this->register('owner', $_POST);
    if ($param === 'update') {
      $result = ['owner' => $this->getById('owner', $id)];

      if ($_POST) {
        $result = [...$result, ...$this->update('owner', $_POST, $id)];
      }
    }
    if ($param === 'delete') $result = $this->getAll('owner');
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

  public function getById(string $service, int $id)
  {
    $service = $service . 'Service';

    try {
      return $this->$service->getById($id);
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

  public function update(string $service, array $data, int $id)
  {
    $service = $service . 'Service';

    try {
      $this->$service->updateById($data, $id);

      sleep(1);
      return ['success' => 'Proprietário atualizado com sucesso!'];
    } catch (InvalidArgumentException $e) {

      sleep(1);
      return ['error' => $e->getMessage()];
    }
  }

  public function delete() {}
}
