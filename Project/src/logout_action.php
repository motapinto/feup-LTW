<?php
    session_destroy();// ends the session
    header('Location: ' . "login.html"); //redirects to login page
?>