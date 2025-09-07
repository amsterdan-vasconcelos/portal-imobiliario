<?php
$classActiveIcon = $user->active
  ? 'fa-solid fa-circle active'
  : 'fa-solid fa-square inactive';

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
  <title>Dashboard - Deletar Usuário</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Usuário</h1>
      </div>

      <table class="c-table">
        <caption class="c-table__caption">Tem certeza que deseja deletar este usuário?</caption>
        <thead class="c-table__header">
          <tr class="c-table__row">
            <th class="c-table__head" scope="col">Nome</th>
            <th class="c-table__head" scope="col">Username</th>
            <th class="c-table__head" scope="col">Email</th>
            <th class="c-table__head" scope="col">Perfil de acesso</th>
            <th class="c-table__head" scope="col">Ativo</th>
            <th class="c-table__head" scope="col">Criado em</th>
          </tr>
        </thead>
        <tbody class="c-table__body">
          <tr class="c-table__row">
            <th class="c-table__head" scope="row"><?= $user->name ?></td>
            <td class="c-table__cell"><?= $user->username ?></td>
            <td class="c-table__cell"><?= $user->email ?></td>
            <td class="c-table__cell"><?= $user->access_profile ?></td>
            <td class="c-table__cell">
              <i class="<?= $classActiveIcon ?>"></i>
            </td>
            <td class="c-table__cell"><?= $user->created_at ?></td>
          </tr>
        </tbody>
      </table>
      <div>
        <form style="display: flex; gap: .5rem; padding-top: 1rem;" action="<?= BASE_URL . '/dashboard/user/delete/' . $user->id ?>" method="post">
          <a class="c-button c-button--dashboard c-button--full" href="<?= BASE_URL ?>/dashboard/user">Não</a>
          <input type="hidden" name="delete">
          <button class="c-button c-button--dashboard c-button--full">Sim</button>
        </form>
      </div>
    </div>
  </div>
  <?php if ($existMessage): ?>
    <div class="c-modal__overlay">
      <div class="c-modal <?= $class ?>">
        <h2
          class="c-modal__title"><?= $title ?></h2>
        <p class="c-modal__description"><?= $description ?></p>
        <a class="c-modal__button" href="<?= BASE_URL ?>/dashboard/user">Fechar</a>
      </div>
    </div>
  <?php endif; ?>
</body>

</html>