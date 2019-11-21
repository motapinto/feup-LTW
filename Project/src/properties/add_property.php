<?php
    include_once('../includes/session.php');              // starts session
    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php');                                 // main webpage

    include_once('../includes/database.php');             // connects to the database
    include_once('../database/listings.php');             // listings functions

    include('../templates/tpl_common.php');               // functions for the initial and final part of the HTML document
    include('../templates/tpl_navBar.php');                  // prints the menu in HTML
    include('../templates/tpl_properties.php');    // prints the list of listings in HTML

    draw_header('My Properties');
    draw_navBar();

?>
    <section id='addProperty'>
        <h2>Add Property Details</h2>
        <h4>Stage 1/2</h4>
        <form action="../actions/action_add_property.php" method='POST'>
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="description" cols="50" rows="10" required placeholder="Description"></textarea>
            <input type="number" name="price_day" min="1" placeholder="Price per Day" required>
            <input type="number" name="guests" min="1" placeholder="Number of Guests" required>
            <input type="text" name="city" placeholder='City' required>
            <input type="text" name="street" placeholder='Street' required>
            <input type="number" name="door_number" min='1' placeholder='Door Number' required>
            <input type="text" name="apartment_number" placeholder='Apartment Number'>
            <select name="property_type" required>
                <option value="0">House</option>
                <option value="1">Apartment</option>
            </select>
            <button>Add Property</button>
        </form>
    </section>
<?php

    draw_footer();
?>