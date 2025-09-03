<?php

namespace App\Models;

class User
{
  public function __construct(
    private ?int $id = null,
    private ?string $name = null,
    private ?string $username = null,
    private ?string $email = null,
    private ?string $password = null,
    private ?bool $active = true,
    private ?string $profile_id = null,
    private ?string $created_at = null,
  ) {}

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getActive()
  {
    return $this->active;
  }

  public function getProfileId()
  {
    return $this->profile_id;
  }

  public function getCreatedAt()
  {
    return $this->created_at;
  }

  public function toArray()
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'username' => $this->username,
      'email' => $this->email,
      'password' => $this->password,
      'active' => $this->active === true ? 1 : 0,
      'profile_id' => $this->profile_id,
      'created_at' => $this->created_at,
    ];
  }

  public function areAttributesFilled()
  {
    return array_filter(
      $this->toArray(),
      fn($value) => $value !== null
    );
  }
}
