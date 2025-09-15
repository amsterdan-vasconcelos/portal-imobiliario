<?php

namespace App\services;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

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
      $data = array_filter($data, fn($value) => $value !== '');
      $this->registerValidate($data);

      unset($data['confirm_password']);
      $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

      $user = new User(...$data);
      $this->userDAO->register($user);

      return ['success' => $this->successMessages['user']['register']];
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessages()];
    }
  }

  private function registerValidate(array $data)
  {
    $schema =
      v::key('name', v::stringType()
        ->length(3)->setTemplate("{{name}} deve ter pelo menos 3 caracteres.")
        ->setName('Nome'), false)

      ->key('username', v::stringType()
        ->length(5)
        ->regex('/^[a-z_]+$/')
        ->setTemplate(
          "{{name}} deve ter pelo menos 5 caracteres e deve ser 
            composto apenas por letras minúsculas e underscores (_)."
        )
        ->setName('Username'), false)

      ->key('email', v::email()
        ->setTemplate("{{name}} inválido.")
        ->setName('Email'), false)


      ->key('access_profile_id', v::numericVal()
        ->min(1)->setTemplate("Id inválido para {{name}}.")
        ->setName('Perfil de acesso'), false)

      ->key('active', v::numericVal()
        ->in([0, 1])
        ->setTemplate("Valor iválido para {{name}}.")
        ->setName('Ativo'), false)

      ->key('password', v::stringType()
        ->length(8)->setTemplate("A senha deve ter no mínimo 8 caracteres.")
        ->setName('Senha'), false)

      ->key('confirm_password', v::stringType()
        ->equals($data['password'])->setTemplate("As senhas não coincidem.")
        ->setName('Confirmar senha'), false);

    $schema->assert($data);
  }

  public function updateById(array $data, int $id)
  {
    try {
      $data = array_filter($data, fn($value) => $value !== '');
      $this->updateValidate($data);
      $user = new User(...$data);
      $this->userDAO->updateById($user, $id);

      return ['success' => $this->successMessages['user']['update']];
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessages()];
    }
  }

  private function updateValidate(array $data)
  {
    $schema =
      v::key('name', v::stringType()
        ->length(3)->setTemplate("{{name}} deve ter pelo menos 3 caracteres.")
        ->setName('Nome'), false)

      ->key('username', v::stringType()
        ->length(5)
        ->regex('/^[a-z_]+$/')
        ->setTemplate(
          "{{name}} deve ter pelo menos 5 caracteres e deve ser 
            composto apenas por letras minúsculas e underscores (_)."
        )
        ->setName('Username'), false)

      ->key('email', v::email()
        ->setTemplate("{{name}} inválido.")
        ->setName('Email'), false)


      ->key('access_profile_id', v::numericVal()
        ->min(1)->setTemplate("Id inválido para {{name}}.")
        ->setName('Perfil de acesso'), false)

      ->key('active', v::numericVal()
        ->in([0, 1])
        ->setTemplate("Valor iválido para {{name}}.")
        ->setName('Ativo'), false);

    $schema->assert($data);
  }

  public function deleteById($id)
  {
    try {
      $this->userDAO->deleteById($id);
      return ['success' => $this->successMessages['user']['delete']];
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessages()];
    }
  }
}
