<?php
$propertyExist = isset($properties) && count($properties) > 0;

$existMessage = !empty($error);
if ($existMessage) {
  $messages = $error;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Propriedades</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Propriedades</h1>
        <a href="<?= BASE_URL ?>/dashboard/property/register" class="c-dashboard-header__button">
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
              foreach ($properties as $property):
                $classActiveIcon = $property->active
                  ? 'fa-solid fa-circle active'
                  : 'fa-solid fa-square inactive';
            ?>
                <tr class="c-table__row">
                  <td class="c-table__cell"><?= $property->price ?></td>
                  <td class="c-table__cell"><?= $property->street ?></td>
                  <td class="c-table__cell"><?= $property->neighborhood ?></td>
                  <td class="c-table__cell"><?= $property->city ?></td>
                  <td class="c-table__cell"><?= $property->property_type ?></td>
                  <td class="c-table__cell"><?= $property->purpose ?></td>
                  <td class="c-table__cell"><?= $property->owner ?></td>
                  <td class="c-table__cell">
                    <form action="<?= BASE_URL ?>/dashboard/property" method="post">
                      <input type="hidden" name="id" value="<?= $property->id ?>">
                      <input
                        type="hidden" name="active"
                        value="<?= !$property->active ? '1' : '0' ?>">
                      <button>
                        <i class="<?= $classActiveIcon ?>"></i>
                      </button>
                    </form>
                  </td>
                  <td class="c-table__cell">
                    <a href="<?= BASE_URL . "/dashboard/property/details/$property->id" ?>">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="<?= BASE_URL . "/dashboard/property/update/$property->id" ?>">
                      <i class="fa-solid fa-pen pen"></i>
                    </a>
                    <a href="<?= BASE_URL . "/dashboard/property/delete/$property->id" ?>">
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
  <?php if ($existMessage): ?>
    <div class="c-modal__overlay">
      <div class="c-modal error">
        <h2
          class="c-modal__title">
          <i class="fa-solid fa-circle-exclamation"></i>
          Erro:
        </h2>
        <?php foreach ($messages as $message): ?>
          <p class="c-modal__description"><?= $message ?></p>
        <?php endforeach ?>
        <a class="c-modal__button" href="<?= BASE_URL ?>/dashboard/property">Fechar</a>
      </div>
    </div>
  <?php endif; ?>
</body>

</html>