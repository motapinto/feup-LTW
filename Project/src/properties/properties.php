<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');                  // prints the menu in HTML
    include('../templates/tpl_properties.php');    // prints the list of listings in HTML

    draw_header('My Properties');
    draw_navBar();
    $properties = getListingsByEmail($_SESSION['email']);                        // gets all listings from the database
    draw_properties($properties);

?>
    <section id='addProperty'>
        <a href="add_property.php"><button>Add a property</button></a>
    </section>
<?php

    draw_footer();
?>