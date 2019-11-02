<?php
    include_once('database/connection.php');          // connects to the database
    include_once('database/listings.php');            // listings functions

    
    include('templates/common/header.php');           // prints the initial part of the HTML document
    include('templates/common/nav_bar.php');          // prints the menu in HTML
    include('templates/listings/all_listings.php');   // prints the list of listings in HTML
    include('templates/common/footer.php');           // prints the final part of the HTML document

    drawHead('All Listings');
    drawNavBar();
    $listings = getAllListings();                     // gets all listings from the database
    drawAllListings($listings);
    drawFooter()
?>