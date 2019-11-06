<?php function drawAllListings($listings) { ?>
  <section id="listings">
    <?php foreach($listings as $listing) { ?>
        <article>
            <header>
                <h1>
                    <a href="some_listing.php?id=<?=$listing['id']?>">
                        <?=$listing['title']?>
                    </a>
                </h1>
            </header>
            
            <p> <?=$listing['description']?> </p>

            <footer>
                <div class="city">
                    city: <?=$listing['city']?>
                </div>

                <div class="street">
                    street: <?=$listing['street']?>
                </div>

                <div class="apartment_number">
                    apartment_number: <?=$listing['apartment_number']?>
                </div>

                <div class="door_number">
                    door_number: <?=$listing['door_number']?>
                </div>

                <div class="price_day">
                    price_day: <?=$listing['price_day']?>
                </div>

                <div class="available">
                    available: <?=$listing['available']?>
                </div>

                <div class="rating">
                    rating: <?=$listing['rating']?>
                </div>

                <div class="property_type">
                    property_type: <?=$listing['property_type']?>
                </div>
            </footer>
        </article>
    <?php } ?>
  </section>

<?php } ?>
