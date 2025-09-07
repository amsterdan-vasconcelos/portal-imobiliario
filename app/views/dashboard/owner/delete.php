<?php
$classGenderIcon = $owner->gender === 'M'
  ? 'fa-solid fa-mars mars'
  : 'fa-solid fa-venus venus';
$classActiveIcon = $owner->active
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
  <title>Dashboard - Deletar Proprietário</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Proprietário</h1>
      </div>

      <table class="c-table">
        <caption class="c-table__caption">Tem certeza que deseja deletar este proprietário?</caption>
        <thead class="c-table__header">
          <tr class="c-table__row">
            <th class="c-table__head" scope="col">Nome</th>
            <th class="c-table__head" scope="col">Contato</th>
            <th class="c-table__head" scope="col">Sexo</th>
            <th class="c-table__head" scope="col">Ativo</th>
          </tr>
        </thead>
        <tbody class="c-table__body">
          <tr class="c-table__row">
            <th class="c-table__head" scope="row"><?= $owner->name ?></td>
            <td class="c-table__cell"><?= $owner->phone ?></td>
            <td class="c-table__cell">
              <i class="<?= $classGenderIcon ?>"></i>
            </td>
            <td class="c-table__cell">
              <i class="<?= $classActiveIcon ?>"></i>
            </td>
          </tr>
        </tbody>
      </table>
      <div>
        <form style="display: flex; gap: .5rem; padding-top: 1rem;" action="<?= BASE_URL . '/dashboard/owner/delete/' . $owner->id ?>" method="post">
          <a class="c-button c-button--dashboard c-button--full" href="<?= BASE_URL ?>/dashboard/owner">Não</a>
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
        <a class="c-modal__button" href="<?= BASE_URL ?>/dashboard/owner">Fechar</a>
      </div>
    </div>
  <?php endif; ?>
</body>

</html>