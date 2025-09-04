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
  ];

  protected function validateName(?string $name)
  {
    if (!$name || mb_strlen(trim($name) < 3)) {
      throw new \InvalidArgumentException(
        'O nome é obrigatório e deve conter pelo menos 3 caracteres.'
      );
    }

    return trim($name);
  }

  protected function validatePhone(?string $phone)
  {
    if (!$phone || !preg_match('/^\d{4,5}-\d{4}$/', $phone)) {
      throw new \InvalidArgumentException('O telefone é inválido. Ex: 99999-9999');
    }

    return trim($phone);
  }

  protected function validateGender(?string $gender)
  {
    $gender = mb_strtoupper(trim($gender) ?? '');
    match ($gender) {
      'M', 'F' => null,
      default => throw new \InvalidArgumentException('O gênero deve ser M ou F.')
    };

    return $gender;
  }

  protected function validateActive(?string $active)
  {
    $active = mb_strtolower($active ?? '');
    return match ($active) {
      'true' => true,
      'false' => false,
      default => throw new \InvalidArgumentException(
        'O valor de ativo deve ser uma string "true" ou "false"'
      )
    };
  }

  protected function validateUsername(?string $username)
  {
    $username = trim($username);

    if (!$username || mb_strlen($username) < 5) {
      throw new \InvalidArgumentException(
        "O username é obrigatório e deve conter pelo menos 5 caracteres.\n" .
          "Ele deve ser composto apenas por letras minúsculas e underscores (_)."
      );
    }

    if (!preg_match('/^[a-z_]+$/', $username)) {
      throw new \InvalidArgumentException(
        "O username deve conter apenas letras minúsculas e underscores (_)."
      );
    }

    return $username;
  }

  protected function validateEmail(?string $email)
  {
    $email = trim($email);

    if (!$email) {
      throw new \InvalidArgumentException("O e-mail é obrigatório.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new \InvalidArgumentException("O e-mail fornecido é inválido.");
    }

    return $email;
  }

  protected function validatePassword(?string $password, ?string $confirm_password)
  {
    $password = trim($password);
    $confirm_password = trim($confirm_password);

    if (!$password || mb_strlen($password) < 8) {
      throw new \InvalidArgumentException(
        'A senha é obrigatório e deve conter pelo menos 8 caracteres.'
      );
    }

    if ($password !== $confirm_password) {
      throw new \InvalidArgumentException(
        'As senhas devem coincidir.'
      );
    }

    return $password;
  }

  protected function validateProfileId(?int $profile_id)
  {
    if (!filter_var($profile_id, FILTER_VALIDATE_INT)) {
      throw new \InvalidArgumentException("Perfil de acesso inválido.");
    }

    return (int) $profile_id;
  }
}
