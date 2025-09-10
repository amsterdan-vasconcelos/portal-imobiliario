<?php

namespace App\Models;

class Owner
{
  private ?int $id = null;

  public function __construct(
    private ?string $name = null,
    private ?string $phone = null,
    private ?string $gender = null,
    private ?int $active = null
  ) {}

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  public function getGender()
  {
    return $this->gender;
  }

  public function getActive()
  {
    return $this->active;
  }

  public function toArray()
  {
    return [
      'name' => $this->name,
      'phone' => $this->phone,
      'gender' => $this->gender,
      'active' => $this->active
    ];
  }

  public function areAttributesFilled()
  {
    return array_filter(
      $this->toArray(),
      fn($value) => $value !== null
    );
  }
}
