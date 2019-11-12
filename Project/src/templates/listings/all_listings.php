<?php 
include_once(__DIR__.'/item.php');

function draw_allListings($listings) { ?>
  <section id="listings">
    <?php foreach($listings as $item) { 
      drawItem($item);
    } ?>
  </section>

<?php } ?>
