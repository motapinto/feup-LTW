<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/users.php');         // user functions

        
    $ret = array('response' => '');
    $ret['response'] = checkUser($_GET['email'], $_GET['password']);

    if($ret['response'] != -1 && $ret['response'] != -2) {
        $_SESSION['id'] = $ret['response'];                 // store the username
        header('Location: ../listings/listings_all.php');   // lists all listings
    }

    encodeForAjax($ret);
?>
<script>
    function encodeForAjax(data) {
        return Object.keys(data).map(function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }).join('&')
    }
</script>