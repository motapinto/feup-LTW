<?php
    include_once('../includes/session.php');        // starts the session

    if(!isset($_SESSION['id']))
        die(header('Location: ../listings/listings_all.php'));

    include_once('../database/users.php');          // user functions

    if(isset($_GET['name'])) $option = 0;
    else if(isset($_GET['email'])) $option = 1;
    else if(isset($_GET['age'])) $option = 2;
    else if(isset($_GET['password'])) $option = 3;
    $user = userProfile($_SESSION['id']);

    switch ($option){
        // user name
        case 0:
            changeUser($user['id'], $user['email'], $_GET['name'], $user['age'], $user['password']);
            break;
        // user mail
        case 1:
            changeUser($user['id'], $_GET['email'], $user['name'], $user['age'], $user['password']);
            break;
        // user age
        case 2:
            changeUser($user['id'], $user['email'], $user['name'], $_GET['age'], $user['password']);
            break;   
        // user password
        case 3:
            changeUser($user['id'], $user['email'], $user['name'], $user['age'], $_GET['password']);
            break; 
        
        default:
            break;
    }

?>