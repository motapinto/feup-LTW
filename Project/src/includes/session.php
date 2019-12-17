<?php
    session_set_cookie_params(0, '/', 'www.fe.up.pt', true, true);
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
      }
?>