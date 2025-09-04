<?php

namespace App\Models;

class Owner
{
  public function __construct(
    private ?string $name = null,
    private ?string $phone = null,
    private ?string $gender = null,
    private ?int $id = null,
    private ?bool $active = null
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
      'id' => $this->id,
      'name' => $this->name,
      'phone' => $this->phone,
      'gender' => $this->gender,
      'active' => $this->active === true ? 1 : (
        $this->active === false ? 0 : null
      )
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
