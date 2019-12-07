<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
    include('../templates/tpl_listings.php');             // prints the list of listings in HTML
    include('../templates/tpl_filter.php');               // prints the listings filter in HTML

    $types = array();

    if(isset($_POST['price_min'])) {
        $min = $_POST['price_min'];
        htmlentities($min, ENT_QUOTES, 'UTF-8');
    
        $max = $_POST['price_max'];
        htmlentities($max, ENT_QUOTES, 'UTF-8');
    
        $house = $_POST['house'];
        htmlentities($house, ENT_QUOTES, 'UTF-8');
        array_push($types, $house);
    
        $apartment = $_POST['apartment'];
        htmlentities($apartment, ENT_QUOTES, 'UTF-8');
        array_push($types, $apartment);
    
        $listings = getListingsFilter($types, $min, $max);      
    }

    else {
        $listings = getAllListings();
    }

    draw_header('All Listings');
    draw_navBar(0);    
    draw_list_all($listings);
    draw_footer();
?>