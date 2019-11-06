<?php
    include_once('../database/connection.php');                // connects to the database
    include_once('../database/listings.php');                  // listings functions

    if (!isset($_GET['city']) || strlen($_GET['city']) < 0) // check if input is valid (check if any property exists with that city?)
        die("Invalid city!");

    $listings = getListingByCity($_GET['city']);            // gets all listings in city from the database

    include('../templates/common/header.php');                 // prints the initial part of the HTML document
    include('../templates/common/nav_bar.php');                // prints the menu in HTML
    include('../templates/listings/all_listings.php');         // prints the list of listings in HTML
    include('../templates/common/footer.php');                 // prints the final part of the HTML document
?>