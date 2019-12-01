<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/listings.php');      // properties functions
    
    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php');    
        
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price_day = $_POST['price_day'];
    $guests = $_POST['guests'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $door_number = $_POST['door_number'];
    $apartment_number = $_POST['apartment_number'];
    $property_type = $_POST['property_type'];
    // Remove disallowed characters -XSS protection
    // $title = preg_replace ("/[^a-zA-Z\s]/", '', $title);
    // $description = preg_replace ("/[^a-zA-Z\s]/", '', $description);
    // $price_day = preg_replace ("/[^a-zA-Z\s]/", '', $price_day);
    // $guests = preg_replace ("/[^a-zA-Z\s]/", '', $guests);
    // $city = preg_replace ("/[^a-zA-Z\s]/", '', $city);
    // $street = preg_replace ("/[^a-zA-Z\s]/", '', $street);
    // $door_number = preg_replace ("/[^a-zA-Z\s]/", '', $door_number);
    // $apartment_number = preg_replace ("/[^a-zA-Z\s]/", '', $apartment_number);
    // $property_type = preg_replace ("/[^a-zA-Z\s]/", '', $property_type);

    print_r($_POST['property_type']);
    $result = addListing($_SESSION['id'], $title, $description, 
                $price_day, $guests, $city,
                $street, $door_number, $apartment_number,
                $property_type);
    
    if($result !== false){
        $id = $result['id'];
        header("Location: ../properties/add_property_image.php?id=$id");
    }

    $_SESSION['err_msg'] = "Failled to add property";
    header('Location: ../properties/add_property.php');
?>