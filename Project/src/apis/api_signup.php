<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/users.php');         // user functions
    include_once('../templates/tpl_common.php');   // encodeForAJAX

    $ret = array('response' => -3);

    $email = $_GET['email'];
    $password = $_GET['password'];
    $name = $_GET['name'];
    $age = $_GET['age'];
    htmlentities($email, ENT_QUOTES, 'UTF-8');
    htmlentities($password, ENT_QUOTES, 'UTF-8');
    htmlentities($name, ENT_QUOTES, 'UTF-8');
    htmlentities($password, ENT_QUOTES, 'UTF-8');

    $check = checkUser($email, $password);


    if($check === -1) {
        if(addUser($email, $password, $name, $age) !== false)
            $ret['response'] = 0;
        else 
            $ret['response'] = -2;
    }
    else {
        $ret['response'] = -1;
    }

    encodeForAJAX($ret);
?>