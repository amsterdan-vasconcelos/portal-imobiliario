<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\User;

class UserDAO extends Connection
{
  public function getAll()
  {
    return $this->select('user');
  }

  public function getById(int $id)
  {
    return $this->select('user', 'where id = :id', ['id' => $id]);
  }

  public function register(User $user)
  {
    return $this->insert('user', $user->areAttributesFilled());
  }

  public function updateById(User $user, int $id)
  {
    return $this->update('user', $user->areAttributesFilled(), $id);
  }

  public function deleteById(int $id)
  {
    return $this->delete('user', $id);
  }
}
