<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/users.php');          // user functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX

    if(!isset($_SESSION['id']))
        die(header('Location: ../listings/listings_all.php'));
        
    $ret = array('response' => -3);
    $user = userProfile($_SESSION['id']);

    if(isset($_GET['name'])) $user['name'] = $_GET['name'];
    else if(isset($_GET['email'])) $user['email'] = $_GET['email'];
    else if(isset($_GET['age'])) $user['age'] = $_GET['age'];
    else if(isset($_GET['password'])) $user['password'] = $_GET['password'];
    else if(isset($_GET['currentPassword'])) {
        if($user['password'] === sha1($_GET['currentPassword']))
            $ret['response'] = 0;
        else
            $ret['response'] = -1;
    }
    else 
        die(header('Location: ../listings/listings_all.php'));

    if($ret['response'] === -3)
        $ret['response'] = changeUser($user['id'], $user['email'], $user['name'], $user['age'], $user['password']);

    encodeForAJAX($ret);
?>