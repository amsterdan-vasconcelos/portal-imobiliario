<?php

namespace App\DAO;

use App\DAO\Connection;

class PropertyTypeDAO extends Connection
{
  public function getAll()
  {
    return $this->select('property_type');
  }

  public function getById(int $id)
  {
    return $this->select('property_type', 'where id = :id', ['id' => $id]);
  }
}
