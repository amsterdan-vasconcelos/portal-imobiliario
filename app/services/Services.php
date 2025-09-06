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

  protected function validatePhone(
    ?string $value,
    string $fieldName = 'Telefone',
    bool $required = true
  ): ?string {
    $errors = [];

    if ($required && $value === null) {
      $errors[] = "$fieldName é obrigatório.";
    }

    if (!$required && $value === null) {
      return $value;
    }

    $value = trim((string) $value);

    $numericPhone = preg_replace('/\D/', '', $value);

    if (!in_array(strlen($numericPhone), [10, 11])) {
      $errors[] = "$fieldName deve conter 10 ou 11 dígitos (com DDD).";
    }

    if (strlen($numericPhone) === 11 && $numericPhone[2] !== '9') {
      $errors[] = "$fieldName parece ser celular, mas não começa com 9.";
    }

    $ddd = substr($numericPhone, 0, 2);
    if (!preg_match('/^[1-9]{2}$/', $ddd)) {
      $errors[] = "$fieldName possui DDD inválido.";
    }

    if (!empty($errors)) {
      throw new \InvalidArgumentException(implode(' ', $errors));
    }

    return $numericPhone;
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

  protected function validateInt(?string $intNumber, string $idType)
  {
    if (!filter_var($intNumber, FILTER_VALIDATE_INT)) {
      throw new \InvalidArgumentException("$idType inválido.");
    }

    return (int) $intNumber;
  }

  protected function validateFloat(?string $value, string $fieldName)
  {
    $normalized = str_replace(',', '.', $value);

    if (!filter_var($normalized, FILTER_VALIDATE_FLOAT)) {
      throw new \InvalidArgumentException("$fieldName inválido.");
    }

    return (float) $normalized;
  }

  protected function validateString(
    ?string $value,
    string $fieldName,
    bool $required = true,
    int $minLength = 0,
    int $maxLength = 255,
    ?string $pattern = null
  ): ?string {
    $errors = [];

    if ($required && $value === null) {
      $errors[] = "$fieldName é obrigatório.";
    }

    if (!$required && $value === null) {
      return $value;
    }

    $value = trim((string) $value);
    $length = mb_strlen($value);

    if ($length < $minLength) {
      $errors[] = "$fieldName deve ter pelo menos $minLength caracteres.";
    }

    if ($length > $maxLength) {
      $errors[] = "$fieldName deve ter no máximo $maxLength caracteres.";
    }

    if ($pattern && !preg_match($pattern, $value)) {
      $errors[] = "$fieldName está em um formato inválido.";
    }

    if (!empty($errors)) {
      throw new \InvalidArgumentException(implode(' ', $errors));
    }

    return $value;
  }

  protected function validateZipCode(
    ?string $value,
    string $fieldName = 'CEP',
    bool $required = true
  ): ?string {
    $errors = [];

    if ($required && $value === null) {
      $errors[] = "$fieldName é obrigatório.";
    }

    if (!$required && $value === null) {
      return $value;
    }

    $value = trim((string) $value);
    $numericZip = preg_replace('/\D/', '', $value);

    if (strlen($numericZip) !== 8) {
      $errors[] = "$fieldName deve conter exatamente 8 dígitos numéricos.";
    }

    $pattern = '/^\d{5}-?\d{3}$/';
    if (!preg_match($pattern, $value)) {
      $errors[] = "$fieldName deve estar no formato 99999-999 ou 99999999.";
    }

    if (!empty($errors)) {
      throw new \InvalidArgumentException(implode(' ', $errors));
    }

    return substr($numericZip, 0, 5) . '-' . substr($numericZip, 5, 3);
  }
}
