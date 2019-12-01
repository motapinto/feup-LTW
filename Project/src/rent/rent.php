<?php
    include_once('../includes/session.php');              // starts session

    if(!isset($_SESSION['id']) || !isset($_GET['id']))
        header('Location: ../listings/listings_all.php');

    include_once('../includes/database.php');                   // connects to the database
    include_once('../database/listings.php');                   // listings functions

    include_once('../templates/tpl_common.php');                     // functions for the initial and final part of the HTML document
    include_once('../templates/tpl_navBar.php');                     // prints the menu in HTML

    $id = $_GET['id'];
    htmlentities($id, ENT_QUOTES, 'UTF-8');

    $property = getListingById($id);
    if($property === false){
        header('Location: ../listings/listings_all.php');
    }

    $adults = isset($_GET['adults'])?$_GET['adults']:0;
    $children = isset($_GET['children'])?$_GET['children']:0;
    $babies = isset($_GET['babies'])?$_GET['babies']:0;

    htmlentities($adults, ENT_QUOTES, 'UTF-8');
    htmlentities($children, ENT_QUOTES, 'UTF-8');
    htmlentities($babies, ENT_QUOTES, 'UTF-8');

    draw_header('Rent');
    draw_navBar(-1);
?>
    <section id='Rent'>
        <form action="../actions/rent.php" method='GET'>
            <section>
                <p>Check In Date</p>
                <input type="date" name="checkin" <?php if(isset($_GET['checkin'])) { ?> value="<?=htmlentities($_GET['checkin'], ENT_QUOTES, 'UTF-8');?>" <?php } ?>>
            </section>
            <section>
                <p>Check Out Date</p>
                <input type="date" name="checkout" <?php if(isset($_GET['checkout'])) { ?> value="<?=htmlentities($_GET['checkout'], ENT_QUOTES, 'UTF-8');?>" <?php } ?>>
            </section>
            <section>
                <input type="hidden" value="<?=$property['guests']?>">
                <p>Maximum number of guests: <?=$property['guests']?></p>   
                <button class="button-guests" onclick="guestsChange(ADULTS, ADD)">+</button>
                <input id="adults" type="disabled" name="adults" min='0' max="<?=$property['guests']?>" value="<?=$adults?>">
                <button class="button-guests" onclick="guestsChange(ADULTS, SUB)">-</button>
                <button class="button-guests" onclick="guestsChange(CHILDREN, ADD)">+</button>
                <input id="children" type="disabled" name="children" min='0' max="<?=$property['guests']?>" value="<?=$children?>">
                <button class="button-guests" onclick="guestsChange(CHILDREN, SUB)">-</button>
                <button class="button-guests" onclick="guestsChange(BABIES, ADD)">+</button>
                <input id="babies" type="disabled" name="babies" min='0' max="<?=$property['guests']?>" value="<?=$babies?>">
                <button class="button-guests" onclick="guestsChange(BABIES, SUB)">-</button>
                <span class='error' id='msg-guests'></span>
            </section>
            <button>Rent</button>
        </form>
    </section>
<?php

    draw_footer();
?>