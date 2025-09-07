<?php

namespace App\Models;

class Property
{
  public function __construct(
    private ?int $id = null,
    private ?string $code = null,
    private ?float $price = null,
    private ?string $zip_code = null,
    private ?string $street = null,
    private ?string $neighborhood = null,
    private ?string $city = null,
    private ?int $bedrooms = null,
    private ?int $bathrooms = null,
    private ?int $garage = null,
    private ?float $total_area = null,
    private ?float $build_area = null,
    private ?int $active = null,
    private ?int $owner_id = null,
    private ?int $purpose_id = null,
    private ?int $property_type_id = null,
    private ?string $created_at = null,
  ) {}

  public function getId()
  {
    return $this->id;
  }

  public function getCode()
  {
    return $this->code;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function getZipCode()
  {
    return $this->zip_code;
  }

  public function getStreet()
  {
    return $this->street;
  }

  public function getNeighborhood()
  {
    return $this->neighborhood;
  }

  public function getCity()
  {
    return $this->city;
  }

  public function getBedrooms()
  {
    return $this->bedrooms;
  }

  public function getBathrooms()
  {
    return $this->bathrooms;
  }

  public function getGarage()
  {
    return $this->garage;
  }

  public function getTotalArea()
  {
    return $this->total_area;
  }

  public function getBuildArea()
  {
    return $this->build_area;
  }

  public function getStatus()
  {
    return $this->active;
  }

  public function getOwnerId()
  {
    return $this->owner_id;
  }

  public function getPurposeId()
  {
    return $this->purpose_id;
  }

  public function getPropertyTypeId()
  {
    return $this->property_type_id;
  }

  public function getCreatedAt()
  {
    return $this->created_at;
  }

  public function toArray()
  {
    return [
      'id' => $this->id,
      'code' => $this->code,
      'price' => $this->price,
      'zip_code' => $this->zip_code,
      'street' => $this->street,
      'neighborhood' => $this->neighborhood,
      'city' => $this->city,
      'bedrooms' => $this->bedrooms,
      'bathrooms' => $this->bathrooms,
      'garage' => $this->garage,
      'total_area' => $this->total_area,
      'build_area' => $this->build_area,
      'active' => $this->active,
      'owner_id' => $this->owner_id,
      'purpose_id' => $this->purpose_id,
      'property_type_id' => $this->property_type_id,
      'created_at' => $this->created_at,
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
