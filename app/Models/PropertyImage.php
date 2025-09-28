<?php

namespace App\Models;

class PropertyImage
{
  private ?int $id;

  public function __construct(
    private ?string $name = null,
    private ?string $path = null,
    private ?int $cover_image = null,
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

  public function getCoverImage()
  {
    return $this->cover_image;
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
      'cover_image' => $this->cover_image,
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
