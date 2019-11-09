<?php
    session_start();
    include_once('../database/users.php');          // user functions
    
    include('../templates/tpl_common.php');         // prints the initial part of the HTML document
    include('../templates/tpl_navBar.php');         // prints the menu in HTML
    include('../templates/tpl_profile.php');        // prints the user profile
    include('../templates/common/footer.php');      // prints the final part of the HTML document

    draw_header('User Profile');
    draw_navBar();
    $user = userProfile($_SESSION['email']);        // get's current user
    draw_profile($user);
    draw_footer()
?>