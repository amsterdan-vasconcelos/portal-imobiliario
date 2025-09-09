<?php

namespace App\services;

use App\DAO\PurposeDAO;

class PurposeService
{
  public function __construct(
    private $purpose = new PurposeDAO()
  ) {}

  /** @return Purpose[] */
  public function getAll()
  {
    return $this->purpose->getAll();
  }

  /** @return Purpose */
  public function getById(int $id)
  {
    return $this->purpose->getById($id)[0];
  }
}
