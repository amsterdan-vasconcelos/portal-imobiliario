<?php
require_once __DIR__ . '/../partials/alert.php';
require_once __DIR__ . '/../partials/input.php';
require_once __DIR__ . '/../partials/radio.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Atualizar Proprietário</title>
</head>

<body>
  <?= Alert(
    success: $success ?? null,
    error: $error ?? null
  ) ?>

  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Atualizar Proprietário</h1>
      </div>

      <form
        class="l-form l-form--col-2"
        action="/dashboard/owner/update/<?= $owner->getId() ?>"
        method="post">
        <?= Input(
          type: 'text',
          name: 'name',
          label: 'Nome',
          value: $owner->getName(),
          required: true,
          attrs: ['autofocus' => 'true']
        ) ?>

        <?= Input(
          type: 'tel',
          name: 'phone',
          label: 'Telefone',
          value: $owner->getPhone(),
          required: true,
        ) ?>

        <fieldset class="c-fieldset c-fieldset--col-2">
          <legend class="c-fieldset__legend">Gênero</legend>
          <?= Radio(
            name: 'gender',
            id: 'F',
            label: 'Feminino',
            value: 'F',
            checked: $owner->getGender() === 'F',
            required: true,
          ) ?>

          <?= Radio(
            name: 'gender',
            id: 'M',
            label: 'Masculino',
            value: 'M',
            checked: $owner->getGender() === 'M',
            required: true,
          ) ?>
        </fieldset>

        <button
          style="grid-column: 1 / 2;"
          class="c-button c-button--dashboard"
          type="submit">
          Atualizar
        </button>
      </form>

    </div>
  </div>
</body>

</html>