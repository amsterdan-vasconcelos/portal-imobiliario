<?php
$ownerExist = isset($owners) && count($owners) > 0
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/dashboard/index.css">
  <title>Dashboard - Proprietários</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Proprietários</h1>
        <a href="<?= BASE_URL ?>/dashboard/owner/register" class="c-dashboard-header__button">
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
            foreach ($owners as $owner):
              $classGenderIcon = $owner->gender === 'M'
                ? 'fa-solid fa-mars mars'
                : 'fa-solid fa-venus venus';
              $classActiveIcon = $owner->active
                ? 'fa-solid fa-circle active'
                : 'fa-solid fa-square inactive';
          ?>
              <tr class="c-table__row">
                <th class="c-table__head" scope="row"><?= $owner->name ?></td>
                <td class="c-table__cell"><?= $owner->phone ?></td>
                <td class="c-table__cell">
                  <i class="<?= $classGenderIcon ?>"></i>
                </td>
                <td class="c-table__cell">
                  <form action="<?= BASE_URL ?>/dashboard/owner" method="post">
                    <input type="hidden" name="id" value="<?= $owner->id ?>">
                    <input
                      type="hidden" name="active"
                      value="<?= !$owner->active ? 'true' : 'false' ?>">
                    <button>
                      <i class="<?= $classActiveIcon ?>"></i>
                    </button>
                  </form>
                </td>
                <td class="c-table__cell">
                  <a href="<?= BASE_URL . "/dashboard/owner/update/$owner->id" ?>"><i class="fa-solid fa-pen pen"></i></a>
                  <a href="<?= BASE_URL . "/dashboard/owner/delete/$owner->id" ?>"><i class="fa-solid fa-trash trash"></i></a>
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