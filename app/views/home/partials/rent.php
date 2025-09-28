<?php

$array = [
  'imgs/rent-1.jpg',
  'imgs/rent-2.jpg',
  'imgs/rent-3.jpg',
]

?>

<section class="available" id="rent">
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