<?php

namespace App\Models;

class AccessProfile
{
  public function __construct(
    private ?int $id = null,
    private ?string $description = null
  ) {}

  public function getId()
  {
    return $this->id;
  }

  public function getDescription()
  {
    return $this->description;
  }
}
