class RangeSlider {
    constructor(rangeElement, valueElement = null, symbol = '', background = '#000') {
        this.rangeElement = rangeElement;

        console.log(this.rangeElement)

        this.valueElement = valueElement;
        this.symbol = symbol;
        this.background = background;
        this.thumbLabel = rangeElement.closest('.range').querySelector('.range__thumb-label');
        this.step = parseFloat(this.rangeElement.getAttribute('step')) || 1;

        this.rangeElement.addEventListener('input', this.updateSlider.bind(this));

        if (this.valueElement) {
            this.valueElement.addEventListener('input', this.updateValue.bind(this));
        }

        this.init();
    }

    init() {
        requestAnimationFrame(() => this.updateSlider());
    }


    formatNumber(value) {
        return this.symbol + ' ' + Number(value).toLocaleString('ru-RU').replace(/,/g, ' ');
    }

    parseNumber(value) {
        return parseFloat(
            value
                .replace(this.symbol, '')
                .replace(/\s/g, '')
                .replace(',', '.')
        );
    }

    generateBackground() {
        let percentage = (this.rangeElement.value - this.rangeElement.min) / (this.rangeElement.max - this.rangeElement.min) * 100;
        return `background: linear-gradient(to right, ${this.background} ${percentage}%, transparent ${percentage}%)`;
    }

    updateThumbLabel() {
        if (!this.thumbLabel) return;

        const value = parseFloat(this.rangeElement.value);
        this.thumbLabel.textContent = this.formatNumber(value);

        // Ждём, пока текст вставится и элемент реально отрендерится
        requestAnimationFrame(() => {
            const rangeWidth = this.rangeElement.offsetWidth;
            const thumbWidth = parseFloat(getComputedStyle(this.rangeElement).getPropertyValue('--thumb-size')) || 16;

            const rangeMin = parseFloat(this.rangeElement.min);
            const rangeMax = parseFloat(this.rangeElement.max);
            const percentage = (value - rangeMin) / (rangeMax - rangeMin);

            const left = percentage * (rangeWidth - thumbWidth) + thumbWidth / 2;
            const tooltipOffset = this.thumbLabel.offsetWidth / 2;

            this.thumbLabel.style.left = `${left - tooltipOffset}px`;
        });
    }


    updateSlider() {
        const value = this.rangeElement.value;

        if (this.valueElement) {
            this.valueElement.value = this.formatNumber(value);
        }

        this.rangeElement.setAttribute('value', value);
        this.rangeElement.style = this.generateBackground();

        this.updateThumbLabel();
    }

    updateValue() {
        let newValue = this.parseNumber(this.valueElement.value);

        if (isNaN(newValue) || newValue === '') {
            newValue = parseFloat(this.rangeElement.min);
        }

        // Применяем step
        const rangeMin = parseFloat(this.rangeElement.min);
        const rangeMax = parseFloat(this.rangeElement.max);
        newValue = Math.round((newValue - rangeMin) / this.step) * this.step + rangeMin;
        newValue = Math.max(rangeMin, Math.min(newValue, rangeMax));

        this.rangeElement.value = newValue;
        this.updateSlider();
    }
}

export default RangeSlider;
