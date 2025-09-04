<?php

namespace App\services;

use App\DAO\UserDAO;
use App\Models\User;

class UserService extends Services
{
  public function __construct(
    private $userDAO = new UserDAO
  ) {}

  public function getAll()
  {
    return $this->userDAO->getAll();
  }

  public function getById(int $id)
  {
    return $this->userDAO->getById($id);
  }

  public function register(array $data)
  {
    $name = $data['name'] ?? null;
    $username = $data['username'] ?? null;
    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;
    $confirm_password = $data['confirm_password'] ?? null;
    $profile_id = $data['profile_id'] ?? null;

    try {
      $this->validateName($name);
      $this->validateUsername($username);
      $this->validateEmail($email);
      $this->validatePassword($password, $confirm_password);
      $this->validateProfileId($profile_id);

      $user = new User(
        name: $name,
        username: $username,
        email: $email,
        password: $password,
        profile_id: $profile_id
      );

      $this->userDAO->register($user);
      return ['success' => $this->successMessages['user']['register']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public function updateById(array $data, int $id)
  {
    $name = $data['name'] ?? null;
    $username = $data['username'] ?? null;
    $email = $data['email'] ?? null;
    $profile_id = $data['profile_id'] ?? null;
    $password = $data['password'] ?? null;
    $confirm_password = $data['confirm_password'] ?? null;
    $active = $data['active'] ?? null;

    try {
      if ($name) $this->validateName($name);
      if ($username) $this->validateUsername($username);
      if ($email) $this->validateEmail($email);
      if ($profile_id) $this->validateProfileId($profile_id);
      if ($password) $this->validatePassword($password, $confirm_password);
      if ($active) $this->validateActive($active);

      $user = new User(
        name: $name,
        username: $username,
        email: $email,
        profile_id: $profile_id,
        password: $password,
        active: $active === 'true' ? true : ($active === 'false' ? false : null)
      );

      $this->userDAO->updateById($user, $id);

      return ['success' => $this->successMessages['user']['update']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public function deleteById($id)
  {
    try {
      $this->userDAO->deleteById($id);
      return ['success' => $this->successMessages['user']['delete']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }
}
