<?php

namespace App\Controllers\DashboardModules;

use App\services\OwnerService;

class DashboardOwnerController
{
  public function __construct(
    private OwnerService $ownerService
  ) {}

  public function handle(string $param, ?int $id): array
  {
    return match ($param) {
      'register' => $this->handleRegister(),
      'update'   => $this->handleUpdate($id),
      'delete'   => $this->handleDelete($id),
      default    => $this->handleIndex(),
    };
  }

  private function handleRegister(): array
  {
    if ($_POST) {
      return $this->ownerService->register($_POST);
    }

    return [];
  }

  private function handleUpdate(int $id): array
  {
    $result = [];

    if ($_POST) {
      $result = $this->ownerService->updateById($_POST, $id);
    }

    return [...$result, 'owner' => $this->ownerService->getById($id)[0]];
  }

  private function handleDelete(int $id): array
  {
    $result = ['owner' => $this->ownerService->getById($id)[0]];

    if ($_POST) {
      $result = [...$result, ...$this->ownerService->deleteById($id)];
    }

    return $result;
  }

  private function handleIndex(): array
  {
    $result = [];

    if ($_POST) {
      $result = $this->ownerService->updateById($_POST, $_POST['id']);
    }

    return [...$result, 'owners' => $this->ownerService->getAll()];
  }
}
