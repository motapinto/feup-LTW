<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/listings.php');      // properties functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX

    $ret = array('response' => -2);
        
    if(!isset($_GET['title']) || !isset($_GET['description']) || !isset($_GET['price_day']) || !isset($_GET['guests']) ||
    !isset($_GET['city']) || !isset($_GET['street']) || !isset($_GET['door_number']) || !isset($_GET['apartment_number']) ||
    !isset($_GET['property_type']) || !isset($_SESSION['id'])) {
        encodeForAJAX($ret);
        die();
    }

    $title = $_GET['title'];
    $description = $_GET['description'];
    $price_day = $_GET['price_day'];
    $guests = $_GET['guests'];
    $city = $_GET['city'];
    $street = $_GET['street'];
    $door_number = $_GET['door_number'];
    $apartment_number = $_GET['apartment_number'];
    $property_type = $_GET['property_type'];

    if(!preg_match('/^[0-9]+$/', $price_day, $output_array) || !preg_match('/^[0-9]+$/', $door_number, $output_array) || 
        !preg_match('/^[a-zA-Z ]+$/', $city, $output_array) || !preg_match('/^[a-zA-Z ]+$/', $street, $output_array) || 
        ($apartment_number && !preg_match('/^[0-9]+$/', $apartment_number, $output_array)) ) {

            encodeForAJAX($ret);
            die();
    }


    $title = htmlentities($title, ENT_QUOTES, 'UTF-8');
    $description = htmlentities($description, ENT_QUOTES, 'UTF-8');
    $price_day = htmlentities($price_day, ENT_QUOTES, 'UTF-8');
    $guests = htmlentities($guests, ENT_QUOTES, 'UTF-8');
    $city = htmlentities($street, ENT_QUOTES, 'UTF-8');
    $street = htmlentities($street, ENT_QUOTES, 'UTF-8');
    $door_number = htmlentities($door_number, ENT_QUOTES, 'UTF-8');
    $apartment_number = htmlentities($apartment_number, ENT_QUOTES, 'UTF-8');
    $property_type = htmlentities($property_type, ENT_QUOTES, 'UTF-8');


    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $id = htmlentities($id, ENT_QUOTES, 'UTF-8');

        $ret['response'] = changeListing($id, $_SESSION['id'], $title, $description, 
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