<?php

/**
 * @param string $name Nome do campo
 * @param string|null $id ID do campo (default = $name)
 * @param string $label Texto do label
 * @param string|null $value Valor do campo
 * @param bool $required Se o campo é obrigatório
 * @param bool $readonly Se o campo é apenas leitura (desabilitado)
 * @param string $class Classes extras para o wrapper
 * @param array $attrs Atributos extras (ex: ['data-id' => 1])
 * @param string|null $error Mensagem de erro
 */

function Radio(
  string $name,
  ?string $id = null,
  string $label = '',
  ?string $value = null,
  bool $required = false,
  bool $readonly = false,
  bool $checked = false,
  string $class = '',
  array $attrs = [],
  ?string $error = null
): string {
  $id = $id ?? $name;
  $attrs = !empty($attrs)
    ? implode(' ', array_map(fn($k, $v) => "$k=\"$v\"", array_keys($attrs), $attrs))
    : '';

  ob_start();
?>

  <div class="<?= htmlspecialchars($class) ?>"
    style="display: flex; align-items: center; justify-content: start; gap: .5rem;">
    <?php if ($label): ?>
      <label
        class="c-label" for="<?= htmlspecialchars($id) ?>">
        <?= htmlspecialchars($label) ?>
      </label>
    <?php endif; ?>

    <input
      type="radio"
      style="width: fit-content;"
      value="<?= htmlspecialchars($value) ?>"
      id="<?= htmlspecialchars($id) ?>"
      name="<?= htmlspecialchars($name) ?>"
      <?= $required ? 'required' : '' ?>
      <?= $readonly ? 'readonly' : '' ?>
      <?= $checked ? 'checked' : '' ?>
      <?= $attrs ?>>

    <?php if ($error): ?>
      <div class="c-form-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
  </div>

<?php
  return ob_get_clean();
}
