<?php
  include_once('../includes/session.php');       // starts the session
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');

  if(isset($_SESSION['email']))
    header('Location: ../listings/listings_all.php');

  draw_header('Login');
  draw_login();
  draw_footer();
?>
