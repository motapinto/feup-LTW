<?php
    session_start();
    include_once('../database/connection.php');          // connects to the database
    include_once('../database/users.php');               // user functions
    
    include('../templates/common/header.php');           // prints the initial part of the HTML document
    include('../templates/common/nav_bar.php');          // prints the menu in HTML
    //include('../templates/profile/list_profile.php');   // prints the list of listings in HTML
    include('../templates/common/footer.php');           // prints the final part of the HTML document

    drawHead('User Profile');
    drawNavBar();
    //$user = userProfile($_SESSION['email']);                     // gets all listings from the database
    //drawProfile($user);
    drawFooter()
?>