<?php
    include_once('../includes/session.php');              // starts session

    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php');

    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');                  // prints the menu in HTML
    include('../templates/tpl_properties.php');    // prints the list of listings in HTML

    draw_header('My Properties');
    draw_navBar(0);
    $properties = getListingsByUser($_SESSION['id']);                        // gets all listings from the database
    draw_properties($properties);

?>
    <section id='addProperty'>
        <form action="add_property.php">
            <button>Add a property</button>
        </form>
    </section>
<?php

    draw_footer();
?>