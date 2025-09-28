<?php

/**
 * @param array|null $success Array com as mensagens de sucesso
 * @param array|null $error Array com as mensagens de error
 * @param string|null $redirect Path de redirecionamento após fechamento do alert
 *  ex: property/update/id.
 *  O path raiz é dashboard.
 */

function ActiveFormIcon(
  string $action,
  string|int $active
): string {
  $action =  "/dashboard/$action";

  $classActiveIcon = $active
    ? 'fa-solid fa-circle active'
    : 'fa-solid fa-square inactive';

  ob_start();
?>

  <form action="<?= $action ?>" method="post">
    <input type="hidden" name="active" value="<?= !$active ? '1' : '0' ?>">
    <button>
      <i class="<?= $classActiveIcon ?>"></i>
    </button>
  </form>

<?php
  return ob_get_clean();
}
