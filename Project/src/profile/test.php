<?php
    include_once('../includes/session.php');        // starts session
    include_once('../database/listings.php');          // user functions
        include('../templates/tpl_common.php');         // prints the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');         // prints the top navigation bar
    include('../templates/tpl_profile.php');        // prints the user profile

    draw_header('User Profile', 'profile');
    	
    getListingsFilter([0], 0, 100, 'Vila do Conde');
    
    draw_footer()
?>