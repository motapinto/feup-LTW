<?php
    include_once('../includes/session.php');        // starts session
    include_once('../database/users.php');          // user functions
    include_once('../database/rents.php');          // rent's functions
    include_once('../database/comments.php');       // comment's functions
    include_once('../database/images.php');         // images funtions
    include_once('../database/listings.php');       // listings funtions
    
    include('../templates/tpl_common.php');         // prints the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');         // prints the top navigation bar
    include('../templates/tpl_profile.php');        // prints the user profile

    if(!isset($_SESSION['id']))
    	die(header('Location: ../listings/listings_all.php'));

    draw_header('User Profile', 'profile');
        
    //visiting other profile
    if(isset($_GET['id']) && $_GET['id'] != $_SESSION['id']) {
        draw_navBar(-1);

        $id = $_GET['id'];
        htmlentities($id, ENT_QUOTES, 'UTF-8');
        $user = userProfile($id);            
        if($user === false)
            die(header('Location: ../listings/listings_all.php'));
		draw_profile($user);
    }
    //visiting own profile
	else {
        draw_navBar(2);

        $user = userProfile($_SESSION['id']); 
        if($user === false)
            die(header('Location: ../listings/listings_all.php'));
		draw_profile($user, true);
	}
    
    draw_footer()
?>