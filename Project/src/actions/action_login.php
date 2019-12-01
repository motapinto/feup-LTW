<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/users.php');         // user functions
    include_once('../templates/tpl_common.php');   // encodeForAJAX

    $ret = array('response' => '');

    $email = $_GET['email'];
    $password = $_GET['password'];
    
    htmlentities($email, ENT_QUOTES, 'UTF-8');
    htmlentities($password, ENT_QUOTES, 'UTF-8');

    $ret['response'] = checkUser($email, $password);

    if($ret['response'] != -1 && $ret['response'] != -2) {
        $_SESSION['id'] = $ret['response'];                 // store the username
    }

    encodeForAJAX($ret);
?>