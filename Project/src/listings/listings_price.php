<?php
    include_once('database/connection.php');            // connects to the database
    include_once('database/listings.php');              // listings functions

    if (!isset($_GET['price']) || price < 0)            // check if input is valid (check if any property exists with that price?)
        die("Invalid price!");

    $listings = getListingsBelowPrice($_GET['price'])); // gets all listings below price from the database

    include('templates/common/header.php');             // prints the initial part of the HTML document
    include('templates/common/nav_bar.php');            // prints the menu in HTML
    include('templates/listings/all_listings.php');     // prints the list of listings in HTML
    include('templates/common/footer.php');             // prints the final part of the HTML document
?>