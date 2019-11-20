<?php 
  include_once('../includes/database.php');
  include_once('../database/images.php');


function draw_property($property){ 
  $image = getFirstImageOfProperty($property['id']);
  ?>
  <li class='property'>
    <a href="property.php?id=<?=$property['id']?>">
    <!-- missing image -->
    <?php if(isset($image['image_path'])) { ?>
      <!-- <img src=<?=$image['image_path']?> alt="Image of property"> -->
    <?php } ?>
      <h1>
          <?=$property['title']?>
      </h1>
      <p><!-- missing star image -->Rating: <?=$property['rating']?> stars</p>
      <p class="comments"></p>
    </a>
  </li>
<?php }

function draw_properties($properties) { ?>
  <ul id="properties">
    <?php foreach($properties as $property) { 
      draw_property($property);
    } ?>
  </ul>

<?php }

?>
