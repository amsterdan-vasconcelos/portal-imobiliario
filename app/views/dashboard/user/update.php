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
  <title>Dashboard - Atualizar Usuário</title>
</head>

<body>
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
        class="c-form c-form--dashboard"
        action="<?= BASE_URL ?>/dashboard/user/update/<?= $user->id ?>" method="post">
        <div class="c-form__item">
          <label class="c-label" for="name">Nome</label>
          <input
            class="c-input c-input--dashboard"
            type="text" id="name" name="name"
            value="<?= $user->name ?>"
            autofocus>
        </div>
        <div class="c-form__item">
          <label class="c-label" for="username">Username</label>
          <input
            class="c-input c-input--dashboard"
            type="text" id="username" name="username"
            value="<?= $user->username ?>">
        </div>
        <div class="c-form__item">
          <label class="c-label" for="email">Email</label>
          <input
            class="c-input c-input--dashboard"
            type="email" id="email" name="email"
            value="<?= $user->email ?>">
        </div>
        <div class="c-form__item">
          <label class="c-label" for="access_profile">Perfil de acesso</label>
          <select class="c-select c-select--dashboard" name="profile_id" id="access_profile">
            <option
              class="c-select__option c-select__option--placeholder"
              disabled value="">
              -- selecione --
            </option>
            <?php foreach ($access_profiles as $access_profile): ?>
              <option
                class="c-select__option"
                <?= $user->profile_id === $access_profile->id ? 'selected' : '' ?>
                value="<?= $access_profile->id ?>">
                <?= ucfirst($access_profile->description) ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <button
          class="c-button c-button--dashboard c-button--1/2"
          type="submit">
          Atualizar
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
        <a class="c-modal__button" href="<?= BASE_URL . '/dashboard/user/update/' . $user->id ?>">Fechar</a>
      </div>
    </div>
  <?php endif; ?>
</body>

</html>