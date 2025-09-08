<?php
$adress = [
  [
    'labelText' => 'CEP',
    'id' => 'zip_code',
    'name' => 'zip_code',
    'value' => $property->zip_code,
  ],
  [
    'labelText' => 'Rua',
    'id' => 'street',
    'name' => 'street',
    'value' => $property->street,
  ],
  [
    'labelText' => 'Bairro',
    'id' => 'neighborhood',
    'name' => 'neighborhood',
    'value' => $property->neighborhood,
  ],
  [
    'labelText' => 'Cidade',
    'id' => 'city',
    'name' => 'city',
    'value' => $property->city,
  ],
];

$details = [
  [
    'labelText' => 'Quartos',
    'id' => 'bedrooms',
    'name' => 'bedrooms',
    'value' => $property->bedrooms,
  ],
  [
    'labelText' => 'Banheiros',
    'id' => 'bathrooms',
    'name' => 'bathrooms',
    'value' => $property->bathrooms,
  ],
  [
    'labelText' => 'Vagas na garagem',
    'id' => 'garage',
    'name' => 'garage',
    'value' => $property->garage,
  ],
  [
    'labelText' => 'Área total',
    'id' => 'total_area',
    'name' => 'total_area',
    'value' => $property->total_area,
  ],
  [
    'labelText' => 'Área construída',
    'id' => 'build_area',
    'name' => 'build_area',
    'value' => $property->build_area,
  ],
];

require_once __DIR__ . '/../partials/alert.php';
require_once __DIR__ . '/../partials/select.php';
require_once __DIR__ . '/../partials/input.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Atualizar Propriedades</title>
</head>

<body>
  <?= Alert(
    success: $success ?? null,
    error: $error ?? null
  ) ?>

  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Atualizar Propriedades</h1>
      </div>

      <form
        class="l-form l-form--col-2"
        action="<?= BASE_URL ?>/dashboard/property/update/<?= $property->id ?>" method="post">

        <fieldset class="c-fieldset c-fieldset--col-2 l-form__item-span-2">
          <legend class="c-fieldset__legend">Endereço</legend>
          <?php foreach ($adress as $item): ?>
            <?= Input(
              type: 'text',
              name: $item['name'],
              id: $item['id'],
              label: $item['labelText'],
              value: $item['value'],
              required: true,
              attrs: ['autofocus' => 'true']
            ) ?>
          <?php endforeach ?>
        </fieldset>

        <fieldset class="c-fieldset c-fieldset--col-3">
          <legend class="c-fieldset__legend">Detalhes do imóvel</legend>
          <?php foreach ($details as $item): ?>
            <?= Input(
              type: 'number',
              name: $item['name'],
              id: $item['id'],
              label: $item['labelText'],
              value: $item['value'],
              required: true,
            ) ?>
          <?php endforeach ?>
        </fieldset>

        <fieldset class="c-fieldset c-fieldset--col-2">
          <legend class="c-fieldset__legend">Informações comerciais</legend>

          <?= Input(
            type: 'number',
            name: 'price',
            id: 'price',
            label: 'Preço',
            value: $property->price,
            required: true,
            attrs: ['step' => '0.01']
          ) ?>

          <?= Select(
            options: $property_types,
            name: 'property_type_id',
            id: 'property_type',
            label: 'Tipo de imóvel',
            value: $property->property_type_id,
            optionLabel: fn($p) => ucfirst($p->description),
            optionValue: fn($p) => $p->id,
            required: true
          ) ?>

          <?= Select(
            options: $purposes,
            name: 'purpose_id',
            id: 'purpose',
            label: 'Finalidade',
            value: $property->purpose_id,
            optionLabel: fn($p) => ucfirst($p->description),
            optionValue: fn($p) => $p->id,
            required: true
          ) ?>

          <?= Select(
            options: $owners,
            name: 'owner_id',
            id: 'owner',
            label: 'Proprietário',
            value: $property->owner_id,
            optionLabel: fn($p) => ucfirst($p->name),
            optionValue: fn($p) => $p->id,
            required: true
          ) ?>

        </fieldset>

        <button
          class="c-button c-button--dashboard"
          type="submit">
          Atualizar
        </button>
      </form>

    </div>
  </div>
</body>

</html>