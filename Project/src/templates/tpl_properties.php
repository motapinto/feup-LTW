<?php function draw_property($property){ ?>
    <li class='property'>
        <a href="../properties/propertyDetails.php?id=<?=$property['id']?>">
            <?php 
                $image = getFirstImagePathOfProperty($property['id']); 
                $numRents = numRentsByProperty($property['id']);
            ?>

            <img src=<?=$image?> alt="Image of property" width="200" height="200">
            <article class="property-content">
                <h2><?=$property['title']?></h2>
                <span><?=$property['price_day']?>&euro; per night</span>
                <div id="property-rating" class="rating">
                    <?php 
                    $rating = $property['rating'];
                    if(numberCommentsByProperty($property['id']) == 0) { ?>
                        <i> No reviews </i>
                    <?php }
                    else {
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
                        } ?>
                        <span class="comments">(<?=numberCommentsByProperty($property['id'])?>)</span>
                    <?php } ?>
                </div>
                <p>Rented <?= $numRents ?> times.</p>
            </article>
        </a>
    </li>
<?php }

function draw_properties($properties, $filter, $owner) { ?>
    <?php 
        draw_filter($filter, null, $owner); 
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
        <form action="propertyDetails.php">
            <button id="addButton"><i class="fas fa-plus"></i></button>
        </form>
    </section>
<?php } ?>
