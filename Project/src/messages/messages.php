<?php
    include_once('../includes/session.php');              // starts session
    include_once('../includes/database.php');             // connects to the database
    include_once('../database/messages.php');             // messages functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');               // prints the menu in HTML
    include('../templates/tpl_listings.php');             // prints the list of listings in HTML

    draw_header('Messages');
    draw_navBar(4);
    $messengers = [0, 1];
    //$messages = getAllMessages($_SESSION['id']);          // gets all messages from the database
    draw_messages($messengers);
    draw_footer();
?>