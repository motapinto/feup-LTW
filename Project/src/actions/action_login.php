<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/users.php');         // users functions

    if(!isset($_POST['email']) || !isset($_POST['password']))
        include('../authentication/logout_action.php');    

    $checkUserReturn = checkUser($_POST['email'], $_POST['password']);
  
    switch($checkUserReturn) { 
        case "User does not exist":
            include('logout_action.php');
            break;   
          
        case "User exists":
            $_SESSION['email'] = $_POST['email'];               // store the username
            header('Location: ../listings/listings_all.php');   // lists all listings
            break;                                
          
        case "User exists but wrong password":
            include('action_logout.php');
            break;   
    }
?>