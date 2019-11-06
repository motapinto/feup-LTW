<?php 
echo __DIR__.'/item.php';
include_once(__DIR__.'/item.php');

function drawAllListings($listings) { ?>
  <section id="listings">
    <?php foreach($listings as $item) { 
      drawItem($item);
    } ?>
  </section>

<?php } ?>
