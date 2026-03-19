import vars from "../_vars.js";
const { header } = vars;

import SmoothScroll from "smooth-scroll";

document.addEventListener("DOMContentLoaded", function () {

  const scroll = new SmoothScroll('a[href*="#"]', {
    speed: 600,
    updateURL: false,
    offset: (anchor, toggle) => {
      const h = header ? header.offsetHeight : 0;

      return h;
    }
  });

});