import vars from '../_vars.js';
import {elementHeight, removeCustomClass, addCustomClass} from '../functions/customFunctions.js';

const {header} = vars;

let lastScroll = 0;
const defaultOffset = 40;
const scrollUpDelay = 600;

function stickyHeaderFunction(breakpoint) {
    let containerWidth = document.documentElement.clientWidth;

    if (header.classList.contains('static')) return;

    if (containerWidth > breakpoint) {
        const scrollPosition = () => window.pageYOffset || document.documentElement.scrollTop;
        const containHide = () => header.classList.contains('sticky');

        window.addEventListener('scroll', () => {
            const currentScroll = scrollPosition();

            // 👉 вниз
            if (currentScroll > lastScroll  && currentScroll > defaultOffset) {
                addCustomClass(header, "sticky");
                header.classList.add("header-hidden");
            }

            // 👉 вверх
            if (currentScroll < lastScroll) {
                header.classList.remove("header-hidden");
            }

            // 👉 вверху страницы
            if (currentScroll < defaultOffset) {
                header.classList.remove("sticky", "header-hidden");
            }

            lastScroll = currentScroll;
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    if (!header.classList.contains('static')) {
        stickyHeaderFunction(320);
    }

    elementHeight(vars.header, 'header-height');
});
