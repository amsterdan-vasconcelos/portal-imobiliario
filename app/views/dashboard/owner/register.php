<?php
require_once __DIR__ . '/../partials/alert.php';
require_once __DIR__ . '/../partials/input.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Adicionar Proprietário</title>
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
        <h1 class="c-dashboard-header__title">Adicionar Proprietário</h1>
      </div>

      <form
        class="c-form c-form--dashboard"
        action="<?= BASE_URL ?>/dashboard/owner/register" method="post">

        <?= Input(
          type: 'text',
          name: 'name',
          label: 'Nome',
          required: true,
          attrs: ['autofocus' => 'true']
        ) ?>

        <?= Input(
          type: 'tel',
          name: 'phone',
          label: 'Telefone',
          required: true,
        ) ?>

        <fieldset class="c-fieldset">
          <legend class="c-fieldset__legend">Gênero</legend>
          <div class="c-fieldset__item">
            <label class="c-label" for="F">Femino</label>
            <input type="radio" name="gender" id="F" value="F">
          </div>
          <div class="c-fieldset__item">
            <label class="c-label" for="M">Masculino</label>
            <input type="radio" name="gender" id="M" value="M">
          </div>
        </fieldset>

        <button
          class="c-button c-button--dashboard c-button--1/2"
          type="submit">
          Adicionar
        </button>
      </form>

    </div>
  </div>
</body>

</html>