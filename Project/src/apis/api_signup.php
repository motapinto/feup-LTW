<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/users.php');         // user functions
    include_once('../templates/tpl_common.php');   // encodeForAJAX

    $ret = array('response' => -3);

    if(!isset($_GET['email']) || !isset($_GET['password']) || !isset($_GET['name']) || !isset($_GET['age']) ||
        !preg_match('/(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])./', $_GET['password'], $output_array) || 
        !preg_match('/^[a-z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?(?:\.[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?)*$/', $_GET['email'], $output_array) || 
        !preg_match('/^[0-9]+$/', $_GET['age'], $output_array) ||
        !preg_match('/^[a-zA-Z\x{00C0}-\x{00FF}]+(([\' -][a-zA-Z\x{00C0}-\x{00FF}])?[a-zA-Z\x{00C0}-\x{00FF}]*)*$/', $_GET['name'], $output_array) ){
        
        encodeForAJAX($ret);
        die();
    }

    $email = htmlentities($_GET['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlentities($_GET['password'], ENT_QUOTES, 'UTF-8');
    $name = htmlentities($_GET['name'], ENT_QUOTES, 'UTF-8');
    $age = htmlentities($_GET['age'], ENT_QUOTES, 'UTF-8');

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