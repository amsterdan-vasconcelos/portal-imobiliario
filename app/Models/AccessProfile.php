<?php

namespace App\Models;

class AccessProfile
{
  private ?int $id;

  public function __construct(
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
