<?php
    function logOut($msg) {

        session_destroy();// ends the session
        if(empty($msg)) {
            header('Location: '."login.php");           //no error message
        }
        else {
            header('Location: '."login.php?msg=".$msg); //send to login error message
        }
    }
?>