<?php 
  include_once('../database/images.php');
  include_once('../database/comments.php');
  include_once('../database/listings.php');
  include_once('../database/users.php');

function draw_list_item($item){ 
  	$image = getFirstImagePathOfProperty($item['id']); ?>
    <a class="elem" href='item.php?id=<?=$item['id']?>'>
        <img src=<?=$image?> alt="Image of property" width="400" height="400">
        
        <div class="listing-content">
            <h1> <?=$item['title']?> </h1>
            <h5> Price: <?=$item['price_day']?>&euro; </h5>
            <p class="rating">
                <?php if(numberCommentsByProperty($item['id']) == 0) { ?>
                    <i> No reviews </i>
                <?php } 
                 else {
                    draw_rating($item['rating']); ?>
                    <span class='comments'><?=numberCommentsByProperty($item['id'])?> Reviews</span>
                <?php } ?>
            </p>
        </div>
    </a>
<?php }

function draw_list_all($listings, $filter, $max_page) { ?>
    <?php draw_filter($filter, $max_page); ?>

    <section class='listings'>
        <?php foreach($listings as $item) { 
            draw_list_item($item);
        } ?>
    </section>
<?php } ?>

