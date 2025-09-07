<?php

namespace App\Controllers\DashboardModules;

use App\services\OwnerService;
use App\services\PropertyService;
use App\services\PropertyTypeService;
use App\services\PurposeService;

class DashboardPropertyController
{
  public function __construct(
    private PropertyService $propertyService,
    private PropertyTypeService $propertyTypeService,
    private PurposeService $purposeService,
    private OwnerService $ownerService
  ) {}

  public function handle(string $param, ?int $id): array
  {
    return match ($param) {
      'register' => $this->handleRegister(),
      'update'   => $this->handleUpdate($id),
      'delete'   => $this->handleDelete($id),
      'details'   => $this->handleDetails($id),
      default    => $this->handleIndex(),
    };
  }

  private function handleRegister()
  {
    $result = [];

    if ($_POST) {
      $result = $this->propertyService->register($_POST);
    }

    return [
      ...$result,
      'property_types' => $this->propertyTypeService->getAll(),
      'purposes' => $this->purposeService->getAll(),
      'owners' => $this->ownerService->getAll(),
    ];
  }

  private function handleUpdate(int $id): array
  {
    $result = [];

    if ($_POST) {
      $result = $this->propertyService->updateById($_POST, $id);
    }

    return [
      ...$result,
      'property' => $this->propertyService->getById($id)[0],
      'property_types' => $this->propertyTypeService->getAll(),
      'purposes' => $this->purposeService->getAll(),
      'owners' => $this->ownerService->getAll(),
    ];
  }

  private function handleDelete(int $id): array
  {
    $property = $this->propertyService->getById($id)[0];
    $property_type =
      $this->propertyTypeService->getById($property->property_type_id)[0];
    $purpose = $this->purposeService->getById($property->purpose_id)[0];
    $owner = $this->ownerService->getById($property->owner_id)[0];

    $property->property_type = $property_type->description;
    $property->purpose = $purpose->description;
    $property->owner = $owner->name;

    $result = ['property' => $property];

    if ($_POST) {
      $result = [
        ...$result,
        ...$this->propertyService->deleteById($id)
      ];
    }

    return $result;
  }

  private function handleDetails(): array
  {
    return [];
  }

  private function handleIndex(): array
  {
    $result = [];

    if ($_POST) {
      $result = $this->propertyService->updateById($_POST, $_POST['id']);
    }

    $properties = $this->propertyService->getAll();

    foreach ($properties as $property) {
      $property_type =
        $this->propertyTypeService->getById($property->property_type_id)[0];
      $purpose = $this->purposeService->getById($property->purpose_id)[0];
      $owner = $this->ownerService->getById($property->owner_id)[0];

      $property->property_type = $property_type->description;
      $property->purpose = $purpose->description;
      $property->owner = $owner->name;
    }

    return [...$result, 'properties' => $properties];
  }
}
