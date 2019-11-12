<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');                  // prints the menu in HTML
    include('../templates/listings/all_listings.php');    // prints the list of listings in HTML

    $id = $_GET['id'];
    $item = getListingById($id);

    draw_header('All Listings');
    draw_navBar();

?>
    <section>
      <article>
        <h2><?=$item['title']?></h2>
        <p><?=$item['description']?></p>
        <p>Rating: <?=$item['rating']?></p>
        <p>Property type:<?=$item['property_type']?></p>
        <p>Address: <?=$item['street']?>, n<?=$item['door_number']?>, <?=$item['city']?></p>
        <p>Price per day: <?=$item['price_day']?>$</p>
      </article>
    </section>

<?php

    draw_footer();
?>