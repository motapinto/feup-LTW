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
    $item = getListingById($id);                     // gets all listings from the database
    $comments = getCommentsByPropertyId($id);
    $images = getImagesByPropertyId($id);

    draw_header('Campus Rentals');
    draw_navBar(0);
    draw_item($item);
    draw_footer();
?>