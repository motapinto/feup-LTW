<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/messages.php');      // messages functions
    
    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php'); 
    
    //must receive all parameters
    if(!isset($_GET['sendMessage']) || !isset($_GET['receiver'])) 
        header('Location: ../profile/profile.php'); 

        $sender = $_SESSION['id'];

        print_r($_GET['sendMessage']);
        print_r($_GET['receiver']);
        print_r($sender);

  
    $result = addMessage($_GET['receiver'], $sender, $_GET['sendMessage']);
    
    print_r($result);
?>