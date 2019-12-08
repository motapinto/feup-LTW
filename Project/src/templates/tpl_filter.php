<?php
include_once('../database/listings.php');

function draw_filter($filter) { 
    $max = getMaxPrice()['price_day'];
    $min = getMinPrice()['price_day'];
    $cities = getCities();
    ?>
    <aside class="filter">
        <form action="" method="get" class="filter-form">
        <h2> Custom Filter</h2>
            <section> 
                <ul>
                    <li>	
                        <input name="apartment" type="checkbox" class="filled-in" <?php if($filter === false || isset($_GET['apartment'])) { ?> checked <?php } ?>/>
                        <span>Apartment</span>
                    </li>
                    <li>	
                        <input name="house" type="checkbox" class="filled-in" <?php if($filter === false || isset($_GET['house'])) { ?> checked <?php } ?>/>
                        <span>House</span>
                    </li>
                </ul>
            </section>
            <section> 
                <span>Price Range (per night)</span>
                <div id="price-slider"></div>
                <input type="hidden" name="price_min" id='price_min' value="<?=isset($_GET['price_min'])?$_GET['price_min']:0?>" max="<?=$max - 1?>" min="<?=$min?>">
                <input type="hidden" name="price_max" id='price_max' value="<?=isset($_GET['price_max'])?$_GET['price_max']:$max?>" max="<?=$max?>" min="<?=$min + 1?>">
            </section>

            <section>
                <span>City</span>
                <select visible="6" name="city" id="select-city">
                    <option id="city-option" selected value="%">Any</option>
                    <?php foreach ($cities as $city) { ?>
                        <option id="city-option" value="<?=$city?>"><?=$city?></option>
                    <?php } ?>
                </select>
            </section>
            <section> 
                <span>Dates</span>
                <input id="calendar" type="text" name="daterange" value="" />
            </section>

            <button class="circular-button" style="background-color: teal;">Update Results</button>
        </form>

  
    </aside>

<?php } ?>