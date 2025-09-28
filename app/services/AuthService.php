<?php

namespace App\services;

session_start();

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

use App\DAO\UserDAO;

class AuthService extends Services
{
  public function __construct(
    private $userDAO = new UserDAO()
  ) {}

  public function signIn(array $data)
  {
    try {
      $this->signInValidate($data);

      $result = $this->userDAO->getByUsername($data['username']);
      $user = count($result) > 0 ? $result[0] : null;

      if (!$user) {
        throw new \Exception('Username ou senha inválida.');
      }

      $passwordIsEqual = password_verify($data['password'], $user->getPassword());

      if (!$passwordIsEqual) {
        throw new \Exception('Username ou senha inválida.');
      }

      $_SESSION['user'] = [
        'access_profile' => $user->getAccessProfile(),
        'id' => $user->getId(),
        'name' => $user->getName()
      ];

      header('location: /dashboard');
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessages()];
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }
  }

  private function signInValidate($data)
  {
    $schema =
      v::key('username', v::stringType()
        ->length(5)
        ->regex('/^[a-z_]+$/')
        ->setTemplate(
          "{{name}} deve ter pelo menos 5 caracteres e deve ser 
            composto apenas por letras minúsculas e underscores (_)."
        )
        ->setName('Username'), false)

      ->key('password', v::stringType()
        ->length(8)->setTemplate("A senha deve ter no mínimo 8 caracteres.")
        ->setName('Senha'), false);

    $schema->assert($data);
  }
}
