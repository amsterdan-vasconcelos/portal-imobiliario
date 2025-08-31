<?php

namespace App\DAO;

use App\DAO\Connection;
use App\Models\Owner;

class OwnerDAO extends Connection
{
  public function register(Owner $owner)
  {
    return $this->insert('owner', $owner->areAttributesFilled());
  }
}
