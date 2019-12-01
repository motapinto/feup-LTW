<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
    include('../templates/listings/all_listings.php');    // prints the list of listings in HTML

    if (!isset($_GET['search']) || strlen($_GET['search']) < 0)    // check if input is valid (check if any property exists with that city?)
        die("Invalid search!");

    $search = $_GET['search'];
    htmlentities($search, ENT_QUOTES, 'UTF-8');

    $listings = getListingByCity($_GET['search']);               // gets all listings in city from the database

    draw_header('Listings City');
    draw_navBar(0);

    draw_allListings($listings);

    draw_footer();
?>