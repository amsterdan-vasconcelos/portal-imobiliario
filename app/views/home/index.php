<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../shared/head.php' ?>
  <title>Página Principal</title>
</head>

<body>
  <?php require_once __DIR__ . '/../shared/header.php' ?>
  <?php require_once __DIR__ . '/partials/hero.php' ?>
  <?php require_once __DIR__ . '/partials/cta.php' ?>
  <?php require_once __DIR__ . '/partials/buy.php' ?>
  <?php require_once __DIR__ . '/partials/rent.php' ?>
  <?php require_once __DIR__ . '/partials/testimonials.php' ?>
  <?php require_once __DIR__ . '/partials/contact.php' ?>

  <h1>Página Principal</h1>
  <p>Nome: <?= $name ?></p>
  <p>Idade: <?= $age ?></p>
</body>

</html>