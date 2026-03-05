import { disableScroll } from "../disable-scroll.js";
import { enableScroll } from "../enable-scroll";

import {
    toggleClassInArray,
    toggleCustomClass,
    removeCustomClass,
    removeClassInArray,
    addCustomClass,
} from "../customFunctions";

class MobileMenu {
    constructor({ overlay, burger, mobileMenu, header, activeClass, activeClassMode, additionalBlocks = [], onToggle = null }) {
        this.overlay = overlay;
        this.burger = burger;
        this.mobileMenu = mobileMenu;
        this.header = header;
        this.activeClass = activeClass;
        this.activeClassMode = activeClassMode;
        this.additionalBlocks = additionalBlocks;
        this.onToggle = onToggle; // <- добавляем
        this.init();
    }


    toggleMenu(element, trigger) {
        toggleCustomClass(element, this.activeClass);
        toggleClassInArray(trigger, this.activeClass);
        toggleCustomClass(this.overlay, this.activeClass);

        if (element.classList.contains(this.activeClass)) {
            disableScroll();
            addCustomClass(this.header, "open-menu");
        } else {
            enableScroll();
            removeCustomClass(this.header, "open-menu");
        }

        if (typeof this.onToggle === 'function') {
            this.onToggle(element.classList.contains(this.activeClass));
        }
    }


    hideMenu(element, trigger) {
        enableScroll();
        removeCustomClass(element, this.activeClass);
        removeClassInArray(trigger, this.activeClass);
        removeCustomClass(this.overlay, this.activeClass);

        if (element.classList.contains(this.activeClass)) {
            disableScroll();
            addCustomClass(this.header, "open-menu");
        } else {
            enableScroll();
            removeCustomClass(this.header, "open-menu");
        }
    }

    init() {
        this.burger.forEach((btn) => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                this.toggleMenu(this.mobileMenu, this.burger);
            });
        });

        if (this.overlay) {
            this.overlay.addEventListener("click", (e) => {
                if (e.target.classList.contains("overlay")) {
                    this.hideMenu(this.mobileMenu, this.burger);
                }
            });
        }

        this.mobileMenu.querySelectorAll("a").forEach((item) => {
            item.addEventListener("click", () => {
                this.hideMenu(this.mobileMenu, this.burger);
            });
        });

        document.querySelectorAll("[data-modal]").forEach((item) => {
            item.addEventListener("click", () => {
                this.hideMenu(this.mobileMenu, this.burger);
                addCustomClass(this.overlay, 'active-mode')
            });
        });

        this.additionalBlocks.forEach(({ trigger, target }) => {
            if (trigger && target) {
                trigger.addEventListener("click", (e) => {
                    e.stopPropagation();
                    this.toggleMenu(target, trigger);
                });

                document.addEventListener("click", (e) => {
                    if (!target.contains(e.target) && !trigger.contains(e.target)) {
                        trigger.classList.remove(this.activeClass);
                        target.classList.remove(this.activeClass);
                    }
                });
            }
        });
    }
}

export default MobileMenu;
