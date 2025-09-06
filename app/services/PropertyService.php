<?php

namespace App\services;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

use App\DAO\PropertyDAO;
use App\Models\Property;

class PropertyService extends Services
{
  public function __construct(
    private $propertyDAO = new PropertyDAO
  ) {}

  public function getAll()
  {
    return $this->propertyDAO->getAll();
  }

  public function getById(int $id)
  {
    return $this->propertyDAO->getById($id);
  }

  public function register(array $data)
  {
    try {
      $data = array_filter($data, fn($value) => $value !== '');
      $this->registerValidate($data);
      $property = new Property(...$data);
      $this->propertyDAO->register($property);

      return ['success' => $this->successMessages['user']['register']];
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  private function registerValidate(array $data)
  {
    $schema =
      v::key('street', v::stringType()
        ->length(10)
        ->setName('Rua'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('neighborhood', v::stringType()
        ->length(5)
        ->setName('Bairro'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('city', v::stringType()
        ->length(5)
        ->setName('Cidade'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('zip_code', v::postalCode('BR')
        ->setName('CEP'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('price', v::floatType()
        ->min(0)
        ->setName('Preço'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('total_area', v::floatType()
        ->min(0)
        ->setName('Área total'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('build_area', v::floatType()
        ->min(0)
        ->setName('Área construída'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('bedrooms', v::intType()
        ->min(0)
        ->setName('Quartos'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('bathrooms', v::intType()
        ->min(0)
        ->setName('Banheiros'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('garage', v::intType()
        ->min(0)
        ->setName('Garagens'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('owner_id', v::intType()
        ->min(1)
        ->setName('Proprietário'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('purpose_id', v::intType()
        ->min(1)
        ->setName('Propósito'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('property_type_id', v::intType()
        ->min(1)
        ->setName('Tipo de propriedade'))
      ->setTemplate("{{name}} é obrigatório");

    $schema->assert($data);
  }

  public function updateById(array $data, int $id)
  {
    try {
      $data = array_filter($data, fn($value) => $value !== '');
      $this->updateValidate($data);
      $property = new Property(...$data);
      $this->propertyDAO->updateById($property, $id);

      return ['success' => $this->successMessages['user']['update']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  private function updateValidate(array $data)
  {
    $schema =
      v::key('street', v::stringType()
        ->length(10)
        ->setName('Rua'), false)

      ->key('neighborhood', v::stringType()
        ->length(5)
        ->setName('Bairro'), false)

      ->key('city', v::stringType()
        ->length(5)
        ->setName('Cidade'), false)

      ->key('zip_code', v::postalCode('BR')
        ->setName('CEP'), false)

      ->key('price', v::floatType()
        ->min(0)
        ->setName('Preço'), false)

      ->key('total_area', v::floatType()
        ->min(0)
        ->setName('Área total'), false)

      ->key('build_area', v::floatType()
        ->min(0)
        ->setName('Área construída'), false)

      ->key('bedrooms', v::intType()
        ->min(0)
        ->setName('Quartos'), false)

      ->key('bathrooms', v::intType()
        ->min(0)
        ->setName('Banheiros'), false)

      ->key('garage', v::intType()
        ->min(0)
        ->setName('Garagens'), false)

      ->key('owner_id', v::intType()
        ->min(1)
        ->setName('Proprietário'), false)

      ->key('purpose_id', v::intType()
        ->min(1)
        ->setName('Propósito'), false)

      ->key('property_type_id', v::intType()
        ->min(1)
        ->setName('Tipo de propriedade'), false);

    $schema->assert($data);
  }

  public function deleteById($id)
  {
    try {
      $this->propertyDAO->deleteById($id);
      return ['success' => $this->successMessages['user']['delete']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }
}
