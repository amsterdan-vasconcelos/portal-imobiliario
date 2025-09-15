<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\User;

class UserDAO extends Connection
{
  public function getAll()
  {
    $sql = '
    select u.*, 
    ap.description as access_profile 
    from user as u 
    join access_profile as ap 
    on u.access_profile_id = ap.id
    ';

    return $this->select(
      sql: $sql,
      className: \App\Models\User::class
    );
  }

  public function getById(int $id)
  {
    $sql = '
    select u.*, 
    ap.description as access_profile 
    from user as u 
    join access_profile as ap 
    on u.access_profile_id = ap.id
    where u.id = :id
    ';

    return $this->select(
      sql: $sql,
      values: ['id' => $id],
      className: \App\Models\User::class
    );
  }

  public function getByUsername(string $username)
  {
    $sql = '
      select u.*, ap.description as access_profile
      from user u
      join access_profile ap
      on u.access_profile_id = ap.id
      where u.username = :username
    ';

    return $this->select(
      sql: $sql,
      values: ['username' => $username],
      className: \App\Models\User::class
    );
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
