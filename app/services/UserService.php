<?php

namespace App\services;

use App\DAO\UserDAO;
use App\Models\User;

class UserService extends Services
{
  public function __construct(
    private $userDAO = new UserDAO
  ) {}

  /** @return User[] */
  public function getAll()
  {
    return $this->userDAO->getAll();
  }

  /** @return User */
  public function getById(int $id)
  {
    return $this->userDAO->getById($id)[0];
  }

  public function register(array $data)
  {
    try {
      $name = $this->validateName($data['name'] ?? null);
      $username = $this->validateUsername($data['username'] ?? null);
      $email = $this->validateEmail($data['email'] ?? null);
      $password = $this->validatePassword(
        $data['password'] ?? null,
        $data['confirm_password'] ?? null
      );
      $profile_id = $this->validateInt($data['profile_id'] ?? null, 'Perfil de acesso');

      $user = new User(
        name: $name,
        username: $username,
        email: $email,
        password: password_hash($password, PASSWORD_BCRYPT),
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
    try {
      $name = $data['name'] ?? null;
      $name = $name ? $this->validateName($name) : $name;

      $username = $data['username'] ?? null;
      $username = $username ? $this->validateUsername($username) : $username;

      $email = $data['email'] ?? null;
      $email = $email ? $this->validateEmail($email) : $email;

      $profile_id = $data['profile_id'] ?? null;
      $profile_id = $profile_id ? $this->validateInt($profile_id, 'Perfil de acesso') : $profile_id;

      $password = $data['password'] ?? null;
      $confirm_password = $data['confirm_password'] ?? null;
      $password = $password ? $this->validatePassword($password, $confirm_password) : $password;

      $active = $data['active'] ?? null;
      $active = $active ? $this->validateActive($active) : $active;

      $user = new User(
        name: $name,
        username: $username,
        email: $email,
        profile_id: $profile_id,
        password: $password,
        active: $active
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
