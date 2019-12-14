<?php function addProperty($id=null) { 
    $now = date("Y-m-d");
    if($id != null) {
        $rents = getAllRentsByProperty($id);
        $property = getListingById($id);
    }
    ?>
    <section id='addProperty'>
        <h2>Property Details</h2>        
            <section id="property-important">
                <article id="property-main">
                    <article>
                        <p>Title</p>
                        <?php if($id != null) { ?>
                            <input value="<?=$property['title']?>" type="text" id="title" placeholder="Title">
                        <?php }  
                            else { ?>
                            <input type="text" id="title" placeholder="Title">
                        <?php } ?>
                    </article>
                    <article>
                        <p>Description</p>
                        <?php if($id != null) { ?>
                            <textarea name="description" id="description" cols="50" rows="10" placeholder="Briefe description of the property">
                                <?=$property['description']?>
                            </textarea>
                        <?php }  
                            else { ?>
                            <textarea id="description" cols="50" rows="10"  placeholder="Briefe description of the property"></textarea>
                        <?php } ?>
                    </article>
                </article>

                <?php 
                    $images = getImagePathsByPropertyId($id);
                    foreach($images as $image) { ?>
                    <article id="property-images">
                        <div id="change-pics">
                            <input id='add-pic-upload' type='file' hidden/>
                            <button id="add-pic" class="pics-btns"><i class="fas fa-minus"></i></button>
                            <button id="remove-pic" class="pics-btns"><i class="fas fa-plus"></i></button>
                        </div>
                        <div id="galleria">
                            <a href="<?=$image?>">
                                <img title="Image Tile - feature in progress"
                                alt="Image description - feature in progress"
                                src="<?=$image?>" />
                            </a>
                        </div>
                    </article>
                <?php } ?>
            </section>
            
            <section id="property-info">
                <article id="property-details">
                    <?php if($id != null) { ?>
                        <label> Price (&euro;/night)</label>
                        <input value="<?=$property['price_day']?>" type="text" id="price" >
                        <label> Guests </label>
                        <input value="<?=$property['guests']?>" type="number" id="guests" min="1" >
                        <label> City </label>
                        <input value="<?=$property['city']?>" type="text" id="city" min="1" >
                        <label> Street </label>
                        <input value="<?=$property['street']?>" type="text" id="street" >
                        <label> Door number </label>
                        <input value="<?=$property['door_number']?>" type="text" id="door_number" >
                        <label> Apartment number(if applicable) </label>
                        <input value="<?=$property['apartment_number']?>" type="number" id="apart_number" min='1' >
                        <label> Property type </label>
                        <select value="<?=$property['property_type']?>" id="property_type" >
                            <option value="0" <?=(isset($property['property_type'])&&$property['property_type']==0)?'selected':''?>>House</option>
                            <option value="1" <?=(isset($property['property_type'])&&$property['property_type']==1)?'selected':''?>>Apartment</option>
                        </select>
                    <?php }  
                        else { ?>
                        <label> Price (&euro;/night)</label>
                        <input type="number" id="price_day" placeholder="Price per Day" >
                        <label> Guests </label>
                        <input type="number" id="guests" placeholder="Number of Guests" >
                        <label> City </label>
                        <input type="text" id="city" placeholder='City' >
                        <label> Street </label>
                        <input type="text" id="street" placeholder='Street' >
                        <label> Door number </label> 
                        <input type="number" id="door_number" placeholder='Door Number' >
                        <label> Apartment number(if applicable) </label>    
                        <input type="text" id="apartment_number" placeholder='Apartment Number'>
                        <label> Property type </label>
                        <select id="property_type" >
                            <option value="0">House</option>
                            <option value="1">Apartment</option>
                        </select>
                    <?php } ?>

                    <button id="add-button" class="no-button">Update Property</button>
                </article>

                <article id="property-history">
                    <h1>Rent history </h1>
                    <ul class="scrollable-history">
                    <?php if($id != null && !empty($rents) ) { 
                        foreach($rents as $rent) { 
                            $user = userProfile($rent['user_id']);
                            $image = getUserImagePath($rent['user_id'], 'SMALL');
                            preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $rent['initial_date'], $date_init_array);
                            preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $rent['final_date'], $date_final);
                            $date_init = $date_init_array[3].'-'.$date_init_array[2].'-'.$date_init_array[1];
                            $date_final = $date_final[3].'-'.$date_final[2].'-'.$date_final[1]; 
                            ?>

                            <li class='history-item'>
                                <div class="rent-user">
                                    <a href="../profile/profile.php?id=<?= $rent['user_id'] ?>">
                                    <img src="<?= $image ?>" alt="property photo">
                                    </a>
                                    <span> <?= $user['name'] ?></span>
                                </div>
                                <div class="history-details">
                                    <span class="history-date"> 
                                        <?= $date_init ?>
                                        <i class="fas fa-arrow-right"></i>
                                        <?= $date_final ?>
                                    </span>
                                    <span class="overview-price"> Total: <?= $rent['price'] ?>&euro; </span>
                                    <span class="overview-guests"> Guests: <?=$rent['adults'] + $rent['children'] + $rent['babies'] ?> </span>
                                    <?php if(strcmp($date_init_array[1].'-'.$date_init_array[2].'-'.$date_init_array[3], $now) > 0) { ?>
                                            <input id="rent_id" type="hidden" value="<?=$rent['id']?>">
                                            <button class="cancel-button"> Cancel </button>
                                    <?php } ?>
                                </div>
                            </li>

                        <?php } ?>
                    <?php } 
                    else if(empty($rents)) {  ?>
                        <span> No rent history</span>
                    <?php } ?>
                    </ul>
                </article>
            </section>
    </section>
<?php } ?>