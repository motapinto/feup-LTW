<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
    include('../templates/tpl_listings.php');             // prints the list of listings in HTML
    include('../templates/tpl_filter.php');               // prints the listings filter in HTML

    $types = array();
    if(isset($_POST['price_min'])){
        $priceMin = $_POST['price_min'];
        $priceMax = $_POST['price_max'];
        if(isset($_POST['house']))
            array_push($types, $_POST['house']);
        if(isset($_POST['apartment']))
            array_push($types, $_POST['apartment']);
        $city = $_POST['city'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $listings = getListingsFilter($types, $priceMin, $priceMax, $city, $checkin, $checkout);                        // gets all listings from the database
    }    
    else $listings = getAllListings();

    draw_header('All Listings');
    draw_navBar(0);    
    draw_list_all($listings);
    draw_footer();
?>