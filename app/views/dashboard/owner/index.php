<?php

use App\Models\Owner;

$ownerExist = isset($owners) && count($owners) > 0;

require_once __DIR__ . '/../partials/activeFormIcon.php';
require_once __DIR__ . '/../partials/alert.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Proprietários</title>
</head>

<body>
  <?= Alert(error: $error ?? null) ?>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Proprietários</h1>
        <a
          href="/dashboard/owner/register"
          class="c-dashboard-header__button">
          <i class="fa-solid fa-plus"></i>
          Add Proprietário
        </a>
      </div>

      <table class="c-table">
        <caption class="c-table__caption">Listagem dos proprietários</caption>
        <thead class="c-table__header">
          <tr class="c-table__row">
            <th class="c-table__head" scope="col">Nome</th>
            <th class="c-table__head" scope="col">Contato</th>
            <th class="c-table__head" scope="col">Sexo</th>
            <th class="c-table__head" scope="col">Ativo</th>
            <th class="c-table__head" scope="col">Ações</th>
          </tr>
        </thead>
        <tbody class="c-table__body">
          <?php
          if ($ownerExist):
            /** @var Owner */
            foreach ($owners as $owner):
              $classGenderIcon = $owner->getGender() === 'M'
                ? 'fa-solid fa-mars mars'
                : 'fa-solid fa-venus venus';
              $classActiveIcon = $owner->getActive()
                ? 'fa-solid fa-circle active'
                : 'fa-solid fa-square inactive';
          ?>
              <tr class="c-table__row">
                <th class="c-table__head" scope="row"><?= $owner->getName() ?></td>
                <td class="c-table__cell"><?= $owner->getPhone() ?></td>
                <td class="c-table__cell">
                  <i class="<?= $classGenderIcon ?>"></i>
                </td>
                <td class="c-table__cell">
                  <?= ActiveFormIcon(
                    action: "owner/index/{$owner->getId()}",
                    active: $owner->getActive()
                  ) ?>
                </td>
                <td class="c-table__cell">
                  <a
                    href="<?= "/dashboard/owner/update/{$owner->getId()}" ?>">
                    <i class="fa-solid fa-pen pen"></i>
                  </a>
                  <a
                    href="<?= "/dashboard/owner/delete/{$owner->getId()}" ?>">
                    <i class="fa-solid fa-trash trash"></i>
                  </a>
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