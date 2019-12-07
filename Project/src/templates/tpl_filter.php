<?php function draw_filters($max) { ?>
    <aside class="filter">
        <form action="" method="post" class="filter-form">
        <h2> Custom Filter</h2>
            <ul>
                <li>	
                    <label>
                        <input name="apartment" type="checkbox" class="filled-in" checked onclick="submitFilter();"/>
                        <span>Apartment</span>
                    </label>
                </li>
                <li>	
                    <label>
                        <input type="checkbox" class="filled-in" checked onclick="submitFilter();"/>
                        <span>House</span>
                    </label>
                </li>
            </ul>
            <label> 
                <span>Price Range (per night)</span>
                <div id="price-slider"></div>
            </label>      

            <button class="circular-button" style="background-color: teal;">Update Results</button>
        </form>

  
    </aside>

    <script>
        let min;
        let max;

        //  Submit form to change filter settings
        function submitFilter() {
            let xhttp = new XMLHttpRequest();
            let asynchronous = true;
            let checkboxes = document.getElementsByClassName('filled-in');

            let request = encodeForAjax({ price_min: min, price_max: max, 
                apartment: checkboxes[0].checked, house: checkboxes[1].checked});

            alert(request);

            // Define what happens on successful data submission
            xhttp.addEventListener('load', function(event) {
                let response = JSON.parse(this.responseText);
            });

            // Define what happens in case of error
            xhttp.addEventListener('error', function(event) {
                alert('Oops! Something goes wrong.');
            });

            xhttp.open('POST', '../listings/listings_all.php?' + request, asynchronous);
            xhttp.send();
        }

        var slider = document.getElementById('price-slider');
        noUiSlider.create(slider, {
            start: [0, 100],
            connect: true,
            step: 1,
            orientation: 'horizontal', // 'horizontal' or 'vertical'
            range: {
                'min': 0,
                'max': 100
            },
            format: wNumb({
                decimals: 0
            })
        });

        slider.noUiSlider.on('update', function (values, handle) {
            min = values[0];
            max = values[1];
            submitFilter();
        });
    </script>


<?php } ?>
