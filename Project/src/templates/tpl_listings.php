<?php 
  include_once('../includes/database.php');
  include_once('../database/images.php');


function draw_item($item){ 
  $image = getFirstImageOfProperty($item['id']);
  ?>
  <article class='item'>
    <a href="item.php?id=<?=$item['id']?>">
    <!-- missing image -->
    <?php if(isset($image['image_path'])) { ?>
      <!-- <img src=<?=$image['image_path']?> alt="Image of property"> -->
    <?php } ?>

      <h1>
          <?=$item['title']?>
      </h1>
      <p><!-- missing star image -->Rating: <?=$item['rating']?> stars</p>
      <p class="comments"></p>
    </a>
  </article>
<?php }

function draw_allListings($listings) { ?>
  <section id="listings">
    <?php foreach($listings as $item) { 
      draw_item($item);
    } ?>
  </section>

<?php }

?>
