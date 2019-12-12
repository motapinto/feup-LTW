<?php function addProperty() { ?>
    <section id='addProperty'>
        <h2>Property Details</h2>
        <h4>Stage 1/2</h4>
        <form action="../actions/action_add_property.php" method='POST'>
            <section>
                <p>Title</p>
                <input type="text" name="title" placeholder="Title" required>
            </section>
            <section>
                <p>Description</p>
                <textarea name="description" cols="50" rows="10" required placeholder="Briefe description of the property"></textarea>
            </section>
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
            <button>Add Property</button>
        </form>
    </section>
<?php } ?>