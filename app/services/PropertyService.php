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

  /** @return Property[] */
  public function getAll(): array
  {
    return $this->propertyDAO->getAll();
  }

  /** @return Property */
  public function getById(int $id)
  {
    return $this->propertyDAO->getById($id)[0];
  }

  public function register(array $data)
  {
    try {
      $data = array_filter($data, fn($value) => $value !== '');
      $this->registerValidate($data);
      $data['user_id'] = $_SESSION['user']['id'];
      $property = new Property(...$data);
      $id = $this->propertyDAO->register($property);

      return [
        'id' => $id,
        'success' => $this->successMessages['property']['register']
      ];
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessages()];
    }
  }

  private function registerValidate(array $data)
  {
    $schema =
      v::key('street', v::stringType()
        ->length(5)->setTemplate("{{name}} deve ter pelo menos 5 caracteres.")
        ->setName('Rua'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('neighborhood', v::stringType()
        ->length(5)->setTemplate("{{name}} deve ter pelo menos 5 caracteres.")
        ->setName('Bairro'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('city', v::stringType()
        ->length(5)->setTemplate("{{name}} deve ter pelo menos 5 caracteres.")
        ->setName('Cidade'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('zip_code', v::postalCode('BR')
        ->setName('CEP'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('price', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Preço'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('total_area', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Área total'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('build_area', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Área construída'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('bedrooms', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Quartos'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('bathrooms', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Banheiros'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('garage', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Garagens'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('owner_id', v::numericVal()
        ->min(1)->setTemplate("Id inválido.")
        ->setName('Proprietário'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('purpose_id', v::numericVal()
        ->min(1)->setTemplate("Id inválido.")
        ->setName('Propósito'))
      ->setTemplate("{{name}} é obrigatório")

      ->key('property_type_id', v::numericVal()
        ->min(1)->setTemplate("Id inválido.")
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

      return ['success' => $this->successMessages['property']['update']];
    } catch (NestedValidationException $e) {
      return ['error' => $e->getMessages()];
    }
  }

  private function updateValidate(array $data)
  {
    $schema =
      v::key('street', v::stringType()
        ->length(5)->setTemplate("{{name}} deve ter pelo menos 5 caracteres.")
        ->setName('Rua'), false)

      ->key('neighborhood', v::stringType()
        ->length(5)->setTemplate("{{name}} deve ter pelo menos 5 caracteres.")
        ->setName('Bairro'), false)

      ->key('city', v::stringType()
        ->length(5)->setTemplate("{{name}} deve ter pelo menos 5 caracteres.")
        ->setName('Cidade'), false)

      ->key('zip_code', v::postalCode('BR')
        ->setName('CEP'), false)

      ->key('price', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Preço'), false)

      ->key('total_area', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Área total'), false)

      ->key('build_area', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Área construída'), false)

      ->key('bedrooms', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Quartos'), false)

      ->key('bathrooms', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Banheiros'), false)

      ->key('garage', v::numericVal()
        ->min(0)->setTemplate("Valor mínimo de {{name}} é 0.")
        ->setName('Garagens'), false)

      ->key('owner_id', v::numericVal()
        ->min(1)->setTemplate("Id inválido para {{name}}.")
        ->setName('Proprietário'), false)

      ->key('purpose_id', v::numericVal()
        ->min(1)->setTemplate("Id inválido para {{name}}.")
        ->setName('Propósito'), false)

      ->key('property_type_id', v::numericVal()
        ->min(1)->setTemplate("Id inválido para {{name}}.")
        ->setName('Tipo de propriedade'), false)

      ->key('active', v::numericVal()
        ->in([0, 1])
        ->setTemplate("Valor iválido para {{name}}.")
        ->setName('Ativo'), false);

    $schema->assert($data);
  }

  public function deleteById($id)
  {
    try {
      $this->propertyDAO->deleteById($id);
      return ['success' => $this->successMessages['property']['delete']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }
}
