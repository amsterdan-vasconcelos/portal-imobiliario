<?php

namespace App\Controllers\DashboardModules;

use App\services\AccessProfileService;
use App\services\UserService;

class DashboardUserController
{
  public function __construct(
    private UserService $userService,
    private AccessProfileService $accessProfileService
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
      'user' => $this->userService->getById($id)[0],
      'access_profiles' => $this->accessProfileService->getAll(),
    ];
  }

  private function handleDelete(int $id): array
  {
    $user = $this->userService->getById($id)[0];
    $profile = $this->accessProfileService->getById($user->profile_id)[0];

    $user->access_profile = $profile->description;
    $user->created_at = (new \DateTime($user->created_at))->format('d/m/y');

    $result = ['user' => $user];

    if ($_POST) {
      $result = [
        ...$result,
        ...$this->userService->deleteById($id)
      ];
    }

    return $result;
  }

  private function handleIndex(): array
  {
    $result = [];

    if ($_POST) {
      $result = $this->userService->updateById($_POST, $_POST['id']);
    }

    $users = $this->userService->getAll();

    foreach ($users as $user) {
      $profile = $this->accessProfileService->getById($user->profile_id)[0];
      $user->access_profile = $profile->description;
      $user->created_at = (new \DateTime($user->created_at))->format('d/m/y');
    }

    return [...$result, 'users' => $users];
  }
}
