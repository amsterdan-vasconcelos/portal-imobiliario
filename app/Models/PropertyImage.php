<?php

namespace App\Models;

class PropertyImage
{
  private ?int $id;

  public function __construct(
    private ?string $image = null,
    private ?string $property_id = null
  ) {}

  public function getId()
  {
    return $this->id;
  }

  public function getImage()
  {
    return $this->image;
  }

  public function getPropertyId()
  {
    return $this->image;
  }

  public function toArray()
  {
    return [
      'image' => $this->image,
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
