<?php

$array = [
  'imgs/buy-1.jpg',
  'imgs/buy-2.jpg',
  'imgs/buy-3.jpg',
]

?>

<section class="available" id="buy">
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