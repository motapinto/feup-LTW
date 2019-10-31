<?php
    session_start();// starts the session
    session_destroy();// ends the session
    header('Location: ' . "login.php"); //redirects to login page
?>