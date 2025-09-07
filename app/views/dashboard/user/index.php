<?php
$userExist = isset($users) && count($users) > 0;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Usuários</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Usuários</h1>
        <a href="<?= BASE_URL ?>/dashboard/user/register" class="c-dashboard-header__button">
          <i class="fa-solid fa-plus"></i>
          Add Usuário
        </a>
      </div>

      <table class="c-table">
        <caption class="c-table__caption">Listagem dos usuários</caption>
        <thead class="c-table__header">
          <tr class="c-table__row">
            <th class="c-table__head" scope="col">Nome</th>
            <th class="c-table__head" scope="col">Username</th>
            <th class="c-table__head" scope="col">Email</th>
            <th class="c-table__head" scope="col">Perfil de Acesso</th>
            <th class="c-table__head" scope="col">Ativo</th>
            <th class="c-table__head" scope="col">Criado em</th>
            <th class="c-table__head" scope="col">Ações</th>
          </tr>
        </thead>
        <tbody class="c-table__body">
          <?php
          if ($userExist):
            foreach ($users as $user):
              $classActiveIcon = $user->active
                ? 'fa-solid fa-circle active'
                : 'fa-solid fa-square inactive';
          ?>
              <tr class="c-table__row">
                <th class="c-table__head" scope="row"><?= $user->name ?></td>
                <td class="c-table__cell"><?= $user->username ?></td>
                <td class="c-table__cell"><?= $user->email ?></td>
                <td class="c-table__cell"><?= $user->access_profile ?></td>
                <td class="c-table__cell">
                  <form action="<?= BASE_URL ?>/dashboard/user" method="post">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input
                      type="hidden" name="active"
                      value="<?= !$user->active ? 'true' : 'false' ?>">
                    <button>
                      <i class="<?= $classActiveIcon ?>"></i>
                    </button>
                  </form>
                </td>
                <td class="c-table__cell"><?= $user->created_at ?></td>
                <td class="c-table__cell">
                  <a href="<?= BASE_URL . "/dashboard/user/update/$user->id" ?>"><i class="fa-solid fa-pen pen"></i></a>
                  <a href="<?= BASE_URL . "/dashboard/user/delete/$user->id" ?>"><i class="fa-solid fa-trash trash"></i></a>
                </td>
              </tr>
          <?php
            endforeach;
          endif
          ?>
        </tbody>
        <tfoot></tfoot>
      </table>
    </div>
  </div>
</body>

</html>