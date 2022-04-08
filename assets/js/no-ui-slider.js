import nouislider from 'nouislider';
import 'nouislider/dist/nouislider.css';

var price_slider = document.getElementById('price-slider');
var price_monthly_slider = document.getElementById('price-monthly-slider');
var min_price = document.getElementById('min-price');
var max_price = document.getElementById('max-price');
var min_price_monthly = document.getElementById('min-price-monthly');
var max_price_monthly = document.getElementById('max-price-monthly');

nouislider.create(price_slider, {
    start: [min_price.value, max_price.value],
    tooltips: [true, true],
    format: {
        to: (value) => `${value.toFixed(0)} €`,
        from: (value) => Number(value.replace(' €', '')),
    },
    step: 1,
    connect: true,
    range: {
        'min': Number(min_price.value),
        'max': Number(max_price.value)
    }
});

nouislider.create(price_monthly_slider, {
    start: [min_price_monthly.value, max_price_monthly.value],
    tooltips: [true, true],
    format: {
        to: (value) => `${value.toFixed(0)} €`,
        from: (value) => Number(value.replace(' €', '')),
    },
    step: 1,
    connect: true,
    range: {
        'min': Number(min_price_monthly.value),
        'max': Number(max_price_monthly.value)
    }
});

let total_price = document.querySelector('.filter-budget-choice-total');

let mounth_price = document.querySelector('.filter-budget-choice-mensuel');

total_price.addEventListener('click', () => {
    price_slider.classList.remove('hidden');
    price_monthly_slider.classList.add('hidden');
})

mounth_price.addEventListener('click', () => {
    price_monthly_slider.classList.remove('hidden');
    price_slider.classList.add('hidden');
})
