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

require_once __DIR__ . '/../partials/readonly.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>

  <title>Dashboard - Detalhes da Propriedades</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../shared/header.php' ?>

  <div class="l-dashboard">
    <div class="l-dashboard__sidebar">
      <?php require_once __DIR__ . '/../partials/sidebar.php' ?>
    </div>
    <div class="l-dashboard__content">

      <div class="c-dashboard-header">
        <h1 class="c-dashboard-header__title">Detalhes da Propriedades</h1>
      </div>

      <section class="l-form l-form--col-2">
        <fieldset class="c-fieldset c-fieldset--col-2 l-form__item-span-2">
          <legend class="c-fieldset__legend">Endereço</legend>
          <?php foreach ($adress as $item): ?>

            <?= Readonly(
              label: $item['labelText'],
              value: htmlspecialchars($item['value'])
            ) ?>

          <?php endforeach ?>
        </fieldset>

        <fieldset class="c-fieldset c-fieldset--col-3">
          <legend class="c-fieldset__legend">Detalhes do imóvel</legend>
          <?php foreach ($details as $item): ?>

            <?= Readonly(
              label: $item['labelText'],
              value: htmlspecialchars($item['value'])
            ) ?>

          <?php endforeach ?>
        </fieldset>

        <fieldset class="c-fieldset c-fieldset--col-2">
          <legend class="c-fieldset__legend">Informações comerciais</legend>

          <?= Readonly(
            label: 'Preço',
            value: 'R$ ' . number_format($property->price, 2, ',', '.')
          ) ?>

          <?= Readonly(
            label: 'Tipo de imóvel',
            value: ucfirst($property_type->description)
          ) ?>

          <?= Readonly(
            label: 'Finalidade',
            value: ucfirst($purpose->description)
          ) ?>

          <?= Readonly(
            label: 'Proprietário',
            value: ucfirst($owner->name)
          ) ?>

        </fieldset>
      </section>
    </div>
  </div>
</body>

</html>