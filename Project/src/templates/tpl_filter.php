<?php
include_once('../database/listings.php');

function draw_filters($filter) { 
    $max = getMaxPrice()['price_day'];
    $min = getMinPrice()['price_day'];?>
    <aside class="filter">
        <form action="" method="get" class="filter-form">
        <h2> Custom Filter</h2>
            <ul>
                <li>	
                    <label>
                        <input name="apartment" type="checkbox" class="filled-in" <?php if($filter === false || isset($_GET['apartment'])) { ?> checked <?php } ?>/>
                        <span>Apartment</span>
                    </label>
                </li>
                <li>	
                    <label>
                        <input name="house" type="checkbox" class="filled-in" <?php if($filter === false || isset($_GET['house'])) { ?> checked <?php } ?>/>
                        <span>House</span>
                    </label>
                </li>
            </ul>
            <label> 
                <span>Price Range (per night)</span>
                <div id="price-slider"></div>
                <input type="hidden" name="price_min" id='price_min' value="<?=isset($_GET['price_min'])?$_GET['price_min']:0?>" max="<?=$max - 1?>" min="<?=$min?>">
                <input type="hidden" name="price_max" id='price_max' value="<?=isset($_GET['price_max'])?$_GET['price_max']:$max?>" max="<?=$max?>" min="<?=$min + 1?>">
            </label>

            <button class="circular-button" style="background-color: teal;">Update Results</button>
        </form>

  
    </aside>

<?php } ?>
