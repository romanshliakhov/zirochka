import tippy from 'tippy.js';

function initTooltips(scope = document) {
    const isTouch = window.matchMedia('(hover: none)').matches;
    const elements = scope.querySelectorAll('.tooltip');

    elements.forEach(el => {
        if (el._tippy) return;

        tippy(el, {
            allowHTML: true,
            maxWidth: 270,
            interactive: true,
            placement: 'bottom',
            animation: 'scale',

            trigger: isTouch ? 'click' : 'mouseenter focus',
            hideOnClick: true,
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initTooltips();
});