<?php
    include_once('../includes/session.php');        // starts session
    include_once('../database/users.php');          // user functions
    
    include('../templates/tpl_common.php');         // prints the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');         // prints the top navigation bar
    include('../templates/tpl_profile.php');        // prints the user profile

    if(!isset($_SESSION['id']))
      header('Location: ../listings/all_listings.php');

    draw_header('User Profile');
    draw_navBar();
    $user = userProfile($_SESSION['id']);        // get's current user
    draw_profile($user);
    draw_footer()
?>