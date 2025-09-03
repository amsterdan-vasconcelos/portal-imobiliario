<?php

namespace App\services;

use App\DAO\AccessProfileDAO;

class AccessProfileService
{
  public function __construct(
    private $access_profile = new AccessProfileDAO()
  ) {}

  public function getAll()
  {
    return $this->access_profile->getAll();
  }

  public function getById(int $id)
  {
    return $this->access_profile->getById($id);
  }
}
