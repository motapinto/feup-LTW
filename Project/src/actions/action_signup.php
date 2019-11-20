<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/users.php');         // users functions
    
    $checkUserReturn = checkUser($_POST['email'], $_POST['password']);
  
    switch($checkUserReturn) { 
        case "User does not exist":
            if(addUser($_POST['email'], $_POST['password'], $_POST['name'], $_POST['age']))
                header('Location: ../authentication/login.php');                                 // login
            else 
                include('../actions/action_logout.php');
            break;   
        
        default :
            include('../actions/action_logout.php');
            break;                                
    }
?>