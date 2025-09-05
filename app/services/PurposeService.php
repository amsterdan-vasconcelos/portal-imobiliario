<?php

namespace App\services;

use App\DAO\PurposeDAO;

class PurposeService
{
  public function __construct(
    private $purpose = new PurposeDAO()
  ) {}

  public function getAll()
  {
    return $this->purpose->getAll();
  }

  public function getById(int $id)
  {
    return $this->purpose->getById($id);
  }
}
