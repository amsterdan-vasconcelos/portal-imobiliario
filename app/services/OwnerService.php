<?php

namespace App\services;

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
    $name = $data['name'] ?? null;
    $phone = $data['phone'] ?? null;
    $gender = $data['gender'] ?? null;

    try {
      $this->validateName($name);
      $this->validatePhone($phone);
      $this->validateGender($gender);

      $owner = new Owner($name, $phone, $gender);

      $this->ownerDAO->register($owner);

      return ['success' => $this->successMessages['owner']['register']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public function updateById(array $data, int $id)
  {
    $name = $data['name'] ?? null;
    $phone = $data['phone'] ?? null;
    $gender = $data['gender'] ?? null;
    $active = $data['active'] ?? null;

    try {
      if ($name) $this->validateName($name);
      if ($phone) $this->validatePhone($phone);
      if ($gender) $this->validateGender($gender);
      if ($active) $this->validateActive($active);

      $owner = new Owner(
        name: $name,
        phone: $phone,
        gender: $gender,
        active: $active
      );

      $this->ownerDAO->updateById($owner, $id);

      return ['success' => $this->successMessages['owner']['update']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
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
