<?php

/**
 * @param string|null $label Texto do label
 * @param string $value Texto do campo
 */

function Readonly(
  ?string $label = null,
  string $value
): string {
  ob_start()
?>

  <div class="c-form-item">
    <label class="c-label"><?= htmlspecialchars($label) ?></label>
    <div
      class="c-input c-input--dashboard"
      role="textbox"
      aria-readonly="true"><?= htmlspecialchars($value) ?></div>
  </div>

<?php
  return ob_get_clean();
}
