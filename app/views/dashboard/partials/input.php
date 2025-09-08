<?php

/**
 * @param string $type Tipo do campo (default = text)
 * @param string $name Nome do campo
 * @param string|null $id ID do campo (default = $name)
 * @param string $label Texto do label
 * @param string|null $value Valor do campo
 * @param string $placeholder Texto do placeholder
 * @param bool $required Se o campo é obrigatório
 * @param bool $readonly Se o campo é apenas leitura (desabilitado)
 * @param string $class Classes extras para o wrapper
 * @param array $attrs Atributos extras (ex: ['data-id' => 1])
 * @param string|null $error Mensagem de erro
 */

function Input(
  string $type = 'text',
  string $name,
  ?string $id = null,
  string $label = '',
  ?string $value = null,
  string $placeholder = '',
  bool $required = false,
  bool $readonly = false,
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

  <div class="c-form-item <?= htmlspecialchars($class) ?>">
    <?php if ($label): ?>
      <label
        class="c-label" for="<?= htmlspecialchars($id) ?>">
        <?= htmlspecialchars($label) ?>
      </label>
    <?php endif; ?>

    <input
      class="c-input c-input--dashboard"
      type="<?= $type ?>"
      value="<?= htmlspecialchars($value) ?>"
      id="<?= htmlspecialchars($id) ?>"
      name="<?= htmlspecialchars($name) ?>"
      <?= $placeholder ? "placeholder='$placeholder'" : '' ?>
      <?= $required ? 'required' : '' ?>
      <?= $readonly ? 'readonly' : '' ?>
      <?= $attrs ?>>

    <?php if ($error): ?>
      <div class="c-form-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
  </div>

<?php
  return ob_get_clean();
}
