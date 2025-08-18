<?php

namespace App\Models;

class User
{
  public function getUserData(): array
  {
    return ['name' => 'Amsterdan', 'age' => 28];
  }
}
