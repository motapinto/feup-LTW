<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');                  // prints the menu in HTML
    include('../templates/tpl_listings.php');    // prints the list of listings in HTML

    draw_header('All Listings');
    draw_navBar(true);
    $listings = getAllListings();                        // gets all listings from the database
    draw_allListings($listings);
    draw_footer();
?>