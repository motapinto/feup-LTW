<?php
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');

  draw_header('Signup', 'authentication');
  draw_signup();
  draw_footer();
?>
