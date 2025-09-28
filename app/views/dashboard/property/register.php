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

require_once __DIR__ . '/../partials/alert.php';
require_once __DIR__ . '/../partials/select.php';
require_once __DIR__ . '/../partials/input.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php require_once __DIR__ . '/../../shared/head.php' ?>
  <title>Dashboard - Adicionar Propriedades</title>
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
    <div class="l-dashboard__content"">

      <div class=" c-dashboard-header">
      <h1 class="c-dashboard-header__title">Adicionar Propriedades</h1>
    </div>

    <form
      class="l-form l-form--col-2"
      action="/dashboard/property/register"
      method="post"
      enctype="multipart/form-data">
      <fieldset class="c-fieldset c-fieldset--col-2 l-form__item-span-2">
        <legend class="c-fieldset__legend">Endereço</legend>
        <?php foreach ($adress as $item): ?>
          <?= Input(
            type: 'text',
            name: $item['name'],
            id: $item['id'],
            label: $item['labelText'],
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
          required: true,
          attrs: ['step' => '0.01']
        ) ?>

        <?= Select(
          options: $property_types,
          name: 'property_type_id',
          id: 'property_type',
          label: 'Tipo de imóvel',
          optionLabel: fn($p) => ucfirst($p->getDescription()),
          optionValue: fn($p) => $p->getId(),
          required: true
        ) ?>

        <?= Select(
          options: $purposes,
          name: 'purpose_id',
          id: 'purpose',
          label: 'Finalidade',
          optionLabel: fn($p) => ucfirst($p->getDescription()),
          optionValue: fn($p) => $p->getId(),
          required: true
        ) ?>

        <?= Select(
          options: $owners,
          name: 'owner_id',
          id: 'owner',
          label: 'Proprietário',
          optionLabel: fn($p) => ucfirst($p->getName()),
          optionValue: fn($p) => $p->getId(),
          required: true
        ) ?>

      </fieldset>



      <fieldset class="c-fieldset">
        <legend class="c-fieldset__legend">Galeria de Imagens</legend>
        <label class="c-label">
          <i class="fa-solid fa-image"></i>
          Clique para escolher as imagens
          <input
            style="display: none;"
            data-js="image-input"
            type="file"
            name="images[]"
            multiple accept="image/*">
        </label>
        <div
          data-js="preview-container"
          style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
        </div>
      </fieldset>

      <fieldset class="c-fieldset">
        <legend class="c-fieldset__legend">Imagem de apresentação</legend>
        <label class="c-label">
          <i class="fa-solid fa-image"></i>
          Clique para escolher a imagem que ficara no card
          <input
            style="display: none;"
            data-js="cover-image-input"
            type="file"
            name="cover_image"
            accept="image/*">
        </label>
        <div
          data-js="cover-image-preview-container"
          style="display: grid; place-items: center; margin-top: 1rem;">
        </div>
      </fieldset>

      <button class="c-button c-button--dashboard" type="submit">
        Adicionar
      </button>
    </form>
  </div>
  <script>
    const imageInput = document.querySelector('[data-js="image-input"]');
    const previewContainer =
      document.querySelector('[data-js="preview-container"]');

    const coverImageInput =
      document.querySelector('[data-js="cover-image-input"]');
    const coverImagePreviewContainer =
      document.querySelector('[data-js="cover-image-preview-container"]');

    let selectedFiles = [];

    const renderPreviews = () => {
      previewContainer.innerHTML = '';

      selectedFiles.forEach((file, index) => {
        const reader = new FileReader();

        reader.onload = (e) => {
          const wrapper = document.createElement('div');
          wrapper.style.position = 'relative';

          const img = document.createElement('img');
          img.src = e.target.result;
          img.alt = file.name;
          img.style.width = '120px';
          img.style.height = '120px';
          img.style.objectFit = 'cover';
          img.style.border = '1px solid #ccc';
          img.style.borderRadius = '4px';
          img.style.display = 'block';

          const removeBtn = document.createElement('button');
          removeBtn.textContent = '×';
          removeBtn.type = 'button';
          removeBtn.style.position = 'absolute';
          removeBtn.style.top = '2px';
          removeBtn.style.right = '2px';
          removeBtn.style.background = 'rgba(0,0,0,0.6)';
          removeBtn.style.color = 'white';
          removeBtn.style.border = 'none';
          removeBtn.style.borderRadius = '50%';
          removeBtn.style.width = '24px';
          removeBtn.style.height = '24px';
          removeBtn.style.cursor = 'pointer';

          removeBtn.addEventListener('click', () => {
            selectedFiles.splice(index, 1);
            updateFileInput();
            renderPreviews();
          });

          wrapper.appendChild(img);
          wrapper.appendChild(removeBtn);
          previewContainer.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
      });
    };

    const updateFileInput = () => {
      const dataTransfer = new DataTransfer();
      selectedFiles.forEach(file => dataTransfer.items.add(file));
      imageInput.files = dataTransfer.files;
    };

    const handleChange = (e) => {
      const files = Array.from(e.target.files);

      selectedFiles = [...selectedFiles, ...files.filter(f => f.type.startsWith('image/'))];

      updateFileInput();
      renderPreviews();
    };

    imageInput.addEventListener('change', handleChange);
    coverImageInput.addEventListener('change', (e) => {

      const file = e.target.files[0]
      const reader = new FileReader(file)

      reader.onload = (e) => {
        coverImagePreviewContainer.innerHTML = '';

        const img = document.createElement('img');
        img.src = e.target.result;
        img.alt = file.name;
        img.style.width = '300px'
        img.style.aspectRatio = '2 / 1.5'
        img.style.objectFit = 'cover';
        img.style.border = '1px solid #ccc';
        img.style.borderRadius = '4px';
        img.style.display = 'block';

        coverImagePreviewContainer.append(img)
      }

      reader.readAsDataURL(file)
    });
  </script>

</body>

</html>