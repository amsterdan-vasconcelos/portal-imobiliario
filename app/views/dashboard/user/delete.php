<?php
$classActiveIcon = $user->getActive()
  ? 'fa-solid fa-circle active'
  : 'fa-solid fa-square inactive';

require_once __DIR__ . '/../partials/alert.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Deletar Usuário</title>
</head>

<body>
  <?= Alert(
    success: $success ?? null,
    error: $error ?? null,
    redirect: 'user'
  ) ?>
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
        <caption class="c-table__caption">
          Tem certeza que deseja deletar este usuário?
        </caption>
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
            <th class="c-table__head" scope="row"><?= ucfirst($user->getName()) ?></td>
            <td class="c-table__cell"><?= $user->getUsername() ?></td>
            <td class="c-table__cell"><?= $user->getEmail() ?></td>
            <td class="c-table__cell"><?= ucfirst($user->getAccessProfile()) ?></td>
            <td class="c-table__cell">
              <i class="<?= $classActiveIcon ?>"></i>
            </td>
            <td class="c-table__cell"><?= $user->getCreatedAt('d/m/y') ?></td>
          </tr>
        </tbody>
      </table>
      <div>
        <form
          style="display: flex; gap: .5rem; padding-top: 1rem;"
          action="<?= BASE_URL . '/dashboard/user/delete/' . $user->getId() ?>"
          method="post">
          <a
            class="c-button c-button--dashboard c-button--full"
            href="<?= BASE_URL ?>/dashboard/user">Não</a>
          <input type="hidden" name="delete">
          <button class="c-button c-button--dashboard c-button--full">Sim</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>