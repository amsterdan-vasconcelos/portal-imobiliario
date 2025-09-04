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
    try {
      $name = $this->validateName($data['name'] ?? null);
      $phone = $this->validatePhone($data['phone'] ?? null);
      $gender = $this->validateGender($data['gender'] ?? null);

      $owner = new Owner($name, $phone, $gender);

      $this->ownerDAO->register($owner);

      return ['success' => $this->successMessages['owner']['register']];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public function updateById(array $data, int $id)
  {
    try {
      $name = $data['name'] ?? null;
      $name = $name ? $this->validateName($name) : $name;

      $phone = $data['phone'] ?? null;
      $phone = $phone ? $this->validatePhone($phone) : $name;

      $gender = $data['gender'] ?? null;
      $gender = $gender ? $this->validateGender($gender) : $name;

      $active = $data['active'] ?? null;
      $active = $active ? $this->validateActive($active) : $name;


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
