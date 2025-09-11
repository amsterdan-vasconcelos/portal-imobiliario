<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\PropertyImage;

class PropertyImageDAO extends Connection
{
  public function getAll(string|int $propertyId)
  {
    return $this->select(
      table: 'property_image',
      condition: "where id = :id",
      values: ['id' => $propertyId],
      className: \App\Models\PropertyImage::class
    );
  }

  public function getById(int $id)
  {
    return $this->select(
      table: 'property_image',
      condition: 'where id = :id',
      values: ['id' => $id],
      className: \App\Models\PropertyImage::class
    );
  }

  public function register(PropertyImage $propertyImage)
  {
    return $this->insert('property_image', $propertyImage->areAttributesFilled());
  }

  public function updateById(PropertyImage $propertyImage, int $id)
  {
    return $this->update('property_image', $propertyImage->areAttributesFilled(), $id);
  }

  public function deleteById(int $id)
  {
    return $this->delete('property_image', $id);
  }
}
