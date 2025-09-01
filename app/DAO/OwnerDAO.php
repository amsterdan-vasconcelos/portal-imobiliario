<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\Owner;

class OwnerDAO extends Connection
{
  public function getAll()
  {
    return $this->select('owner');
  }

  public function getById(int $id)
  {
    return $this->select('owner', 'where id = :id', ['id' => $id]);
  }

  public function register(Owner $owner)
  {
    return $this->insert('owner', $owner->areAttributesFilled());
  }

  public function updateById(Owner $owner, int $id)
  {
    return $this->update('owner', $owner->areAttributesFilled(), $id);
  }
}
