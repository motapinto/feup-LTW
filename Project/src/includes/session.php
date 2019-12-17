<?php
    // session_set_cookie_params(0, '/', 'localhost/', true, true);
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
?>