<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/users.php');          // user functions
    changeUser(2, 'adas@asd.com', 'asdasd', 12, 'hhh'); //NAO ESTA A CHEGAR AQUI!

    if(isset($_POST['name'])) $option = 0;
    else if(isset($_POST['email'])) $option = 1;
    else if(isset($_POST['age'])) $option = 2;
    else if(isset($_POST['password'])) $option = 3;

    switch ($option){
        // user name
        case 0:
            changeUser($user['id'], $user['email'], $_POST['name'], $user['age'], $user['password']);
            break;
        // user mail
        case 1:
            changeUser($user['id'], $_POST['email'], $user['name'], $user['age'], $user['password']);
            break;
        // user age
        case 2:
            changeUser($user['id'], $user['email'], $user['name'], $_POST['age'], $user['password']);
            break;   
        // user password
        case 3:
            changeUser($user['id'], $user['email'], $user['name'], $user['age'], $_POST['password']);
            break; 
        
        default:
            break;
    }

?>