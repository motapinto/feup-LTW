<?php 
  include_once('../database/images.php');
  include_once('../database/comments.php');
  include_once('../database/listings.php');
  include_once('../database/users.php');

function draw_list_item($item){ 
  	$image = getFirstImagePathOfProperty($item['id']); ?>
    <a class="elem" href='item.php?id=<?=$item['id']?>'>
            <img src="https://cdn.vox-cdn.com/thumbor/0__zWQZmmmwHA5OjBTAchz6_sBw=/0x0:3000x2000/1200x800/filters:focal(1260x760:1740x1240)/cdn.vox-cdn.com/uploads/chorus_image/image/62922957/4854_Alonzo_Ave__Encino_FInals_34.0.jpg" alt='img' width="250" height="200">     
        
        <div class="listing-content">
            <h1> <?=$item['title']?> </h1>
            <h5> Price: <?=$item['price_day']?>&euro; </h5>
            <p class="rating">
                <?php draw_rating($item['rating']); ?>
                <span class='comments'><?=numberCommentsByProperty($item['id'])?> Reviews</span>
            </p>
        </div>

    </a>
<?php }

function draw_list_all($listings, $filter) { ?>
    <section class="listings-filter">
        <?php draw_filter($filter); ?>
    </section>

    <section class='listings'>
        <?php foreach($listings as $item) { 
            draw_list_item($item);
        } ?>
    </section>

<?php } ?>

