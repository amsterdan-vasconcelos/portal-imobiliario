<?php

namespace App\DAO;

use App\DAO\Connection;

class PurposeDAO extends Connection
{
  public function getAll()
  {
    return $this->select('purpose');
  }

  public function getById(int $id)
  {
    return $this->select('purpose', 'where id = :id', ['id' => $id]);
  }
}
