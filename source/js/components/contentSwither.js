import { Switcher } from "@soinproduction/kit";

document.addEventListener("DOMContentLoaded", () => {
    new Switcher(".langs", {
        mode: "accordion",
        activeClass: "active",
        attrNav: "data-id",
        attrContent: "data-content",
        single: true,
        autoInitNested: true,
        showInfo: false,
    });  

    new Switcher(".header__socials", {
        mode: "accordion",
        activeClass: "active",
        attrNav: "data-id",
        attrContent: "data-content",
        single: true,
        autoInitNested: true,
        showInfo: false,
    });  
});