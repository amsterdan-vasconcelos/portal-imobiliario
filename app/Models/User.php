<?php

namespace App\Models;

use DateTime;

class User
{
  private ?int $id;
  private ?string $created_at;
  private ?string $updated_at;
  private ?string $access_profile;

  public function __construct(
    private ?string $name = null,
    private ?string $username = null,
    private ?string $email = null,
    private ?int $active = null,
    private ?string $password = null,
    private ?string $access_profile_id = null,
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

  public function getAccessProfileId()
  {
    return $this->access_profile_id;
  }

  public function getCreatedAt(?string $format = null)
  {
    if ($format && is_string($format)) {
      return (new DateTime($this->created_at))->format($format);
    }

    return $this->created_at;
  }

  public function getUpdatedAt(?string $format = null)
  {
    if ($format && is_string($format)) {
      return (new DateTime($this->updated_at))->format($format);
    }

    return $this->updated_at;
  }

  public function getAccessProfile()
  {
    return $this->access_profile;
  }

  public function toArray()
  {
    return [
      'name' => $this->name,
      'username' => $this->username,
      'email' => $this->email,
      'password' => $this->password,
      'access_profile_id' => $this->access_profile_id,
      'active' => $this->active
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
