// import Tabs from '../functions/scripts/tabs';

// --------------- tabs custom function --------------- //

import Tabs from "../functions/scripts/tabs";

document.addEventListener("DOMContentLoaded", function () {
  new Tabs("[data-tabs-parent]", "data-tab", "data-tab-content");
  new Tabs("[data-town-tabs]", "data-town-tab", "data-town-content");
});
