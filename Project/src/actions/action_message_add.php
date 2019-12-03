<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/messages.php');      // messages functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX
    
    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php'); 
    
    $result = array('response' => -3);

    //must receive all parameters
    if(!isset($_GET['sendMessage']) || !isset($_GET['receiver'])){
        encodeForAJAX($result);
        die(); 
    }

    $sendMessage = $_GET['sendMessage'];
    $receiver = $_GET['receiver'];

    htmlentities($sendMessage, ENT_QUOTES, 'UTF-8');
    htmlentities($receiver, ENT_QUOTES, 'UTF-8');
  
    $result['response'] = addMessage($receiver, $_SESSION['id'], $sendMessage)?0:-1;
    encodeForAJAX($result);
?>