<?php

$adress = [
  [
    'labelText' => 'CEP',
    'id' => 'zip_code',
    'name' => 'zip_code',
    'value' => $property->getZipCode(),
  ],
  [
    'labelText' => 'Rua',
    'id' => 'street',
    'name' => 'street',
    'value' => $property->getStreet(),
  ],
  [
    'labelText' => 'Bairro',
    'id' => 'neighborhood',
    'name' => 'neighborhood',
    'value' => $property->getNeighborhood(),
  ],
  [
    'labelText' => 'Cidade',
    'id' => 'city',
    'name' => 'city',
    'value' => $property->getCity(),
  ],
];

$details = [
  [
    'labelText' => 'Quartos',
    'id' => 'bedrooms',
    'name' => 'bedrooms',
    'value' => $property->getBedRooms(),
  ],
  [
    'labelText' => 'Banheiros',
    'id' => 'bathrooms',
    'name' => 'bathrooms',
    'value' => $property->getBathrooms(),
  ],
  [
    'labelText' => 'Vagas na garagem',
    'id' => 'garage',
    'name' => 'garage',
    'value' => $property->getGarage(),
  ],
  [
    'labelText' => 'Área total',
    'id' => 'total_area',
    'name' => 'total_area',
    'value' => $property->getTotalArea(),
  ],
  [
    'labelText' => 'Área construída',
    'id' => 'build_area',
    'name' => 'build_area',
    'value' => $property->getBuildArea(),
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
        action="<?= BASE_URL ?>/dashboard/property/update/<?= $property->getId() ?>" method="post">
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
            value: $property->getPrice(),
            required: true,
            attrs: ['step' => '0.01']
          ) ?>

          <?= Select(
            options: $property_types,
            name: 'property_type_id',
            id: 'property_type',
            label: 'Tipo de imóvel',
            value: $property->getPropertyTypeId(),
            optionLabel: fn($p) => ucfirst($p->getDescription()),
            optionValue: fn($p) => $p->getId(),
            required: true
          ) ?>

          <?= Select(
            options: $purposes,
            name: 'purpose_id',
            id: 'purpose',
            label: 'Finalidade',
            value: $property->getPurposeId(),
            optionLabel: fn($p) => ucfirst($p->getDescription()),
            optionValue: fn($p) => $p->getId(),
            required: true
          ) ?>

          <?= Select(
            options: $owners,
            name: 'owner_id',
            id: 'owner',
            label: 'Proprietário',
            value: $property->getOwnerId(),
            optionLabel: fn($p) => ucfirst($p->getName()),
            optionValue: fn($p) => $p->getId(),
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