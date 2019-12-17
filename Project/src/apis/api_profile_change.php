<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/users.php');          // user functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX

    $ret = array('response' => -3);

    if(!isset($_SESSION['id'])){
        encodeForAJAX($ret);
        die();
    }
        
    if ($_SESSION['csrf'] !== $_GET['csrf']) {
        // ERROR: Request does not appear to be legitimate
        encodeForAJAX($ret);
        die();
    }

    $user = userProfile($_SESSION['id']);

    if(isset($_GET['name'])) {
        if(!preg_match('/^[a-zA-Z\x{00C0}-\x{00FF}]+(([\' -][a-zA-Z\x{00C0}-\x{00FF}])?[a-zA-Z\x{00C0}-\x{00FF}]*)*$/', $_GET['name'], $output_array)){
            $ret['response'] = -2;
            die();
        }
        $user['name'] = htmlentities($_GET['name'], ENT_QUOTES, 'UTF-8');
        $ret['response'] = -10;
    }
    else if(isset($_GET['email'])) {
        if(!preg_match('/^[a-z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?(?:\.[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?)*$/', $_GET['email'], $output_array)){
            $ret['response'] = -2;
            die();
        }
        $user['email'] = htmlentities($_GET['email'], ENT_QUOTES, 'UTF-8');
        $ret['response'] = -10;
    }
    else if(isset($_GET['age'])) {
        if(!preg_match('/^[0-9]+$/', $_GET['age'], $output_array)){
            $ret['response'] = -2;
            die();
        }
        $user['age'] = htmlentities($_GET['age'], ENT_QUOTES, 'UTF-8');
        $ret['response'] = -10;
    }
    else if(isset($_GET['password'])) {
        if(!preg_match('/(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])./', $_GET['password'], $output_array)){
            $ret['response'] = -2;
            die();
        }
        $user['password'] = password_hash($_GET['password'], PASSWORD_DEFAULT);
        $ret['response'] = -10;
    }   
    else if(isset($_GET['currentPassword'])) {
        if(password_verify($_GET['currentPassword'], $user['password']))
            $ret['response'] = 0;
        else
            $ret['response'] = -1;
    }
    else if(isset($_GET['deleteUser'])) {
        deleteUser($_SESSION['id']);
        $ret['response'] = 0;
    }
    else 
        die();

    if($ret['response'] === -10)
        $ret['response'] = changeUser($user['id'], $user['email'], $user['name'], $user['age'], $user['password']);

    encodeForAJAX($ret);
?>