<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/listings.php');      // properties functions
    
    $ret = array();
    
    if(!isset($_SESSION['id'])) {
        $ret['response'] = -1;
        return;
    }
        
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price_day = $_POST['price_day'];
    $guests = $_POST['guests'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $door_number = $_POST['door_number'];
    $apartment_number = $_POST['apartment_number'];
    $property_type = $_POST['property_type'];

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
        $result = changeListing($_SESSION['id'], $title, $description, 
                $price_day, $guests, $city,
                $street, $door_number, $apartment_number,
                $property_type);
    }
    else {
        $result = addListing($_SESSION['id'], $title, $description, 
                    $price_day, $guests, $city,
                    $street, $door_number, $apartment_number,
                    $property_type);
    }

    if($result !== false){
        $id = $result['id'];
        header("Location: ../properties/add_property_image.php?id=$id");
    }

    $_SESSION['err_msg'] = "Failled to add property";
    header('Location: ../properties/propertyDetails.php');
?>