<?php

namespace App\DAO;

use App\DAO\Connection;

class AccessProfileDAO extends Connection
{
  public function getAll()
  {
    return $this->select(
      table: 'access_profile',
      className: \App\Models\AccessProfile::class
    );
  }

  public function getById(int $id)
  {
    return $this->select(
      table: 'access_profile',
      condition: 'where id = :id',
      values: ['id' => $id],
      className: \App\Models\AccessProfile::class
    );
  }
}
