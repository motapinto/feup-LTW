<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/rents.php');      // rents functions
    include_once('../database/messages.php');      // messages functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX

    $ret = array('response' => -2);

    if(!isset($_SESSION['id']) || !isset($_GET['id'])){
        encodeForAJAX($ret);
        die();    
    }
       
    if ($_SESSION['csrf'] !== $_GET['csrf']) {
        // ERROR: Request does not appear to be legitimate
        encodeForAJAX($ret);
        die();
    }


    $id = $_GET['id'];
    $rent = getRentDetails($id);
    if(!$rent){
        encodeForAJAX($ret);
        die();
    }

    if($rent['user_id'] !== $_SESSION['id'] && !isset($_GET['owner'])){
        encodeForAJAX($ret);
        die();
    }

    $init = $rent['initial_date'];
    $fin = $rent['final_date'];
    $title = $rent['title'];


    if(!isset($_GET['owner'])){
        if(cancelRent($id)) {
            addMessage($rent['owner'], $_SESSION['id'], "I have canceled my reservation of the property $title between the days $init and $fin.");
            $ret['response'] = 0;
        }
    }
    else if ($_SESSION['id'] === $rent['owner']){
        if(cancelRent($id)) {
            addMessage($_SESSION['id'], $rent['owner'], "I have canceled your reservation of the property $title between the days $init and $fin.");
            $ret['response'] = 0;
        }
    }
    else {
        $ret['response'] = -1;
    }
    
    encodeForAJAX($ret);
?>