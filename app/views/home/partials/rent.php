<?php

$array = [
  'public/imgs/rent-1.jpg',
  'public/imgs/rent-2.jpg',
  'public/imgs/rent-3.jpg',
]

?>

<section class="available">
  <p class="available__subtitle">NOVAS OPORTUNIDADES</p>
  <h2 class="available__title">ALUGAR</h2>

  <div class="available__slide">

    <?php
    foreach ($array as $src) {
      require __DIR__ . '/card.php';
    }
    ?>

  </div>
</section>