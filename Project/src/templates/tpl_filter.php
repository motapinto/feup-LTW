<?php function draw_filters() { ?>
    <aside class="filter">
        <div class="filter-elem">
            <label for="apartment"> Apartment </label>
            <input type="checkbox" value="apartment">
        </div>

        <div class="filter-elem">
            <label for="house"> House </label>
            <input type="checkbox" value="house">
        </div>

        <div class="filter-elem">
            <label for="price">Price Range</label>
            <select name="Price" value="price">
                <option value="price1">0-20 €</option>
                <option value="price2">20-40 €</option>
                <option value="price3">40-60 €</option>
                <option value="price4">60-80 €</option>
            </select>
        </div>

        <div class="filter-elem">
            <label for="checkin"> Check in </label>
            <input name="check-in" type="date" value="checkin">
        </div>

        <div class="filter-elem">
            <label for="checkout"> Check out </label>
            <input name="check-out" type="date" value="checkout">
        </div>
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
