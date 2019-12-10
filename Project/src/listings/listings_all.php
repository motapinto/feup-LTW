<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
    include('../templates/tpl_listings.php');             // prints the list of listings in HTML
    include('../templates/tpl_filter.php');               // prints the listings filter in HTML


    function sortPrice($elem1, $elem2) {
        if ($elem1['price_day'] == $elem2['price_day'])
            return 0;
        else if ($elem1['price_day'] < $elem2['price_day'])
            return 1;
        else
            return -1;
    }

    function sortRating($elem1, $elem2) {
        if ($elem1['rating'] == $elem2['rating'])
            return 0;
        else if ($elem1['rating'] < $elem2['rating'])
            return 1;
        else
            return -1;
    }

    function sortNewest($elem1, $elem2) {
        if ($elem1['post_date'] == $elem2['post_date'])
            return 0;
        else if ($elem1['post_date'] < $elem2['post_date'])
            return 1;
        else
            return -1;
    }

    function changePage($input, $page) {
        $offset = $page * 6;
        $start = $offset - 6;
        return array_slice($input, $start, $offset);
    }


    $types = array();
    $filter = false;

    if(isset($_GET['price_min'])) {
        $filter = true;
        $checkdates = false;
        $checkin = ''; 
        $checkout = '';

        $min = $_GET['price_min'];
        htmlentities($min, ENT_QUOTES, 'UTF-8');
    
        $max = $_GET['price_max'];
        htmlentities($max, ENT_QUOTES, 'UTF-8');
    
        $city = $_GET['city'];
        htmlentities($city, ENT_QUOTES, 'UTF-8');

        if(isset($_GET['order-by'])){
            $order_by = $_GET['order-by'];
            htmlentities($order_by, ENT_QUOTES, 'UTF-8');
        }

        if(isset($_GET['house'])){
            htmlentities($_GET['apartment'], ENT_QUOTES, 'UTF-8');
            array_push($types, 0);
        }

        if(isset($_GET['apartment'])){
            htmlentities($_GET['apartment'], ENT_QUOTES, 'UTF-8');
            array_push($types, 1);
        }

        if(isset($_GET['daterange'])){
            if(preg_match('/([0-9]{2})\/([0-9]{2})\/([0-9]{4}) - ([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', $_GET['daterange'], $output_array)){
                $checkdates = true;
                $checkin = $output_array[3] . '-' . $output_array[2] . '-' . $output_array[1];
                $checkout = $output_array[6] . '-' . $output_array[5] . '-' . $output_array[4];
            }
        }

        $page = $_GET['page'];
        htmlentities($_GET['page'], ENT_QUOTES, 'UTF-8');
        
        $listings = getListingsFilter($types, $min, $max, $city, $checkdates, $checkin, $checkout, $page);      
    }

    else {
        $listings = getAllListings();
        $page = 0;
    }
    //Order by user selection
    if(isset($order_by)) {
        switch($order_by) {
            case 1:
                usort($listings, 'sortRating');
                break;
            case 2:
                usort($listings, 'sortRating');
                $listings = array_reverse($listings);
            case 3: 
                usort($listings, 'sortPrice');
                break;
            case 4:
                usort($listings, 'sortPrice');
                $listings = array_reverse($listings);
                break;
            case 5:
                usort($listings, 'sortNewest');
                break;
            case 6:
                usort($listings, 'sortNewest');
                $listings = array_reverse($listings);
            default: 
                break;
        }
    }

    // Limits the number of items per page after being ordered
    $listings = changePage($listings, $page);

    draw_header('All Listings', 'filter');
    draw_navBar(0);    
    draw_list_all($listings, $filter);
    draw_footer();
?>