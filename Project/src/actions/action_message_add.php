<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/messages.php');      // messages functions
    
    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php'); 
    
    //must receive all parameters
    if(!isset($_GET['sendMessage']) || !isset($_GET['receiver'])) 
        header('Location: ../profile/profile.php'); 

    $sendMessage = $_GET['sendMessage'];
    $receiver = $_GET['receiver'];
    // Remove disallowed characters -XSS protection
    // $sendMessage = preg_replace ("/[^a-zA-Z\s]/", '', $sendMessage);
    // $receiver = preg_replace ("/[^a-zA-Z\s]/", '', $receiver);
  
    $result = addMessage($receiver, $_SESSION['id'], $sendMessage);
?>