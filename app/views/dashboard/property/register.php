<?php
$adress = [
  [
    'labelText' => 'CEP',
    'id' => 'zip_code',
    'name' => 'zip_code',
  ],
  [
    'labelText' => 'Rua',
    'id' => 'street',
    'name' => 'street',
  ],
  [
    'labelText' => 'Bairro',
    'id' => 'neighborhood',
    'name' => 'neighborhood',
  ],
  [
    'labelText' => 'Cidade',
    'id' => 'city',
    'name' => 'city',
  ],
];

$details = [
  [
    'labelText' => 'Quartos',
    'id' => 'bedrooms',
    'name' => 'bedrooms',
  ],
  [
    'labelText' => 'Banheiros',
    'id' => 'bathrooms',
    'name' => 'bathrooms',
  ],
  [
    'labelText' => 'Vagas na garagem',
    'id' => 'garage',
    'name' => 'garage',
  ],
  [
    'labelText' => 'Área total',
    'id' => 'total_area',
    'name' => 'total_area',
  ],
  [
    'labelText' => 'Área construída',
    'id' => 'build_area',
    'name' => 'build_area',
  ],
];

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
  <title>Dashboard - Adicionar Propriedades</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content"">

      <div class=" c-dashboard-header">
      <h1 class="c-dashboard-header__title">Adicionar Propriedades</h1>
    </div>

    <form
      class="l-form l-form--col-2"
      action="<?= BASE_URL ?>/dashboard/property/register" method="post">
      <fieldset class="c-fieldset c-fieldset--col-2 l-form__item-span-2">
        <legend class="c-fieldset__legend">Endereço</legend>
        <?php foreach ($adress as $item): ?>
          <div class="c-form-item">
            <label class="c-label" for="<?= $item['id'] ?>"><?= $item['labelText'] ?></label>
            <input
              class="c-input c-input--dashboard"
              type="text" autocomplete="" id="<?= $item['id'] ?>" name="<?= $item['name'] ?>"
              autofocus>
          </div>
        <?php endforeach ?>
      </fieldset>

      <fieldset class="c-fieldset c-fieldset--col-3">
        <legend class="c-fieldset__legend">Detalhes do imóvel</legend>
        <?php foreach ($details as $item): ?>
          <div class="c-form-item">
            <label class="c-label" for="<?= $item['id'] ?>"><?= $item['labelText'] ?></label>
            <input
              class="c-input c-input--dashboard"
              type="number" id="<?= $item['id'] ?>" name="<?= $item['name'] ?>"
              autofocus>
          </div>
        <?php endforeach ?>
      </fieldset>

      <fieldset class="c-fieldset c-fieldset--col-2">
        <legend class="c-fieldset__legend">Informações comerciais</legend>

        <div class="c-form-item">
          <label class="c-label" for="price">Preço</label>
          <input
            class="c-input c-input--dashboard"
            type="number" id="price" name="price"
            autofocus>
        </div>

        <div class="c-form-item">
          <label class="c-label" for="property_type">Tipo de imóvel</label>
          <select class="c-select c-select--dashboard" name="property_type_id" id="property_type">
            <option
              class="c-select__option c-select__option--placeholder"
              selected disabled value="">-- selecione --</option>
            <?php foreach ($property_types as $property_type): ?>
              <option class="c-select__option" value="<?= $property_type->id ?>">
                <?= ucfirst($property_type->description) ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="c-form-item">
          <label class="c-label" for="purpose">Finalidade</label>
          <select class="c-select c-select--dashboard" name="purpose_id" id="purpose">
            <option
              class="c-select__option c-select__option--placeholder"
              selected disabled value="">-- selecione --</option>
            <?php foreach ($purposes as $purpose): ?>
              <option class="c-select__option" value="<?= $purpose->id ?>">
                <?= ucfirst($purpose->description) ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="c-form-item">
          <label class="c-label" for="owner">Proprietário</label>
          <select class="c-select c-select--dashboard" name="owner_id" id="owner">
            <option
              class="c-select__option c-select__option--placeholder"
              selected disabled value="">-- selecione --</option>
            <?php foreach ($owners as $owner): ?>
              <option class="c-select__option" value="<?= $owner->id ?>">
                <?= ucfirst($owner->name) ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

      </fieldset>

      <button class="c-button c-button--dashboard" type="submit">
        Adicionar
      </button>
    </form>

  </div>
  </div>
  <?php if ($existMessage): ?>
    <div class="c-modal__overlay">
      <div class="c-modal <?= $class ?>">
        <h2
          class="c-modal__title"><?= $title ?></h2>
        <p class="c-modal__description"><?= $description ?></p>
        <a class="c-modal__button" href="<?= BASE_URL ?>/dashboard/property/register">Fechar</a>
      </div>
    </div>
  <?php endif; ?>
</body>

</html>