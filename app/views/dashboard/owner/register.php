<?php
$existMessage = !empty($success) || !empty($error);
if ($existMessage) {
  $class = !empty($success) ? 'success' : 'error';
  $title = !empty($success)
    ? '<i class="fa-solid fa-check"></i> Sucesso:'
    : '<i class="fa-solid fa-circle-exclamation"></i> Erro:';
  $description = $success ?? $error;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/dashboard/index.css">
  <title>Dashboard - Adicionar Proprietário</title>
</head>

<body>
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
        <div class="c-form__item">
          <label class="c-label" for="name">Nome</label>
          <input
            class="c-input c-input--dashboard"
            type="text" id="name" name="name"
            autofocus>
        </div>
        <div class="c-form__item">
          <label class="c-label" for="phone">Telefone</label>
          <input
            class="c-input c-input--dashboard"
            type="tel" id="phone" name="phone">
        </div>

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
  <?php if ($existMessage): ?>
    <div class="c-modal__overlay">
      <div class="c-modal <?= $class ?>">
        <h2
          class="c-modal__title"><?= $title ?></h2>
        <p class="c-modal__description"><?= $description ?></p>
        <a class="c-modal__button" href="<?= BASE_URL ?>/dashboard/owner/register">Fechar</a>
      </div>
    </div>
  <?php endif; ?>
</body>

</html>