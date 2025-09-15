<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\Property;

class PropertyDAO extends Connection
{
  public function getAll()
  {
    $sql = '
    select p.*, 
        pt.description as property_type, 
        pu.description as purpose, 
        o.name as owner
    from property as p
    join property_type as pt
    on p.property_type_id = pt.id
    join purpose as pu
    on p.purpose_id = pu.id
    join owner as o
    on p.owner_id = o.id
    where p.user_id = :user_id
    order by id asc 
    ';

    return $this->select(
      sql: $sql,
      className: \App\Models\Property::class,
      values: ['user_id' => $_SESSION['user']['id']]
    );
  }

  public function getById(int $id)
  {
    $sql = '
    select p.*, 
    pt.description as property_type, 
    pu.description as purpose, 
    o.name as owner
    from property as p
    join property_type as pt
    on p.property_type_id = pt.id
    join purpose as pu
    on p.purpose_id = pu.id
    join owner as o
    on p.owner_id = o.id
    where p.id = :id
    ';

    return $this->select(
      sql: $sql,
      values: ['id' => $id],
      className: \App\Models\Property::class
    );
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
