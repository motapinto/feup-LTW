<?php 
  include_once('../includes/database.php');
  include_once('../database/images.php');
  include_once('../database/comments.php');


function draw_property($property){ 
  $image = getFirstImageOfProperty($property['id']);
  ?>
  <li class='property'>
    <a href="property.php?id=<?=$property['id']?>">
    <!-- missing image -->
    <?php if(isset($image['id'])) { ?>
      <!-- <img src=<?=$image['id']?> alt="Image of property"> -->
    <?php } ?>
      <h2>
          <?=$property['title']?>
      </h2>
      <p><!-- missing star image -->Rating: <?=$property['rating']?> stars</p>
      <p class="comments">Comments: <?=numberCommentsByProperty($property['id'])?></p>
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
