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


    if(!isset($_GET['id']))
        header('Location: ../listings/listings_all.php');                                 // main webpage

    $images = getImagesByPropertyId($_GET['id']);



?>
    <section id='addProperty'>
        <h2>Add Property Images</h2>
        <h4>Stage 2/2</h4>
        <?php 
        foreach($images as $image){
            $id = $image['id'];
            if(file_exists("../../assets/images/thumbs_medium/p_$id.jpg")){ ?>
                <img src="../../assets/images/thumbs_medium/p_<?=$id?>.jpg" alt="">
            <?php }
            else if(file_exists("../../assets/images/thumbs_medium/p_$id.png")) { ?>
                <img src="../../assets/images/thumbs_medium/p_<?=$id?>.png" alt="">
            <?php }
        }?>
        <form action="../actions/action_property_image.php" method='POST' enctype="multipart/form-data">
            <input type="hidden" name="property_id" value="<?=$_GET['id']?>">
            <input type="file" name="image" required>
            <button>Add Image</button>
        </form>
    </section>
<?php


    draw_footer();
?>