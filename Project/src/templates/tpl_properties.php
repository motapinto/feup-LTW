<?php function draw_property($property){ ?>
    <li class='property'>
        <a href="../listings/item.php?id=<?=$property['id']?>">
            <?php 
                $image = getFirstImagePathOfProperty($property['id']); 
                $numRents = numRentsByProperty($property['id']);
            ?>

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
                <p>Rented <?= $numRents ?> times.</p>
                <p class="comments">Reviews: <?=numberCommentsByProperty($property['id'])?></p>
            </div>
        </a>
    </li>
<?php }

function draw_properties($properties, $filter, $max_page) { ?>
    <?php draw_filter($filter, $max_page); 
    
    add_property();
    ?>



    <ul class="properties">
        <?php foreach($properties as $property) { 
            draw_property($property);
        } ?>
    </ul>
<?php } 


function add_property() { ?>
    <section id='addProperty'>
        <form action="add_property.php">
            <button>Add a property</button>
        </form>
    </section>
<?php } ?>
