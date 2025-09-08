<?php

/**
 * @param array $options Array de itens para o select
 * @param string $name Nome do campo
 * @param string|null $id ID do select (default = $name)
 * @param string $label Texto do label
 * @param callable $optionLabel Função que retorna o texto de cada option (fn($item) => string)
 * @param callable $optionValue Função que retorna o valor de cada option (fn($item) => string)
 * @param string|null $value Valor selecionado
 * @param string $placeholder Texto do placeholder
 * @param bool $required Se o campo é obrigatório
 * @param bool $readonly Se o select é apenas leitura (desabilitado)
 * @param string $class Classes extras para o wrapper
 * @param array $attrs Atributos extras (ex: ['data-id' => 1])
 * @param string|null $error Mensagem de erro
 */

function Select(
  array $options,
  string $name,
  ?string $id = null,
  string $label = '',
  callable $optionLabel,
  callable $optionValue,
  ?string $value = null,
  string $placeholder = '-- selecione --',
  bool $required = false,
  bool $readonly = false,
  string $class = '',
  array $attrs = [],
  ?string $error = null
): string {
  $id = $id ?? $name;

  ob_start();
?>
  <div class="c-form-item <?= htmlspecialchars($class) ?>">
    <?php if ($label): ?>
      <label
        class="c-label" for="<?= htmlspecialchars($id) ?>">
        <?= htmlspecialchars($label) ?>
      </label>
    <?php endif; ?>

    <select
      name="<?= htmlspecialchars($name) ?>"
      id="<?= htmlspecialchars($id) ?>"
      class="c-select c-select--dashboard"
      <?= $required ? 'required' : '' ?>
      <?= $readonly ? 'disabled' : '' ?>
      <?= !empty($attrs) ? implode(' ', array_map(fn($k, $v) => "$k=\"$v\"", array_keys($attrs), $attrs)) : '' ?>>

      <option class="c-select__option c-select__option--placeholder"
        selected disabled value="">
        <?= htmlspecialchars($placeholder) ?>
      </option>

      <?php foreach ($options as $option): ?>
        <option class="c-select__option"
          value="<?= htmlspecialchars($optionValue($option)) ?>"
          <?= $value !== null && $value == $optionValue($option) ? 'selected' : '' ?>>
          <?= htmlspecialchars($optionLabel($option)) ?>
        </option>
      <?php endforeach; ?>

    </select>

    <?php if ($error): ?>
      <div class="c-form-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
  </div>
<?php
  return ob_get_clean();
}
