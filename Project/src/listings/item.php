<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions
    include_once('../database/comments.php');             // comments functions
    include_once('../database/images.php');               // images functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
            include('../templates/tpl_listings.php');     // prints the list of listings in HTML
            include('../templates/tpl_comments.php');     // prints the list of listings in HTML

    $id = $_GET['id'];
    htmlentities($id, ENT_QUOTES, 'UTF-8');

    $item = getListingById($id);

    draw_header('Campus Rentals', 'rent');
    draw_navBar(-1);

    if(isset($_SESSION['id']) && $item['user_id'] === $_SESSION['id'])
        draw_item($item, true);
    else         
        draw_item($item, false);

    draw_footer();
?>