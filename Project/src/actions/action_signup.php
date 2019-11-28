<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/users.php');         // user functions
    include_once('../templates/tpl_common.php');   // encodeForAJAX

    $ret = array('response' => '');
    $check = checkUser($_GET['email'], $_GET['password']);

    if($check === -1) {
        if(addUser($_GET['email'], $_GET['password'], $_GET['name'], $_GET['age']))
            $ret['response'] = 0;
    }
    else {
        $ret['response'] = -1;
    }


    encodeForAJAX($ret);
?>