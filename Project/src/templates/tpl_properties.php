<?php 
  include_once('../includes/database.php');
  include_once('../database/images.php');
  include_once('../database/comments.php');


function draw_property($property){ ?>
    <li class='property'>
        <a href="../listings/item.php?id=<?=$property['id']?>">
            <?php $image = getFirstImagePathOfProperty($property['id']); ?>
            <?php if(isset($image)) { ?>
                <img src=<?=$image?> alt="Image of property" width="200" height="200">
            <?php } ?>
            <h2><?=$property['title']?></h2>
            <span><?=$property['price_day']?>&euro; per night</span>
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
            <p class="comments">Reviews: <?=numberCommentsByProperty($property['id'])?></p>
        </a>
    </li>
<?php }

function draw_properties($properties) { ?>
    <ul id="properties">
        <?php foreach($properties as $property) { 
            draw_property($property);
        } ?>
    </ul>
<?php } ?>
