<?php
    include_once('../includes/session.php');              // starts session
    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php');                                 // main webpage

    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions
    include_once('../database/images.php');               // images functions
    include_once('../database/rents.php');                // rents functions
    include_once('../database/users.php');                // users functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
    include('../templates/tpl_propertyDetails.php');      // template of add new property
    
    if(isset($_GET['id']) && $_GET['id'] != null) {
        $new = false;
        $id = $_GET['id'];
        htmlentities($id, ENT_QUOTES, 'UTF-8');
        $selected = getListingById($id);
        if($selected['user_id'] !== $_SESSION['id'])
            die(header('Location: ../listings/listings_all.php'));
    } 

    else {
        $new = true;
    }

    draw_header('My Properties', 'property');
    draw_navBar(1);
    $new ? addProperty() : addProperty($id);
    draw_footer();
?>