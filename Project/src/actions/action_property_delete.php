<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/listings.php');      // properties functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX

    $ret = array('response' => -2);
        
    
    
    if(!isset($_GET['id']) || !isset($_SESSION['id'])) {
        encodeForAJAX($ret);
        return;
    }
    
    $id = $_SESSION['id'];
    $property_id = $_GET['id'];

    $property = getListingById($property_id);

    if($property === false || $property['user_id'] !== $id){
        encodeForAJAX($ret);
        return;
    }

    $images = getImagesByPropertyId($property_id);

    foreach ($images as $image) {
        deleteImage($image['name'], 'PROPERTY');
    }

    $ret['response'] = deleteListing($property_id);

    encodeForAJAX($ret);
?>