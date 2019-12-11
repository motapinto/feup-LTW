<?php
include_once('../database/listings.php');

function draw_filter($filter, $max_page=null, $owner=false) { 
    $max = getMaxPrice()['price_day'];
    $min = getMinPrice()['price_day'];
    $cities = getCities();
    ?>
    <aside class="filter">
        <form action="" method="get" class="filter-form">
            <h2> Custom Filter</h2>
            <section> 
                <ul>
                    <li class="type">	
                        <input name="apartment" type="checkbox" class="filled-in" <?php if($filter === false || isset($_GET['apartment'])) { ?> checked <?php } ?>/>
                        <span>Apartment</span>
                    </li>
                    <li class="type">	
                        <input name="house" type="checkbox" class="filled-in" <?php if($filter === false || isset($_GET['house'])) { ?> checked <?php } ?>/>
                        <span>House</span>
                    </li>
                </ul>
            </section>
            <section> 
                <span>Price Range (&euro; / night)</span>
                <div id="price-slider"></div>
                <input type="hidden" name="price_min" id='price_min' value="<?=isset($_GET['price_min'])?$_GET['price_min']:0?>" max="<?=$max - 1?>" min="<?=$min?>">
                <input type="hidden" name="price_max" id='price_max' value="<?=isset($_GET['price_max'])?$_GET['price_max']:$max?>" max="<?=$max?>" min="<?=$min + 1?>">
            </section>

            <section>
                <span>City: </span>
                <select visible="6" name="city" id="select-city">
                    <option id="city-option" selected value="%">Any</option>
                    <?php foreach ($cities as $city) { ?>
                        <option id="city-option" value="<?=$city['city']?>" <?=(isset($_GET['city'])&&$_GET['city']===$city['city'])?'selected':''?>> 
                            <?=$city['city']?> 
                        </option>
                    <?php } ?>
                </select>
            </section>
            <?php if($owner) { ?>
            <section> 
                <span>Dates:</span>
                <input id="calendar" type="text" name="daterange" value="<?=isset($_GET['daterange'])?$_GET['daterange']:''?>"/>
            </section>
            <?php } ?>

            <section> 
                <span> Order by: </span>
                <select visible="6" name="order-by" class="order-S">
                    <option class="order-by" value="1" <?=(isset($_GET['order-by'])&&$_GET['order-by']==1)?'selected':''?>>Highest Rating</option>
                    <option class="order-by" value="2" <?=(isset($_GET['order-by'])&&$_GET['order-by']==2)?'selected':''?>>Lowest Rating</option>
                    <option class="order-by" value="3" <?=(isset($_GET['order-by'])&&$_GET['order-by']==3)?'selected':''?>>Highest Price</option>
                    <option class="order-by" value="4" <?=(isset($_GET['order-by'])&&$_GET['order-by']==4)?'selected':''?>>Lowest Price</option>
                    <option class="order-by" value="5" <?=(isset($_GET['order-by'])&&$_GET['order-by']==5)?'selected':''?>>Newest First</option>
                    <option class="order-by" value="6" <?=(isset($_GET['order-by'])&&$_GET['order-by']==6)?'selected':''?>>Oldest First</option>
                </select>
            </section>
            <?php if($owner) { ?>
            <section>
                    <span>Change page</span>
                    <div class="pagination">
                        <button id="prev-page" type="button" class="no-button"><i class="fas fa-minus"></i></button>
                        <input name="page" type="number" min="1" value="<?=isset($_GET['page'])?$_GET['page']:1?>" max="<?=$max_page?>">
                        <button id="next-page" type="button" class="no-button"><i class="fas fa-plus"></i></button>
                    </div>  
            </section>
            <?php } ?>

            <button id="submit-btn" class="circular-button">Update Results</button>
        </form>

  
    </aside>

<?php } ?>