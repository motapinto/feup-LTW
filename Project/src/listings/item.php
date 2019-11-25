<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions
    include_once('../database/comments.php');             // comments functions
    include_once('../database/images.php');               // images functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');                  // prints the menu in HTML
    include('../templates/tpl_listings.php');    // prints the list of listings in HTML
    include('../templates/tpl_comments.php');    // prints the list of listings in HTML

    $id = $_GET['id'];
    $item = getListingById($id);
    if(isset($_SESSION['id']) && $item['user_id'] === $_SESSION['id'])
        $owner = true;
    else $owner = false;    
    $comments = getCommentsByPropertyId($id);
    $images = getImagesByPropertyId($id);

    draw_header('Campus Rentals');
    draw_navBar();

?>
    <section id='list'>
        <article class='property'>
            <h2><input type="<?php if($owner){ ?>text<?php } else { ?>disable <?php } ?>" name="title" value="<?=$item['title']?>"></h2>
            <ul> 
            <?php foreach ($images as $image) { 
                $imageId = $image['id'];
                if(file_exists("../../assets/images/thumbs_medium/p_$imageId.jpg"))
                    $imagePath = "../../assets/images/thumbs_medium/p_$imageId.jpg";
                else if(file_exists("../../assets/images/thumbs_medium/p_$imageId.png"))
                    $imagePath = "../../assets/images/thumbs_medium/p_$imageId.png"; ?>
                    
                <li><img src=<?=$imagePath?> alt='Image of the property '></li>          
            <?php } ?>
            </ul>
            <?php if($owner){ ?>
                <a href="../properties/add_property_image.php?id=<?=$id?>">Add image(s)</a>
            <?php } ?>
            <!-- Galeria de imagens, possivelmente usando scripts? -->
            <textarea name='description' <?php if(!$owner){ ?>readonly <?php } ?>>
            <?=$item['description']?>
            </textarea>
            <p>Rating: <?=$item['rating']?></p>
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
            <p>Price per day: <?=$item['price_day']?>$</p>
        </article>
        <article class='rent'>
            <?php if(isset($_SESSION['id'])) { ?>
                <form action="../rent/rent.php" method="POST">
                    <input name="id" type='hidden' value=<?=$id?>/>
                    <label>Check In</label>
                    <input type="date" name="check_in" title='Check in date in format DD/MM/YYYY' min=<?=date('Y-m-d')?> required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    <label>Check Out</label>
                    <input type="date" name="check_out" title='Check out date in format DD/MM/YYYY' min=<?=date('Y-m-d')?> required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    <label>Number of Guests</label>
                    <input type="number" min="1" max=<?=$item['guests']?> value="1"/>
                    <!-- <label>Number of Adults</label>
                    <input type="number" min="1" max=<?=$item['guests']?> value="1"/>
                    <label>Number of Children</label>
                    <input type="number" min="1" max=<?=$item['guests']?> value="1"/>
                    <label>Number of Babies</label>
                    <input type="number" min="1" max=<?=$item['guests']?> value="1"/> -->
                    <button class="rent_button">Rent</button>
                </form>
            <?php } 
            else { ?>
                <p>If you want to rent this property please <a href='../authentication/login.php'>Log In</a>.</p>
            <?php } ?>
        </article>
    </section>
<?php


    draw_allComments($comments);


    if(isset($_SESSION['id'])){ ?>
        <form id='comment_form' action="../actions/action_comment.php" method="POST">
            <h4>Leave a comment</h4>
            <textarea name="comment" cols="40" rows="5" placeholder="Describe your experience" required></textarea>
            <input name="property_id" type="hidden" value="<?=$id?>"/>
            <button class="comment_button">Comment</button>
        </form>
    <?php }
    else { ?>
        <p id='comment_form'>To leave a comment please log in.</p>
    <?php }

    draw_footer();
?>