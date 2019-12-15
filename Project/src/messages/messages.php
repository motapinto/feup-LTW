<?php
    function checkUserId($allMessengers, $user){
        foreach ($allMessengers as $messenger) {
            if($messenger['user'] === $user)
                return true;
        }
        return false;
    }

    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/messages.php');             // messages functions
    include_once('../database/users.php');                // user functions
    include_once('../database/images.php');               // images functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
    include('../templates/tpl_messages.php');             // messages template

    if(!isset($_SESSION['id']))
        die(header('Location: ../listings/listings_all.php'));
    
    $allMessengers = getAllMessengers($_SESSION['id']);
    $userSelected = $allMessengers[0]['user'];

    if(isset($_GET['user'])) {
        $userSelected = checkUserId($allMessengers, $_GET['user'])?$_GET['user']:$allMessengers[0]['user'];
        htmlentities($userSelected, ENT_QUOTES, 'UTF-8');        
    }

    draw_header('Messages', 'messages');
    draw_navBar(4);
    $messengers = getAllMessengers($_SESSION['id']);      // gets all users that have exchange messages with from the database 
    draw_messages($messengers, $userSelected);
    draw_footer();
?>