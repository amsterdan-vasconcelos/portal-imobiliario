<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\Property;

class PropertyDAO extends Connection
{
  public function getAll()
  {
    return $this->select('property');
  }

  public function getById(int $id)
  {
    return $this->select('property', 'where id = :id', ['id' => $id]);
  }

  public function register(Property $property)
  {
    return $this->insert('property', $property->areAttributesFilled());
  }

  public function updateById(Property $property, int $id)
  {
    return $this->update('property', $property->areAttributesFilled(), $id);
  }

  public function deleteById(int $id)
  {
    return $this->delete('property', $id);
  }
}
