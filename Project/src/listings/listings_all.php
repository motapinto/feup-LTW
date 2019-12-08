<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
    include('../templates/tpl_listings.php');             // prints the list of listings in HTML
    include('../templates/tpl_filter.php');               // prints the listings filter in HTML

    $types = array();
    $filter = false;

    if(isset($_GET['price_min'])) {
        $filter = true;
        $min = $_GET['price_min'];
        htmlentities($min, ENT_QUOTES, 'UTF-8');
    
        $max = $_GET['price_max'];
        htmlentities($max, ENT_QUOTES, 'UTF-8');
    
        if(isset($_GET['house'])){
            array_push($types, 0);
        }

        if(isset($_GET['apartment'])){
            array_push($types, 1);
        }
    
        $listings = getListingsFilter($types, $min, $max);      
    }

    else {
        $listings = getAllListings();
    }

    draw_header('All Listings', 'filter');
    draw_navBar(0);    
    draw_list_all($listings, $filter);
    draw_footer();
?>