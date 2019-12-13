<?php function addProperty($new=false) { 
    $now = date("Y-m-d");
    ?>
    <section id='addProperty'>
        <h2>Property Details</h2>
        <form action="../actions/action_propertyDetails.php" method='POST'>
        
            <section id="property-important">
                <article id="property-main">
                    <article>
                        <p>Title</p>
                        <input type="text" name="title" placeholder="Title" required>
                    </article>
                    <article>
                        <p>Description</p>
                        <textarea name="description" cols="50" rows="10" required placeholder="Briefe description of the property"></textarea>
                    </article>
                </article>

                <article id="property-images">
                    <img src="" alt="" width="400" height="400">
                </article>
            </section>

            <section id="property-info">
                <article id="property-details">
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
                    <button id="add-button" class="no-button">Add Property</button>
                </article>

                <article id="property-history">
                    <h1>Rent history </h1>
                    <ul class="scrollable-history">
                    <?php if($new) { 
                        $rents = getAllRentsByProperty(1);
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
                                            <input class="rent-id" type="hidden" value="<?=$rent['id']?>">
                                            <button class="cancel-button"> Cancel </button>
                                    <?php } ?>
                                </div>
                            </li>

                        <?php } ?>
                    <?php } ?>
                    </ul>
                </article>
            </section>
        </form>
    </section>
<?php } ?>