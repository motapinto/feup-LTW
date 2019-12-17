<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/messages.php');      // messages functions
    include_once('../templates/tpl_common.php');    // encodeForAJAX
    
    $result = array('response' => -3);

    if(!isset($_SESSION['id'])){
        encodeForAJAX($result);
        die(); 
    }
    
    if ($_SESSION['csrf'] !== $_GET['csrf']) {
        encodeForAJAX($result);
        // ERROR: Request does not appear to be legitimate
        die();
    }


    //must receive all parameters
    if(!isset($_GET['sendMessage']) || !isset($_GET['receiver']) ||
        !preg_match('/^[0-9]+$/', $_GET['receiver'], $output_array)){
        encodeForAJAX($result);
        die(); 
    }
  
    $result['response'] = addMessage(
        htmlentities($_GET['receiver'], ENT_QUOTES, 'UTF-8'), $_SESSION['id'],
        htmlentities($_GET['sendMessage'], ENT_QUOTES, 'UTF-8')
    )?0:-1;

    encodeForAJAX($result);
?>