<?php

class Owner
{
  public function __construct(
    private ?int $id,
    private string $name,
    private string $contact,
    private string $sex,
    private ?bool $active
  ) {}

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getContact()
  {
    return $this->contact;
  }

  public function getSex()
  {
    return $this->sex;
  }

  public function getActive()
  {
    return $this->active;
  }

  public function toArray()
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'contact' => $this->contact,
      'sex' => $this->sex,
      'active' => $this->active,
    ];
  }

  public function areAttributesFilled()
  {
    return array_filter(
      $this->toArray(),
      fn($value) => $value !== null && $value !== ''
    );
  }
}
