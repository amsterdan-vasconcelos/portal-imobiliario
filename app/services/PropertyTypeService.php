<?php

namespace App\services;

use App\DAO\PropertyTypeDAO;

class PropertyTypeService
{
  public function __construct(
    private $propertyType = new PropertyTypeDAO
  ) {}

  public function getAll()
  {
    return $this->propertyType->getAll();
  }

  public function getById(int $id)
  {
    return $this->propertyType->getById($id);
  }
}
