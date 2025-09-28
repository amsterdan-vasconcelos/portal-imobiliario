<?php

namespace App\Controllers\DashboardModules;

use App\services\AccessProfileService;
use App\services\UserService;

class DashboardUserController
{
  public function __construct(
    private UserService $userService,
    private AccessProfileService $accessProfileService
  ) {
    if ($_SESSION['user']['access_profile'] !== 'admin') {
      header('location: /');
    }
  }

  public function handle(string $param, ?int $id): array
  {
    return match ($param) {
      'register' => $this->handleRegister(),
      'update'   => $this->handleUpdate($id),
      'delete'   => $this->handleDelete($id),
      default    => $this->handleIndex($id),
    };
  }

  private function handleRegister()
  {
    $result = [];

    if ($_POST) {
      $result = $this->userService->register($_POST);
    }

    return [
      ...$result,
      'access_profiles' => $this->accessProfileService->getAll(),
    ];
  }

  private function handleUpdate(int $id): array
  {
    $result = [];

    if ($_POST) {
      $result = $this->userService->updateById($_POST, $id);
    }

    return [
      ...$result,
      'user' => $this->userService->getById($id),
      'access_profiles' => $this->accessProfileService->getAll(),
    ];
  }

  private function handleDelete(int $id): array
  {
    $user = $this->userService->getById($id);
    $result = ['user' => $user];

    if ($_POST) {
      $result = [
        ...$result,
        ...$this->userService->deleteById($id)
      ];
    }

    return $result;
  }

  private function handleIndex(?int $id): array
  {
    $result = [];

    if ($_POST) {
      $result = $this->userService->updateById($_POST, $id);
    }

    $users = $this->userService->getAll();

    return [...$result, 'users' => $users];
  }
}
