<?php

namespace App\DAO;

use App\DAO\Connection;

class AccessProfileDAO extends Connection
{
  public function getAll()
  {
    return $this->select('access_profile');
  }

  public function getById(int $id)
  {
    return $this->select('access_profile', 'where id = :id', ['id' => $id]);
  }
}
