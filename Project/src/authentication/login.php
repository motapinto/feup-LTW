<?php
  include_once('../includes/session.php');       // starts the session
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');

  if(isset($_SESSION['id']))
    header('Location: ../listings/listings_all.php');

  draw_header('Login', 'auth');
  draw_login();
  draw_footer();
?>
