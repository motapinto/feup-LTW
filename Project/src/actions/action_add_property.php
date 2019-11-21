<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/listings.php');      // properties functions
    
    if(!isset($_SESSION['email']))
        header('Location: ../listings/listings_all.php');                                 // main webpage
  
    if( addListing($_SESSION['email'], $_POST['title'], $_POST['description'], 
                $_POST['price_day'], $_POST['guests'], $_POST['city'],
                $_POST['street'], $_POST['door_number'], $_POST['apartment_number'],
                $_POST['property_type']) )
        header('Location: ../properties/add_property_image.php');

    $_SESSION['err_msg'] = "Failled to add property";
    header('Location: ../properties/add_property_image.php');
?>