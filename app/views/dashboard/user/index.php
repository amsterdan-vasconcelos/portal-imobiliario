<?php

use App\Models\User;

$userExist = isset($users) && count($users) > 0;
require_once __DIR__ . '/../partials/activeFormIcon.php';
require_once __DIR__ . '/../partials/alert.php'
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Usuários</title>
</head>

<body>
  <?php Alert(error: $error ?? null) ?>
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
            /** @var User */
            foreach ($users as $user):
              $classActiveIcon = $user->getActive()
                ? 'fa-solid fa-circle active'
                : 'fa-solid fa-square inactive';
          ?>
              <tr class="c-table__row">
                <th class="c-table__head" scope="row"><?= ucfirst($user->getName()) ?></td>
                <td class="c-table__cell"><?= $user->getUsername() ?></td>
                <td class="c-table__cell"><?= $user->getEmail() ?></td>
                <td class="c-table__cell"><?= ucfirst($user->getAccessProfile()) ?></td>
                <td class="c-table__cell">
                  <?= ActiveFormIcon(
                    action: "user/index/{$user->getId()}",
                    active: $user->getActive()
                  ) ?>
                </td>
                <td class="c-table__cell"><?= $user->getCreatedAt('d/m/y') ?></td>
                <td class="c-table__cell">
                  <a href="<?= BASE_URL . "/dashboard/user/update/{$user->getId()}" ?>"><i class="fa-solid fa-pen pen"></i></a>
                  <a href="<?= BASE_URL . "/dashboard/user/delete/{$user->getId()}" ?>"><i class="fa-solid fa-trash trash"></i></a>
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