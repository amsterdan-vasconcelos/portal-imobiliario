<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\Owner;

class OwnerDAO extends Connection
{
  public function getAll()
  {
    $isAdmin = $_SESSION['user']['access_profile'] === 'admin';

    if ($isAdmin) {
      return $this->select(
        table: 'owner',
        className: \App\Models\Owner::class
      );
    }

    return $this->select(
      table: 'owner',
      condition: 'where user_id = :user_id',
      values: ['user_id' => $_SESSION['user']['id']],
      className: \App\Models\Owner::class
    );
  }

  public function getById(int $id)
  {
    return $this->select(
      table: 'owner',
      condition: 'where id = :id',
      values: ['id' => $id],
      className: \App\Models\Owner::class
    );
  }

  public function register(Owner $owner)
  {
    return $this->insert('owner', $owner->areAttributesFilled());
  }

  public function updateById(Owner $owner, int $id)
  {
    return $this->update('owner', $owner->areAttributesFilled(), $id);
  }

  public function deleteById(int $id)
  {
    return $this->delete('owner', $id);
  }
}
