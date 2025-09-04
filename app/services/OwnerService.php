<?php

namespace App\services;

use App\DAO\OwnerDAO;
use App\Models\Owner;

class OwnerService
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

      return ['success' => 'Proprietário adicionado com sucesso!'];
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

      return ['success' => 'Proprietário atualizado com sucesso!'];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public function deleteById($id)
  {
    try {
      $this->ownerDAO->deleteById($id);
      return ['success' => 'Proprietário deletado com sucesso!'];
    } catch (\InvalidArgumentException $e) {
      return ['error' => $e->getMessage()];
    }
  }

  private function validateName(?string $name)
  {
    if (!$name || mb_strlen(trim($name) < 3)) {
      throw new \InvalidArgumentException(
        'O nome é obrigatório e deve conter pelo menos 3 caracteres.'
      );
    }
  }

  private function validatePhone(?string $phone)
  {
    if (!$phone || !preg_match('/^\d{4,5}-\d{4}$/', $phone)) {
      throw new \InvalidArgumentException('O telefone é inválido. Ex: 99999-9999');
    }
  }

  private function validateGender(?string $gender)
  {
    $gender = strtoupper($gender ?? '');
    match ($gender) {
      'M', 'F' => null,
      default => throw new \InvalidArgumentException('O gênero deve ser M ou F.')
    };
  }

  private function validateActive(?string $active)
  {
    $active = mb_strtolower($active ?? '');
    match ($active) {
      '1', '0' => null,
      default => throw new \InvalidArgumentException('O gênero deve ser M ou F.')
    };
  }
}
