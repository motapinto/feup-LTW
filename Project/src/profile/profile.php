<?php
    include_once('../includes/session.php');        // starts session
    include_once('../database/users.php');          // user functions
    
    include('../templates/tpl_common.php');         // prints the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');         // prints the top navigation bar
    include('../templates/tpl_profile.php');        // prints the user profile

    if(!isset($_SESSION['id']))
    	header('Location: ../listings/all_listings.php');

	draw_header('User Profile', 'profile');
	
    if(isset($_GET['id']) && $_GET['id'] != $_SESSION['id']) {
        draw_navBar(-1);
		$user = userProfile($_GET['id']); //other user
		draw_profile($user, false);
	}
	else {
        draw_navBar(2);
		$user = userProfile($_SESSION['id']); // own user
		draw_profile($user, true);
	}
    
    draw_footer()
?>