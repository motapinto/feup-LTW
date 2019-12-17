<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/rents.php');      // properties functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX

    $ret = array('response' => -3);

    if(!isset($_SESSION['id']) || !isset($_GET['id']) || !isset($_GET['daterange']) || !isset($_GET['adults']) || !isset($_GET['children']) || !isset($_GET['babies'])){
        encodeForAJAX($ret);
        die();
    }
    
    if ($_SESSION['csrf'] !== $_GET['csrf']) {
        // ERROR: Request does not appear to be legitimate
        encodeForAJAX($ret);
        die();
    }

    $daterange = $_GET['daterange'];

    $id = htmlentities($_GET['id'], ENT_QUOTES, 'UTF-8');
    $adults = htmlentities($_GET['adults'], ENT_QUOTES, 'UTF-8');
    $children = htmlentities($_GET['children'], ENT_QUOTES, 'UTF-8');
    $babies = htmlentities($_GET['babies'], ENT_QUOTES, 'UTF-8');

    if(preg_match('/([0-9]{2})\/([0-9]{2})\/([0-9]{4}) - ([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', $daterange, $date_array) &&
        preg_match('/^[0-9]+$/', $adults, $output_array) && preg_match('/^[0-9]+$/', $children, $output_array) &&
        preg_match('/^[0-9]+$/', $babies, $output_array) && preg_match('/^[0-9]+$/', $id, $output_array) ){
            
        $date_init = $date_array[3] . '-' . $date_array[2] . '-' . $date_array[1];
        $date_final = $date_array[6] . '-' . $date_array[5] . '-' . $date_array[4];
    }
    else {
        encodeForAJAX($ret);
        die();
    }

    $ret['response'] = addRent($_SESSION['id'], $id, $date_init, $date_final, 
                $adults, $children, $babies)?0:-1;
    
    encodeForAJAX($ret);
?>