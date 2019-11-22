<?php
    include_once('../includes/session.php');              // starts session
    include_once('../database/users.php');          // user functions
    
    include('../templates/tpl_common.php');         // prints the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');         // prints the menu in HTML
    include('../templates/tpl_profile.php');        // prints the user profile
    //include('../templates/tpl_profile-edit.php');   // prints de profile settings

    if(!isset($_SESSION['id']))
      header('Location: ../listings/all_listings.php');

    draw_header('User Profile');
    draw_navBar();
    $user = userProfile($_SESSION['id']);        // get's current user
    draw_profile($user);
    //draw_profile_settings($user);
    //draw_profile_overview($user);
    //draw_profile_comments($user, $comments);
    draw_footer()
?>