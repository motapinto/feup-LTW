<?php function draw_filters($max) { ?>
    <aside class="filter">
        <form action="" method="post">
            <div class="filter-elem">
                <label for="apartment"> Apartment </label>
                <input type="checkbox" value="apartment">
            </div>

            <div class="filter-elem">
                <label for="house"> House </label>
                <input type="checkbox" value="house">
            </div>

            <div class="filter-elem">
                <label>Minimum Price</label>
                <input type="range" name="price_min" id="price_min" min="0" value="0" max="<?=$max-1?>">
                <input type="number" value='0' id='price_min_display'>
            </div>

            <div class="filter-elem">
                <label>Maximum Price</label>
                <input type="range" name="price_max" id="price_max" min="1" value="<?=$max?>" max="<?=$max?>">
                <input type="number" value="<?=$max?>" id='price_max_display'>
            </div>

            <div class="filter-elem">
                <label for="checkin"> Check in </label>
                <input name="checkin" type="date" value="checkin">
            </div>

            <div class="filter-elem">
                <label for="checkout"> Check out </label>
                <input name="checkout" type="date" value="checkout">
            </div>

            <button>Filter</button>
        </form>
    </aside>
    
<style>
    .listings-filter {
        display: grid;
        grid-template-areas: 'filter properties';
        grid-template-columns: 1fr 5fr;
    }

    #listings{
        grid-area: 'properties';
    }

    .filter {
        grid-area: 'filter';
        background-color: #4D3DB6;
        display: flex;
        flex-direction: column;
    }

    .filter-elem {
        margin-bottom: 10px ;
        display: flex;
        flex-direction: row;
    }

    .filter-elem label{
        grid-area: 'label';
        padding-right: 10px;
    }

    .filter-elem input, .filter-elem select{
        grid-area: 'label';
        margin-right: 10px;
    }

</style>

<script>

function 





</script>

<?php } ?>
