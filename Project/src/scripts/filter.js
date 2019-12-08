let min = parseInt(document.getElementById('price_min').value);
let max = parseInt(document.getElementById('price_max').value);

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
