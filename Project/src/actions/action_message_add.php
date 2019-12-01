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

    htmlentities($sendMessage, ENT_QUOTES, 'UTF-8');
    htmlentities($receiver, ENT_QUOTES, 'UTF-8');
  
    $result = addMessage($receiver, $_SESSION['id'], $sendMessage);
?>