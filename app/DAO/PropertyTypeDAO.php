<?php

namespace App\DAO;

use App\DAO\Connection;

class PropertyTypeDAO extends Connection
{
  public function getAll()
  {
    return $this->select(
      table: 'property_type',
      className: \App\Models\PropertyType::class
    );
  }

  public function getById(int $id)
  {
    return $this->select(
      table: 'property_type',
      condition: 'where id = :id',
      values: ['id' => $id],
      className: \App\Models\PropertyType::class
    );
  }
}
