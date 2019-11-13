<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions
    include_once('../database/comments.php');             // comments functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');                  // prints the menu in HTML
    include('../templates/tpl_listings.php');    // prints the list of listings in HTML
    include('../templates/tpl_comments.php');    // prints the list of listings in HTML

    $id = $_GET['id'];
    $item = getListingById($id);
    $comments = getCommentsByEmail($item['email']);

    draw_header('Campus Rentals');
    draw_navBar();

?>
    <section id='list'>
      <article class='property'>
        <h2><?=$item['title']?></h2>
        <!-- Galeria de imagens, possivelmente usando scripts? -->
        <p><?=$item['description']?></p>
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
        <form action="../rent/rent.php" method="GET">
          <input name="id" type='hidden' value=<?=$id?> />
          <button class="rent_button">Rent</button>
        </form>
      </article>
    </section>

<?php


    draw_allComments($comments);


    if(isset($_SESSION['email'])){ ?>
      <form action="../actions/action_comment.php" method="POST">
          <h3>Leave a comment</h3>
          <textarea name="comment" cols="40" rows="5" placeholder="Describe your experience" required></textarea>
          <input name="email" type="hidden" value="<?=$_SESSION['email']?>"/>
          <input name="property_id" type="hidden" value="<?=$id?>"/>
          <button class="comment_button">Comment</button>
      </form>
<?php }
    else { ?>
      <p>To leave a comment please log in</p>
<?php }

    draw_footer();
?>