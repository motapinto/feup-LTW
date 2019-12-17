<?php

    // Local Host is not a certified server, for testing purposes cookie_secure is not set to 1
    // ini_set('session.cookie_secure', '1');

    ini_set('session.cookie_httponly', '1');
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
?>