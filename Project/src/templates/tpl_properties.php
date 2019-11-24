<?php 
  include_once('../includes/database.php');
  include_once('../database/images.php');
  include_once('../database/comments.php');


function draw_property($property){ 
    $id = getFirstImageOfProperty($property['id']);
    if(file_exists("../../assets/images/thumbs_medium/p_$id.jpg"))
        $imagePath = "../../assets/images/thumbs_medium/p_$id.jpg";
    else if(file_exists("../../assets/images/thumbs_medium/p_$id.png"))
        $imagePath = "../../assets/images/thumbs_medium/p_$id.png";
    ?>
    <li class='property'>
        <a href="property.php?id=<?=$property['id']?>">
        <!-- missing image -->
        <?php if(isset($imagePath)) { ?>
            <img src=<?=$imagePath?> alt="Image of property">
        <?php } ?>
        <h2><?=$property['title']?></h2>
        <div class="rating">
            <?php 
            $rating = $property['rating'];
            for($i = 0; $i < 5; $i++){
                if ($rating <= 0) { ?>
                    <i class="material-icons"> star_border</i>
                <?php }
                else if ($rating <= 0.5) { ?>
                    <i class="material-icons"> star_half</i>
                <?php }
                else { ?>
                    <i class="material-icons"> star</i>
                <?php }
                $rating -= 1;
            }
            ?>
        </div>
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
