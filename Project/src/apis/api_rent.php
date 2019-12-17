<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/rents.php');      // properties functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX

    $ret = array('response' => -3);

    if(!isset($_SESSION['id']) || !isset($_GET['id']) || !isset($_GET['daterange']) || !isset($_GET['adults']) || !isset($_GET['children']) || !isset($_GET['babies']))
        die();
    
    $daterange = $_GET['daterange'];

    $id = htmlentities($_GET['id'], ENT_QUOTES, 'UTF-8');
    $adults = htmlentities($_GET['adults'], ENT_QUOTES, 'UTF-8');
    $children = htmlentities($_GET['children'], ENT_QUOTES, 'UTF-8');
    $babies = htmlentities($_GET['babies'], ENT_QUOTES, 'UTF-8');

    if(preg_match('/([0-9]{2})\/([0-9]{2})\/([0-9]{4}) - ([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', $daterange, $output_array) &&
        preg_match('/^[0-9]+$/', $adults, $output_array) && preg_match('/^[0-9]+$/', $children, $output_array) &&
        preg_match('/^[0-9]+$/', $babies, $output_array) && preg_match('/^[0-9]+$/', $id, $output_array) ){
            
        $date_init = $output_array[3] . '-' . $output_array[2] . '-' . $output_array[1];
        $date_final = $output_array[6] . '-' . $output_array[5] . '-' . $output_array[4];
    }
    else {
        encodeForAJAX($ret);
        die();
    }

    $ret['response'] = addRent($_SESSION['id'], $id, $date_init, $date_final, 
                $adults, $children, $babies)?0:-1;
    
    encodeForAJAX($ret);
?>