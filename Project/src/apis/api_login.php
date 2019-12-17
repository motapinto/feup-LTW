<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/users.php');         // user functions
    include_once('../templates/tpl_common.php');   // encodeForAJAX

    $ret = array('response' => -1);

    $email = $_GET['email'];
    $password = $_GET['password'];
    
    $ret['response'] = checkUser($email, $password);

    if($ret['response'] != -1 && $ret['response'] != -2) {
        $_SESSION['id'] = $ret['response'];                 // store the username
    }

    encodeForAJAX($ret);
?>