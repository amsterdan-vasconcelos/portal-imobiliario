<?php
$classActiveIcon = $property->active
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
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/dashboard/index.css">
  <title>Dashboard - Deletar Propriedade</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Propriedade</h1>
      </div>

      <table class="c-table">
        <caption class="c-table__caption">Tem certeza que deseja deletar esta propriedade?</caption>
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
          </tr>
        </thead>
        <tbody class="c-table__body">
          <tr class="c-table__row">
            <td class="c-table__cell"><?= $property->price ?></td>
            <td class="c-table__cell"><?= $property->street ?></td>
            <td class="c-table__cell"><?= $property->neighborhood ?></td>
            <td class="c-table__cell"><?= $property->city ?></td>
            <td class="c-table__cell"><?= $property->property_type ?></td>
            <td class="c-table__cell"><?= $property->purpose ?></td>
            <td class="c-table__cell"><?= $property->owner ?></td>
            <td class="c-table__cell">
              <i class="<?= $classActiveIcon ?>"></i>
            </td>
          </tr>
        </tbody>
      </table>
      <div>
        <form style="display: flex; gap: .5rem; padding-top: 1rem;" action="<?= BASE_URL . '/dashboard/property/delete/' . $property->id ?>" method="post">
          <a class="c-button c-button--dashboard c-button--full" href="<?= BASE_URL ?>/dashboard/property">Não</a>
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
        <a class="c-modal__button" href="<?= BASE_URL ?>/dashboard/property">Fechar</a>
      </div>
    </div>
  <?php endif; ?>
</body>

</html>