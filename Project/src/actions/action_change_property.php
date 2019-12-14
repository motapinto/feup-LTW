<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/listings.php');      // properties functions
    
    $ret = array('response' => '');
        
    $title = $_GET['title'];
    $description = $_GET['description'];
    $price_day = $_GET['price_day'];
    $guests = $_GET['guests'];
    $city = $_GET['city'];
    $street = $_GET['street'];
    $door_number = $_GET['door_number'];
    $apartment_number = $_GET['apartment_number'];
    $property_type = $_GET['property_type'];

    if(!isset($title) || !isset($description) || !isset($price_day) || !isset($guests) ||
    !isset($city) || !isset($street) || !isset($door_number) || !isset($apartment_number) ||
    !isset($property_type)) {
        $ret['response'] = -2;
        return;
    }

    htmlentities($title, ENT_QUOTES, 'UTF-8');
    htmlentities($description, ENT_QUOTES, 'UTF-8');
    htmlentities($price_day, ENT_QUOTES, 'UTF-8');
    htmlentities($guests, ENT_QUOTES, 'UTF-8');
    htmlentities($street, ENT_QUOTES, 'UTF-8');
    htmlentities($street, ENT_QUOTES, 'UTF-8');
    htmlentities($door_number, ENT_QUOTES, 'UTF-8');
    htmlentities($apartment_number, ENT_QUOTES, 'UTF-8');
    htmlentities($property_type, ENT_QUOTES, 'UTF-8');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        htmlentities($id, ENT_QUOTES, 'UTF-8');

        $ret['response'] = changeListing($id, $title, $description, 
            $price_day, $guests, $city,
            $street, $door_number, $apartment_number,
            $property_type);
    }
    else {
        $ret['response'] = addListing($_SESSION['id'], $title, $description, 
            $price_day, $guests, $city,
            $street, $door_number, $apartment_number,
            $property_type);
    }

    encodeForAJAX($ret);
?>