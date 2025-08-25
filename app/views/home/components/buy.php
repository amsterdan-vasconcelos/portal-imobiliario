<?php

$array = [
  'public/imgs/buy-1.jpg',
  'public/imgs/buy-2.jpg',
  'public/imgs/buy-3.jpg',
]

?>

<section class="available">
  <p class="available__subtitle">NOVAS OPORTUNIDADES</p>
  <h2 class="available__title">COMPRAR</h2>

  <div class="available__slide">

    <?php
    foreach ($array as $src) {
      require __DIR__ . '/card.php';
    }
    ?>

  </div>
</section>