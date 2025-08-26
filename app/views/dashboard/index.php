<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../shared/head.php' ?>
  <title>Dashboard</title>
</head>

<body>
  <?php require_once __DIR__ . '/../shared/header.php' ?>
  <div class="l-dashboard">
    <nav class="c-sidebar">
      <div class="c-sidebar__header">Seja bem vindo Usuário!</div>
      <ul class="c-sidebar__content">
        <a href="">
          <li class="c-sidebar__item">
            <i class="fa-solid fa-user-tie"></i>
            Proprietário
          </li>
        </a>
        <a href="">
          <li class="c-sidebar__item">
            <i class="fa-solid fa-building"></i>
            Imóvel
          </li>
        </a>
        <a href="">
          <li class="c-sidebar__item">
            <i class="fa-solid fa-user"></i>
            Usuário
          </li>
        </a>
      </ul>
      <div class="c-sidebar__footer">
        <a class="c-button c-button--full c-button--logout" href="">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          Logout
        </a>
      </div>
    </nav>
    <div>
    </div>
  </div>
</body>

</html>