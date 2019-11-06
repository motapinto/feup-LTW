<?php
    function logOut($msg) {

        session_destroy();// ends the session
        if(empty($msg)) {
            header('Location: '."../login/login.php");           //no error message
        }
        else {
            header('Location: '."../login/login.php?msg=".$msg); //send to login error message
        }
    }
?>