<?php
    include_once('../includes/session.php');              // starts session

    // if(!isset($_SESSION['id']) || !isset($_GET['id']))
    //     header('Location: ../listings/listings_all.php');

    include_once('../includes/database.php');                   // connects to the database
    include_once('../database/listings.php');                   // listings functions

    include_once('../templates/tpl_common.php');                     // functions for the initial and final part of the HTML document
    include_once('../templates/tpl_navBar.php');                     // prints the menu in HTML

    $id = $_GET['id'];
    $property = getListingById($id);
    if($property === false){
        header('Location: ../listings/listings_all.php');
    }

    $adults = isset($_GET['adults'])?$_GET['adults']:0;
    $children = isset($_GET['children'])?$_GET['children']:0;
    $babies = isset($_GET['babies'])?$_GET['babies']:0;

    draw_header('Rent');
    draw_navBar(-1);
?>
    <section id='Rent'>
        <form action="">
            <input type="date" name="checkin" <?php if(isset($_GET['checkin'])) { ?> value="<?=$_GET['checkin']?>" <?php } ?>>
            <input type="date" name="checkout" <?php if(isset($_GET['checkout'])) { ?> value="<?=$_GET['checkout']?>" <?php } ?>>
            <p>Maximum number of guests: <?=$property['guests']?></p>
            <input type="number" name="adults" min='0' max="<?=$property['guests']?>" value="<?=$adults?>">
            <input type="number" name="children" min='0' max="<?=$property['guests']?>" value="<?=$children?>">
            <input type="number" name="babies" min='0' max="<?=$property['guests']?>" value="<?=$babies?>">
            <button>Rent</button>
        </form>
    </section>
<?php

    draw_footer();
?>