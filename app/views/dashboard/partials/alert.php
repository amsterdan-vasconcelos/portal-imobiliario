<?php

/**
 * @param array|null $success Array com as mensagens de sucesso
 * @param array|null $error Array com as mensagens de error
 * @param string|null $redirect Path de redirecionamento após fechamento do alert
 *  ex: property/update/id.
 *  O path raiz é dashboard.
 */

function Alert(
  array|string|null $success = null,
  array|string|null $error = null,
  ?string $redirect = null,
): string {
  $isSuccess = !empty($success);
  $isError = !empty($error);
  $existMessage = $isSuccess || $isError;

  if ($existMessage) {
    $class = !empty($success) ? 'success' : 'error';
    $title = !empty($success)
      ? '<i class="fa-solid fa-check"></i> Sucesso:'
      : '<i class="fa-solid fa-circle-exclamation"></i> Erro:';

    $isString = $isSuccess ? is_string($success) : is_string($error);
    $message = $success ?? $error;
    $message = $isString ? [$message] : $message;
  }

  $href = $redirect ?  "/dashboard/$redirect" : '';

  ob_start();
?>

  <?php if ($existMessage): ?>
    <div class="c-modal__overlay">
      <div class="c-modal <?= $class ?>">
        <h2
          class="c-modal__title"><?= $title ?></h2>

        <?php foreach ($message as $item): ?>
          <p class="c-modal__description"><?= $item ?></p>
        <?php endforeach ?>

        <button
          autofocus
          class="c-modal__button" onclick="location.href = '<?= $href ?>'">
          Fechar
        </button>
      </div>
    </div>
  <?php endif; ?>

<?php
  return ob_get_clean();
}
