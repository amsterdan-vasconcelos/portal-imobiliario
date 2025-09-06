<?php

namespace App\services;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

use App\DAO\OwnerDAO;
use App\Models\Owner;

class OwnerService extends Services
{
  public function __construct(
    private $ownerDAO = new OwnerDAO()
  ) {}

  public function getAll()
  {
    return $this->ownerDAO->getAll();
  }

  public function getById(int $id)
  {
    return $this->ownerDAO->getById($id);
  }

  public function register(array $data)
  {
    try {
      $this->registerValidate($data);
      $owner = new Owner(...$data);
      $this->ownerDAO->register($owner);

      return ['success' => $this->successMessages['owner']['register']];
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessages()];
    }
  }

  private function registerValidate($data)
  {
    $schema =
      v::key(
        'name',
        v::stringType()
          ->length(3, 50)
          ->setName('Nome')
          ->setTemplate(
            "{{name}} deve ter entre {{minValue}} e {{maxValue}} caracteres."
          )
      )->setTemplate("{{name}} é obrigatório")
      ->key(
        'phone',
        v::stringType()
          ->length(10, null)
          ->setName('Telefone')
          ->setTemplate(
            "{{name}} deve ter no mínimo {{minValue}} caracteres."
          )
      )->setTemplate("{{name}} é obrigatório")
      ->key(
        'gender',
        v::stringType()
          ->length(1, 1)
          ->setName('Gênero')
      )->setTemplate("{{name}} é obrigatório");

    $schema->assert($data);
  }

  public function updateById(array $data, int $id)
  {
    try {
      $data = array_filter($data, fn($value) => $value !== '');
      $this->updateValidate($data);
      $owner = new Owner(...$data);
      $this->ownerDAO->updateById($owner, $id);

      return ['success' => $this->successMessages['owner']['update']];
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessages()];
    }
  }

  private function updateValidate($data)
  {
    $schema =
      v::key(
        'name',
        v::stringType()
          ->length(3, 50)
          ->setName('Nome')
          ->setTemplate(
            "{{name}} deve ter entre {{minValue}} e {{maxValue}} caracteres."
          ),
        false
      )
      ->key(
        'phone',
        v::stringType()
          ->length(10, null)
          ->setName('Telefone')
          ->setTemplate(
            "{{name}} deve ter no mínimo {{minValue}} caracteres."
          ),
        false
      )
      ->key(
        'gender',
        v::stringType()
          ->length(1, 1)
          ->setName('Gênero')
      )
      ->key(
        'active',
        v::boolType()
          ->setName('Ativo')
          ->setTemplate('{{name}} deve ser verdadeiro ou falso'),
        false
      );

    $schema->assert($data);
  }

  public function deleteById($id)
  {
    try {
      $this->ownerDAO->deleteById($id);
      return ['success' => $this->successMessages['owner']['delete']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }
}
