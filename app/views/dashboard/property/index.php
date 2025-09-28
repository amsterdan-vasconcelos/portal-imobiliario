<?php

use App\Models\Property;

$propertyExist = isset($properties) && count($properties) > 0;

require_once __DIR__ . '/../partials/alert.php';
require_once __DIR__ . '/../partials/activeFormIcon.php'
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Propriedades</title>
</head>

<body>
  <?= Alert(
    error: $error ?? null
  ) ?>

  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Propriedades</h1>
        <a href="/dashboard/property/register" class="c-dashboard-header__button">
          <i class="fa-solid fa-plus"></i>
          Add Propriedade
        </a>
      </div>

      <div class="c-table__container">
        <table class="c-table">
          <caption class="c-table__caption">Listagem das propriedades</caption>
          <thead class="c-table__header">
            <tr class="c-table__row">
              <th class="c-table__head" scope="col">Preço</th>
              <th class="c-table__head" scope="col">Rua</th>
              <th class="c-table__head" scope="col">Bairro</th>
              <th class="c-table__head" scope="col">Cidade</th>
              <th class="c-table__head" scope="col">Tipo de imovél</th>
              <th class="c-table__head" scope="col">Finalidade</th>
              <th class="c-table__head" scope="col">Proprietário</th>
              <th class="c-table__head" scope="col">Ativo</th>
              <th class="c-table__head" scope="col">Ações</th>
            </tr>
          </thead>
          <tbody class="c-table__body">
            <?php
            if ($propertyExist):
              /** @var Property */
              foreach ($properties as $property):
            ?>
                <tr class="c-table__row">
                  <td class="c-table__cell"><?= $property->getPrice() ?></td>
                  <td class="c-table__cell"><?= $property->getStreet() ?></td>
                  <td class="c-table__cell"><?= $property->getNeighborhood() ?></td>
                  <td class="c-table__cell"><?= $property->getCity() ?></td>
                  <td class="c-table__cell"><?= $property->getPropertyType() ?></td>
                  <td class="c-table__cell"><?= $property->getPurpose() ?></td>
                  <td class="c-table__cell"><?= $property->getOwner() ?></td>
                  <td class="c-table__cell">
                    <?= ActiveFormIcon(
                      action: "property/index/{$property->getId()}",
                      active: $property->getActive()
                    ) ?>
                  </td>
                  <td class="c-table__cell">
                    <a href="/dashboard/property/details/<?= $property->getId() ?>">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="/dashboard/property/update/<?= $property->getId() ?>">
                      <i class="fa-solid fa-pen pen"></i>
                    </a>
                    <a href="/dashboard/property/delete/<?= $property->getId() ?>">
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
  </div>
</body>

</html>