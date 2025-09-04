<?php

namespace App\services;

use App\DAO\UserDAO;
use App\Models\User;

class UserService
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
      return ['success' => 'Usuário cadastrado com sucesso!'];
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

      return ['success' => 'Usuário atualizado com sucesso!'];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public function deleteById($id)
  {
    try {
      $this->userDAO->deleteById($id);
      return ['success' => 'Usuário deletado com sucesso!'];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  private function validateName(?string $name)
  {
    if (!$name || mb_strlen(trim($name)) < 3) {
      throw new \InvalidArgumentException(
        'O nome é obrigatório e deve conter pelo menos 3 caracteres.'
      );
    }
  }

  private function validateUsername(?string $username)
  {
    $username = trim($username);

    if (!$username || mb_strlen($username) < 5) {
      throw new \InvalidArgumentException(
        "O username é obrigatório e deve conter pelo menos 5 caracteres.\n" .
          "Ele deve ser composto apenas por letras minúsculas e underscores (_)."
      );
    }

    if (!preg_match('/^[a-z_]+$/', $username)) {
      throw new \InvalidArgumentException(
        "O username deve conter apenas letras minúsculas e underscores (_)."
      );
    }
  }

  private function validateEmail(?string $email)
  {
    $email = trim($email);

    if (!$email) {
      throw new \InvalidArgumentException("O e-mail é obrigatório.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new \InvalidArgumentException("O e-mail fornecido é inválido.");
    }
  }

  private function validatePassword(?string $password, ?string $confirm_password)
  {
    $password = trim($password);
    $confirm_password = trim($confirm_password);

    if (!$password || mb_strlen($password) < 8) {
      throw new \InvalidArgumentException(
        'A senha é obrigatório e deve conter pelo menos 8 caracteres.'
      );
    }

    if ($password !== $confirm_password) {
      throw new \InvalidArgumentException(
        'As senhas devem coincidir.'
      );
    }
  }

  private function validateActive(?string $active)
  {
    $active = mb_strtolower($active ?? '');
    match ($active) {
      'true', 'false' => null,
      default => throw new \InvalidArgumentException('O gênero deve ser M ou F.')
    };
  }

  private function validateProfileId(?int $profile_id)
  {
    if (!filter_var($profile_id, FILTER_VALIDATE_INT)) {
      throw new \InvalidArgumentException("Perfil de acesso inválido.");
    }
  }
}
