<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/dashboard/index.css">
  <title>Dashboard - Registrar Proprietário</title>
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

      <form class="c-form c-form--dashboard">
        <div class="c-form__item">
          <label class="c-label" for="">Nome</label>
          <input class="c-input c-input--dashboard" type="text">
        </div>
        <div class="c-form__item">
          <label class="c-label" for="">Contato</label>
          <input class="c-input c-input--dashboard" type="text">
        </div>

        <fieldset class="c-fieldset">
          <legend class="c-fieldset__legend">Gênero</legend>
          <div class="c-fieldset__item">
            <label class="c-label" for="">Femino</label>
            <input type="radio" name="" id="">
          </div>
          <div class="c-fieldset__item">
            <label class="c-label" for="">Masculino</label>
            <input type="radio" name="" id="">
          </div>
        </fieldset>

        <button class="c-button c-button--dashboard c-button--1/2" type="submit">Adicionar</button>
      </form>

    </div>
  </div>
</body>

</html>