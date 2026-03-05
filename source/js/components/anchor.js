import vars from "../_vars.js";
const { header } = vars;

import SmoothScroll from "smooth-scroll";

document.addEventListener("DOMContentLoaded", function () {
  const headerHeight = header ? header.offsetHeight : 0;

  const scroll = new SmoothScroll('a[href*="#"]', {
    speed: 600,
    updateURL: false,
    offset: (anchor, toggle) => {
      if (window.matchMedia('(max-width: 1024px)').matches) {
        return headerHeight;
      }
      return 0;
    }
  });

});
