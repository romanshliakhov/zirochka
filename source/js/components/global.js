import RangeSlider from "../functions/scripts/range";

document.addEventListener('DOMContentLoaded', function() {
    const range = document.querySelector(".range");
   
    if (range) {
        const rangeEl = range.querySelector('.range input[type="range"]');
        const valueEl = range.querySelector(".range__value input");
        const symbol = range.dataset.symbol || "$";
        const background = "var(--range-bg)";

        new RangeSlider(rangeEl, valueEl, symbol, background);
    }
})


