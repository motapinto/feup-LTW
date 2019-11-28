<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/users.php');          // user functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX


    if(!isset($_SESSION['id']))
        die(header('Location: ../listings/listings_all.php'));

    if(isset($_GET['name'])) $option = 0;
    else if(isset($_GET['email'])) $option = 1;
    else if(isset($_GET['age'])) $option = 2;
    else if(isset($_GET['password'])) $option = 3;
    else if(isset($_GET['currentPassword'])) $option = 4;
    $user = userProfile($_SESSION['id']);

    $ret = array('response' => '');

    switch ($option){
        // user name
        case 0:
            $ret['response'] = changeUser($user['id'], $user['email'], $_GET['name'], $user['age'], $user['password']);
            break;
        // user mail
        case 1:
            $ret['response'] = changeUser($user['id'], $_GET['email'], $user['name'], $user['age'], $user['password']);
            break;
        // user age
        case 2:
            $ret['response'] = changeUser($user['id'], $user['email'], $user['name'], $_GET['age'], $user['password']);
            break;   
        // user password
        case 3:
            $ret['response'] = changeUser($user['id'], $user['email'], $user['name'], $user['age'], $_GET['password']);
            break; 

        // confirms current password
        case 4:
            if($user['password'] === sha1($_GET['currentPassword']))
                $ret['response'] = 0;
            else
                $ret['response'] = -1;
        
        default:
            break;
    }

    encodeForAJAX($ret);
?>