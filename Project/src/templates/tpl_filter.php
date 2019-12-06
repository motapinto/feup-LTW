<?php function draw_filters($max) { ?>
    <aside class="filter">
        <form action="" method="post" class="filter-form">
        <h2> Custom Filter</h2>
            <ul>
                <li>	
                    <label>
                        <input type="checkbox" class="filled-in" checked />
                        <span>Apartment</span>
                    </label>
                </li>
                <li>	
                    <label>
                        <input type="checkbox" class="filled-in" checked />
                        <span>House</span>
                    </label>
                </li>
            </ul>
            <label> 
                <span>Price Range (per night)</span>
                <div id="price-slider"></div>
            </label>

            <button>Filter</button>
        </form>
    </aside>

    <script>
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
    
    </script>


<?php } ?>
