<?php

namespace App\Controllers\DashboardModules;

use App\services\OwnerService;
use App\services\PropertyImageService;
use App\services\PropertyService;
use App\services\PropertyTypeService;
use App\services\PurposeService;

class DashboardPropertyController
{
  public function __construct(
    private PropertyService $propertyService,
    private PropertyTypeService $propertyTypeService,
    private PurposeService $purposeService,
    private OwnerService $ownerService,
    private PropertyImageService $propertyImageService
  ) {}

  public function handle(string $param, ?int $id): array
  {
    return match ($param) {
      'register' => $this->handleRegister(),
      'update'   => $this->handleUpdate($id),
      'delete'   => $this->handleDelete($id),
      'details'   => $this->handleDetails($id),
      default    => $this->handleIndex($id),
    };
  }

  private function handleRegister()
  {
    $result = [];

    if ($_POST) {
      $response = $this->propertyService->register($_POST);

      if (isset($_FILES['images'])) {
        $result = $this->propertyImageService->uploadMultiple(
          $_FILES['images'],
          $response['id']
        );
      }

      unset($response['id']);
      $result = [...$result, $response];
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
      'property' => $this->propertyService->getById($id),
      'property_types' => $this->propertyTypeService->getAll(),
      'purposes' => $this->purposeService->getAll(),
      'owners' => $this->ownerService->getAll(),
    ];
  }

  private function handleDelete(int $id): array
  {
    $property = $this->propertyService->getById($id);

    $result = ['property' => $property];

    if ($_POST) {
      $result = [
        ...$result,
        ...$this->propertyService->deleteById($id)
      ];
    }

    return $result;
  }

  private function handleDetails(int $id): array
  {
    $property = $this->propertyService->getById($id);

    return ['property' => $property];
  }

  private function handleIndex(?int $id): array
  {
    $result = [];

    if ($_POST) {
      $result = $this->propertyService->updateById($_POST, $id);
    }

    $properties = $this->propertyService->getAll();

    return [...$result, 'properties' => $properties];
  }
}
