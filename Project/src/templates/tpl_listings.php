<?php 
  include_once('../includes/database.php');
  include_once('../database/images.php');
  include_once('../database/comments.php');
  include_once('../database/users.php');


function draw_list_item($item){ 
  	$image = getFirstImagePathOfProperty($item['id']);
  	?>
  	<article class='item'>
		<a href='item.php?id=<?=$item['id']?>'>
			<?php if(isset($image)) { ?>
				<img src=<?=$image?> alt='Image of property'>
			<?php } ?>

			<h1> <?=$item['title']?> </h1>
            <p>
                <span class="rating"><?php draw_rating($item['rating']); ?></span>
            </p>
			<p class='comments'>Comments: <?=numberCommentsByProperty($item['id'])?></p>
		</a>
  	</article>
<?php }

function draw_list_all($listings) { ?>
  <section id='listings'>
    <?php foreach($listings as $item) { 
      draw_list_item($item);
    } ?>
  </section>

<?php }

function draw_item($item, $owner=false) { 
    $comments = getCommentsByPropertyId($item['id']);
    $images = getImagePathsByPropertyId($item['id'], 'MEDIUM');
    $user = userProfile($item['user_id']);
    ?>

    <section id='list'>
        <article class='property'>
            <h2><?=$item['title']?></h2>
            <ul> 
            <?php foreach ($images as $image) { ?>
                <li><img src=<?=$image?> alt='Image of the property '></li>          
            <?php } ?>
            </ul>
            <?php if($owner){ ?>
                <a href='../properties/add_property_image.php?id=<?=$item['id']?>'>Add image(s)</a>
            <?php } ?>
            <!-- Galeria de imagens, possivelmente usando scripts? -->
            <p><?=$item['description']?></p>
            <p>Property type: 
            <?php
                switch ($item['property_type']) {
                case 0:
                    ?> House <?php
                    break;
                case 1:
                    ?> Appartment <?php
                    break;
                default:
                    ?> Undefined <?php
                    break;
                } 
            ?>
            </p>
            <p>Address: <?=$item['street']?>, n<?=$item['door_number']?>, <?=$item['city']?></p>
            <p>Owner: 
                <a href="../profile/profile.php?id=<?=$user['id']?>">
                    <?=$user['name']?>
                </a>
            </p>
        </article>
      
<!--*********************** CALENDER + RENT (RIGHT SIDE) ***********************-->
      <aside class='rent'>
        <section class='rent-header'>
          	<header>
				<p id='rent-price'>
					€<?=$item['price_day']?>
				</span>
				<span>
					per night
				</p>
				<i id='rent-star' class='material-icons'> star</i>
				<span class='rent-rating_comments'>
					<?=$item['rating']?>
					(<?=numberCommentsByProperty($item['id'])?> comments)
				</span>
			</header>
		

        </section class='rent-body'>
			<form action='../rent/rent.php' method='POST'>
				<input name='id' type='hidden' value=<?=$item['id']?>/>
				<label>Check In</label>
				<input type='date' name='check_in' title='Check in date in format DD/MM/YYYY' min=<?=date('Y-m-d')?> required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'>
				<label>Check Out</label>
				<input type='date' name='check_out' title='Check out date in format DD/MM/YYYY' min=<?=date('Y-m-d')?> required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'>
				<label>Number of Guests</label>
				<input type='number' min='1' max=<?=$item['guests']?> value='1'/>
				<!-- <label>Number of Adults</label>
				<input type='number' min='1' max=<?=$item['guests']?> value='1'/>
				<label>Number of Children</label>
				<input type='number' min='1' max=<?=$item['guests']?> value='1'/>
				<label>Number of Babies</label>
				<input type='number' min='1' max=<?=$item['guests']?> value='1'/> -->
				<button class='rent_button'>Rent</button>
			</form>
		  </section>

    </aside>
<?php
    draw_allComments($comments);
    if(isset($_SESSION['id'])){ ?>
      <form id='comment_form' action='../actions/action_comment.php' method='POST'>
          <h4>Leave a comment</h4>
          <textarea name='comment' cols='40' rows='5' placeholder='Describe your experience' required></textarea>
          <input name='property_id' type='hidden' value='<?=$item['id']?>'/>
          <button class='comment_button'>Comment</button>
      </form>
    <?php }
    else { ?>
      <p id='comment_form'>To leave a comment please log in.</p>
    <?php } 
 } ?>


