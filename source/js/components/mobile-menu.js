import MobileMenu from "../functions/scripts/burger";
import {elementHeight} from "../functions/customFunctions";
import vars from "../_vars";

document.addEventListener("DOMContentLoaded", function () {
    new MobileMenu({
        overlay: document.querySelector(".overlay"),
        burger: document.querySelectorAll(".burger"),
        mobileMenu: document.querySelector(".mobile"),
        header: document.querySelector(".header"),
        activeClass: "active",
        activeClassMode: "active-mode",
        additionalBlocks: [],
        onToggle: (isOpen) => {
            elementHeight(vars.header, 'header-height');
        }
    });
});



