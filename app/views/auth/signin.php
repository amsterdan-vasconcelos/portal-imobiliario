<?php
require_once __DIR__ . '/../dashboard/partials/input.php';
require_once __DIR__ . '/../dashboard/partials/alert.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../shared/head.php' ?>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/home/index.css">
  <title>Login - Faça seu login</title>
</head>

<body>
  <?= Alert(error: $error ?? null) ?>

  <?php require_once __DIR__ . '/../shared/header.php' ?>

  <section
    style="
    position: relative;
    min-height: calc(100svh - (var(--footer-height) + var(--header-height)));">
    <form
      action="<?= BASE_URL . '/auth/signin' ?>"
      method="post"
      style="
      background-color: var(--color-surface);
      border: 1px solid var(--color-border);
      padding: 1rem 2.5rem 2.5rem;
      border-radius: 1rem;
      position: absolute;
      inset: 0;
      width: fit-content;
      height: fit-content;
      margin: auto;" class="l-form">
      <h1 class="c-label" style="text-align: center;">Login</h1>
      <?= Input(
        type: 'text',
        name: 'username',
        label: 'Username',
        required: true,
        attrs: ['autofocus' => true]
      ) ?>
      <?= Input(
        type: 'password',
        name: 'password',
        label: 'Senha',
        required: true,
      ) ?>

      <button class="c-button c-button--dashboard" type="submit">
        Entrar
      </button>
    </form>
  </section>

  <?php require_once __DIR__ . '/../shared/footer.php' ?>
</body>

</html>