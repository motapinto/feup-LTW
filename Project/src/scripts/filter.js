let min = parseInt(document.getElementById('price_min').value);
let max = parseInt(document.getElementById('price_max').value);
let max_page = parseInt(document.getElementById('current-page').max);
let slider = document.getElementById('price-slider');
noUiSlider.create(slider, {
    start: [min, max],
    connect: true,
    step: 1,
    orientation: 'horizontal', // 'horizontal' or 'vertical'
    range: {
        'min': parseInt(document.getElementById('price_min').min),
        'max': parseInt(document.getElementById('price_max').max)
    },
    format: wNumb({
        decimals: 0
    })
});

slider.noUiSlider.on('update', function (values, handle) {
    min = values[0];
    max = values[1];
    document.getElementById('price_min').value = values[0];
    document.getElementById('price_max').value = values[1];
});

document.getElementById('price_min').onkeyup = function (event) {
    min = parseInt(document.getElementById('price_min').value);
    document.getElementById('price_max').min = min;
}

document.getElementById('price_max').onkeyup = function (event) {
    max = parseInt(document.getElementById('price_max').value);
    document.getElementById('price_min').max = max;
}

let checkboxes = document.getElementsByClassName('type');

console.log(document.getElementById('prev-page'));
document.getElementById('prev-page').onclick = prev_page;
document.getElementById('next-page').onclick = next_page;

for (let i = 0; i < checkboxes.length; i++) {
    checkboxes[i].onclick = function (event) {
        checkboxes[i].children[0].checked = !checkboxes[i].children[0].checked;
    }
    
}

$(function () {
    $('input[name="daterange"]').daterangepicker({
    opens: 'left',
    locale: {
        format: 'DD/MM/YYYY'
    }
    });
});

function prev_page(event) { 
    if(document.getElementById('current-page').value > 1)
        document.getElementById('current-page').value -= 1;
}

function next_page(event) { 
    if(document.getElementById('current-page').value < max_page)
        document.getElementById('current-page').value ++;
}
