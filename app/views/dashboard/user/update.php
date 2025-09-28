<?php
require_once __DIR__ . '/../partials/alert.php';
require_once __DIR__ . '/../partials/input.php';
require_once __DIR__ . '/../partials/select.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Atualizar Usuário</title>
</head>

<body>
  <?= Alert(
    success: $success ?? null,
    error: $error ?? null,
  ) ?>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Atualizar Usuário</h1>
      </div>

      <form
        class="l-form l-form--col-2"
        action="/dashboard/user/update/<?= $user->getId() ?>"
        method="post">

        <fieldset class="c-fieldset c-fieldset--col-2 l-form__item-span-2">
          <legend class="c-fieldset__legend">Informações do usuário</legend>

          <?= Input(
            type: 'text',
            name: 'name',
            label: 'Nome',
            value: ucfirst($user->getName()),
            required: true,
            attrs: ['autofocus' => 'true']
          ) ?>

          <?= Input(
            type: 'text',
            name: 'username',
            label: 'Username',
            value: $user->getUsername(),
            required: true
          ) ?>

          <?= Input(
            type: 'email',
            name: 'email',
            label: 'Email',
            value: $user->getEmail(),
            required: true
          ) ?>

          <?= Select(
            options: $access_profiles,
            name: 'access_profile_id',
            id: 'access_profile',
            label: 'Perfil de acesso',
            value: $user->getAccessProfileId(),
            optionLabel: fn($ap) => ucfirst($ap->getDescription()),
            optionValue: fn($ap) => $ap->getId(),
            required: true
          ) ?>

        </fieldset>
        <button
          class="c-button c-button--dashboard"
          type="submit">
          Atualizar
        </button>
      </form>

    </div>
  </div>
</body>

</html>