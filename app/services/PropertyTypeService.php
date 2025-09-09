<?php

namespace App\services;

use App\DAO\PropertyTypeDAO;

class PropertyTypeService
{
  public function __construct(
    private $propertyType = new PropertyTypeDAO
  ) {}

  /** @return PropertyType[] */
  public function getAll()
  {
    return $this->propertyType->getAll();
  }

  /** @return PropertyType */
  public function getById(int $id)
  {
    return $this->propertyType->getById($id)[0];
  }
}
