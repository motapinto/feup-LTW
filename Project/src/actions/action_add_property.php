<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/listings.php');      // properties functions
    
    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php');                                 // main webpage
  

    print_r($_POST['property_type']);
    $result = addListing($_SESSION['id'], $_POST['title'], $_POST['description'], 
                $_POST['price_day'], $_POST['guests'], $_POST['city'],
                $_POST['street'], $_POST['door_number'], $_POST['apartment_number'],
                $_POST['property_type']);
    
    if($result !== false){
        $id = $result['id'];
        header("Location: ../properties/add_property_image.php?id=$id");
    }

    $_SESSION['err_msg'] = "Failled to add property";
    header('Location: ../properties/add_property.php');
?>