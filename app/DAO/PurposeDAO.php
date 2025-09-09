<?php

namespace App\DAO;

use App\DAO\Connection;

class PurposeDAO extends Connection
{
  public function getAll()
  {
    return $this->select(
      table: 'purpose',
      className: \App\Models\Purpose::class
    );
  }

  public function getById(int $id)
  {
    return $this->select(
      table: 'purpose',
      condition: 'where id = :id',
      values: ['id' => $id],
      className: \App\Models\Purpose::class
    );
  }
}
