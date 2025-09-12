<?php

namespace App\Models;

class PropertyImage
{
  private ?int $id;

  public function __construct(
    private ?string $name = null,
    private ?string $path = null,
    private ?string $property_id = null
  ) {}

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getPath()
  {
    return $this->path;
  }

  public function getPropertyId()
  {
    return $this->property_id;
  }

  public function toArray()
  {
    return [
      'name' => $this->name,
      'path' => $this->path,
      'property_id' => $this->property_id,
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
