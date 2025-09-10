<?php

namespace App\services;

class Services
{
  protected array $successMessages = [
    'owner' => [
      'register' => 'Proprietário adicionado com sucesso!',
      'update'   => 'Proprietário atualizado com sucesso!',
      'delete'   => 'Proprietário removido com sucesso!',
    ],
    'user' => [
      'register' => 'Usuário adicionado com sucesso!',
      'update'   => 'Usuário atualizado com sucesso!',
      'delete'   => 'Usuário removido com sucesso!',
    ],
    'property' => [
      'register' => 'Imóvel adicionado com sucesso!',
      'update'   => 'Imóvel atualizado com sucesso!',
      'delete'   => 'Imóvel removido com sucesso!',
    ],
  ];
}
