<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/users.php');          // user functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX

    if(!isset($_SESSION['id']))
        die(header('Location: ../listings/listings_all.php'));
        
    $ret = array('response' => -3);
    $user = userProfile($_SESSION['id']);

    if(isset($_GET['name'])) {
        $aux = $_GET['name'];
        //$aux = preg_replace ("/[^a-zA-Z\s]/", '', $aux);
        $user['name'] = $aux;
    }
    else if(isset($_GET['email'])) {
        $aux = $_GET['email'];
        htmlentities($aux, ENT_QUOTES, 'UTF-8');
        $user['email'] = $aux;
    }
    else if(isset($_GET['age'])) {
        $aux = $_GET['age'];
        htmlentities($aux, ENT_QUOTES, 'UTF-8');
        $user['age'] = $aux;
    }
    else if(isset($_GET['password'])) {
        $aux = $_GET['password'];
        htmlentities($aux, ENT_QUOTES, 'UTF-8');
        $user['password'] = $aux;
    }
    else if(isset($_GET['currentPassword'])) {
        $aux = $_GET['currentPassword'];
        htmlentities($aux, ENT_QUOTES, 'UTF-8');
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