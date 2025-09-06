<nav class="c-sidebar">
  <div class="c-sidebar__header">Seja bem vindo Usuário!</div>
  <ul class="c-sidebar__content">
    <a href="<?= BASE_URL ?>/dashboard/owner">
      <li class="c-sidebar__item">
        <i class="fa-solid fa-user-tie"></i>
        Proprietário
      </li>
    </a>
    <a href="<?= BASE_URL ?>/dashboard/property">
      <li class="c-sidebar__item">
        <i class="fa-solid fa-building"></i>
        Imóvel
      </li>
    </a>
    <a href="<?= BASE_URL ?>/dashboard/user">
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