/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./source/js/_components.js":
/*!**********************************!*\
  !*** ./source/js/_components.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_mobile_menu__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/mobile-menu */ "./source/js/components/mobile-menu.js");
/* harmony import */ var _components_modals__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/modals */ "./source/js/components/modals.js");
/* harmony import */ var _components_sliders__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/sliders */ "./source/js/components/sliders.js");
/* harmony import */ var _components_dinamicHeight__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/dinamicHeight */ "./source/js/components/dinamicHeight.js");
/* harmony import */ var _components_form_validate__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/form-validate */ "./source/js/components/form-validate.js");
/* harmony import */ var _components_anchor__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/anchor */ "./source/js/components/anchor.js");
/* harmony import */ var _components_tooltip__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/tooltip */ "./source/js/components/tooltip.js");
 //use

 //use
 //use
// import './components/fancybox';

// import './components/contentSwither';
//
// import './components/newsAjax';
// import './components/acc';
 //use
 //use
// import './components/articlesAjax';

// import './components/customFilters';
// import './components/provinceSelect';
// import './components/tabs';

/***/ }),

/***/ "./source/js/_vars.js":
/*!****************************!*\
  !*** ./source/js/_vars.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  windowEl: window,
  documentEl: document,
  htmlEl: document.documentElement,
  bodyEl: document.body,
  activeClass: 'active',
  activeClassMode: 'mode',
  header: document.querySelector('header'),
  footer: document.querySelector('footer'),
  overlay: document.querySelector('[data-overlay]'),
  modals: [...document.querySelectorAll('[data-popup]')],
  modalsMode: [...document.querySelectorAll('[data-mode-modal]')],
  modalsButton: [...document.querySelectorAll("[data-btn-modal]")]
});

/***/ }),

/***/ "./source/js/components/anchor.js":
/*!****************************************!*\
  !*** ./source/js/components/anchor.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _vars_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../_vars.js */ "./source/js/_vars.js");
/* harmony import */ var smooth_scroll__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! smooth-scroll */ "./node_modules/smooth-scroll/dist/smooth-scroll.polyfills.min.js");
/* harmony import */ var smooth_scroll__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(smooth_scroll__WEBPACK_IMPORTED_MODULE_1__);

const {
  header
} = _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"];

document.addEventListener("DOMContentLoaded", function () {
  const scroll = new (smooth_scroll__WEBPACK_IMPORTED_MODULE_1___default())('a[href*="#"]', {
    speed: 600,
    updateURL: false,
    offset: (anchor, toggle) => {
      const h = header ? header.offsetHeight : 0;
      return h;
    }
  });
});

/***/ }),

/***/ "./source/js/components/dinamicHeight.js":
/*!***********************************************!*\
  !*** ./source/js/components/dinamicHeight.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _vars_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../_vars.js */ "./source/js/_vars.js");
/* harmony import */ var _functions_customFunctions_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../functions/customFunctions.js */ "./source/js/functions/customFunctions.js");


const {
  header
} = _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"];
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
      if (currentScroll > lastScroll && !containHide() && currentScroll > defaultOffset) {
        (0,_functions_customFunctions_js__WEBPACK_IMPORTED_MODULE_1__.addCustomClass)(header, "sticky");
        header.classList.add("scroll-up");
        setTimeout(() => {
          header.classList.remove("scroll-up");
          header.classList.add("return-to-place");
        }, scrollUpDelay);
      }
      if (currentScroll < defaultOffset) {
        header.classList.remove("sticky", "scroll-up", "return-to-place");
      }
      lastScroll = currentScroll;
    });
  }
}
document.addEventListener("DOMContentLoaded", function () {
  if (!header.classList.contains('static')) {
    stickyHeaderFunction(320);
  }
  (0,_functions_customFunctions_js__WEBPACK_IMPORTED_MODULE_1__.elementHeight)(_vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].header, 'header-height');
});

/***/ }),

/***/ "./source/js/components/form-validate.js":
/*!***********************************************!*\
  !*** ./source/js/components/form-validate.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _functions_customFunctions__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../functions/customFunctions */ "./source/js/functions/customFunctions.js");
/* harmony import */ var _modals__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modals */ "./source/js/components/modals.js");
/* harmony import */ var _functions_scripts_loaderInstanse__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../functions/scripts/loaderInstanse */ "./source/js/functions/scripts/loaderInstanse.js");



document.addEventListener('DOMContentLoaded', function () {
  const thanksModalID = ajax_params.modalSuccessId;
  const errorModalID = ajax_params.modalErrorId;
  const mask = (selector, pattern) => {
    let setCursorPosition = (pos, elem) => {
      elem.focus();
      if (elem.setSelectionRange) {
        elem.setSelectionRange(pos, pos);
      } else if (elem.createTextRange) {
        let range = elem.createTextRange();
        range.collapse(true);
        range.moveEnd('character', pos);
        range.moveStart('character', pos);
        range.select();
      }
    };
    function createMask(event) {
      let matrix = pattern,
        i = 0,
        def = matrix.replace(/\D/g, ''),
        val = this.value.replace(/\D/g, '');
      if (def.length >= val.length) {
        val = def;
      }
      this.value = matrix.replace(/./g, function (a) {
        return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a;
      });
      if (event.type === 'blur') {
        if (this.value.length == 2) {
          this.value = '';
        }
      } else {
        setCursorPosition(this.value.length, this);
      }
    }
    let inputs = document.querySelectorAll(selector);
    inputs.forEach(input => {
      input.addEventListener('input', createMask);
      input.addEventListener('focus', createMask);
      input.addEventListener('blur', createMask);
      input.setAttribute('placeholder', pattern);
    });
  };
  mask('input[type="tel"]', '+38 (___) ___ ____');
  const formWrappers = document.querySelectorAll('.wpcf7');
  for (const formWrapper of formWrappers) {
    const formSubmitBtn = formWrapper.querySelector('button[type="submit"]');
    formWrapper.setAttribute('data-loader', false);
    if (formWrapper) {
      if (formSubmitBtn) {
        formSubmitBtn.addEventListener('click', function () {
          (0,_functions_customFunctions__WEBPACK_IMPORTED_MODULE_0__.removeCustomClass)(formWrapper, 'loaded');
          (0,_functions_customFunctions__WEBPACK_IMPORTED_MODULE_0__.addCustomClass)(formWrapper, 'loader');
        });
      }
      formWrapper.addEventListener('wpcf7invalid', function (event) {
        setTimeout(function () {
          (0,_functions_customFunctions__WEBPACK_IMPORTED_MODULE_0__.addCustomClass)(formWrapper, 'loaded');
        }, 500);
      }, false);
      formWrapper.addEventListener('wpcf7mailfailed', function (event) {
        _modals__WEBPACK_IMPORTED_MODULE_1__.modalManagerObject.closeModal();
        setTimeout(function () {
          _modals__WEBPACK_IMPORTED_MODULE_1__.modalManagerObject.openModal(`modal_${errorModalID}`);
        }, 400);
      }, false);
      formWrapper.addEventListener('wpcf7mailsent', function (event) {
        _modals__WEBPACK_IMPORTED_MODULE_1__.modalManagerObject.closeModal();
        setTimeout(function () {
          _modals__WEBPACK_IMPORTED_MODULE_1__.modalManagerObject.openModal(`modal_${thanksModalID}`);
        }, 400);
      }, false);
    }
  }
});

/***/ }),

/***/ "./source/js/components/mobile-menu.js":
/*!*********************************************!*\
  !*** ./source/js/components/mobile-menu.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _functions_scripts_burger__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../functions/scripts/burger */ "./source/js/functions/scripts/burger.js");
/* harmony import */ var _functions_customFunctions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../functions/customFunctions */ "./source/js/functions/customFunctions.js");
/* harmony import */ var _vars__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../_vars */ "./source/js/_vars.js");



document.addEventListener("DOMContentLoaded", function () {
  new _functions_scripts_burger__WEBPACK_IMPORTED_MODULE_0__["default"]({
    overlay: document.querySelector(".overlay"),
    burger: document.querySelectorAll(".burger"),
    mobileMenu: document.querySelector(".mobile"),
    header: document.querySelector(".header"),
    activeClass: "active",
    activeClassMode: "active-mode",
    additionalBlocks: [],
    onToggle: isOpen => {
      (0,_functions_customFunctions__WEBPACK_IMPORTED_MODULE_1__.elementHeight)(_vars__WEBPACK_IMPORTED_MODULE_2__["default"].header, 'header-height');
    }
  });
  const modes = document.querySelectorAll('.blog-list__item.mode');
  if (modes.length) {
    for (let i = 0; i < modes.length; i += 3) {
      const second = modes[i + 1];
      if (second) {
        second.classList.add('highlight');
      }
    }
  }
});

/***/ }),

/***/ "./source/js/components/modals.js":
/*!****************************************!*\
  !*** ./source/js/components/modals.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   modalManagerObject: () => (/* binding */ modalManagerObject)
/* harmony export */ });
/* harmony import */ var _functions_scripts_modals__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../functions/scripts/modals */ "./source/js/functions/scripts/modals.js");

const modalManagerObject = new _functions_scripts_modals__WEBPACK_IMPORTED_MODULE_0__["default"]({
  activeMode: 'active-mode',
  fadeInTimeout: 250,
  fadeOutTimeout: 300
});

/***/ }),

/***/ "./source/js/components/sliders.js":
/*!*****************************************!*\
  !*** ./source/js/components/sliders.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");


document.addEventListener("DOMContentLoaded", function () {
  const booksSlider = document.querySelector('.books-section__slider');
  if (booksSlider) {
    const swiperContainer = booksSlider.querySelector('.swiper-container');
    const nextBtn = booksSlider.querySelector('.slider-btn.next');
    const prevBtn = booksSlider.querySelector('.slider-btn.prev');
    if (swiperContainer) {
      new swiper__WEBPACK_IMPORTED_MODULE_0__["default"](swiperContainer, {
        modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Navigation],
        slidesPerView: 5,
        spaceBetween: 40,
        speed: 1000,
        watchOverflow: true,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn
        },
        breakpoints: {
          320: {
            slidesPerView: 2,
            spaceBetween: 16
          },
          600: {
            slidesPerView: 3,
            spaceBetween: 24
          },
          750: {
            slidesPerView: 3,
            spaceBetween: 40
          },
          991: {
            slidesPerView: 5,
            spaceBetween: 40
          },
          1444: {
            slidesPerView: 5,
            spaceBetween: 40
          }
        }
      });
    }
  }
  const newsSlider = document.querySelector('.publications-section__slider');
  if (newsSlider) {
    const swiperContainer = newsSlider.querySelector('.swiper-container');
    const nextBtn = newsSlider.querySelector('.slider-btn.next');
    const prevBtn = newsSlider.querySelector('.slider-btn.prev');
    if (swiperContainer) {
      new swiper__WEBPACK_IMPORTED_MODULE_0__["default"](swiperContainer, {
        modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Navigation],
        slidesPerView: 4,
        spaceBetween: 40,
        speed: 1000,
        watchOverflow: true,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn
        },
        breakpoints: {
          320: {
            slidesPerView: 2,
            spaceBetween: 16
          },
          650: {
            slidesPerView: 3,
            spaceBetween: 24
          },
          750: {
            slidesPerView: 3,
            spaceBetween: 40
          },
          1150: {
            slidesPerView: 4,
            spaceBetween: 40
          }
        }
      });
    }
  }
});

/***/ }),

/***/ "./source/js/components/tooltip.js":
/*!*****************************************!*\
  !*** ./source/js/components/tooltip.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var tippy_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tippy.js */ "./node_modules/tippy.js/dist/tippy.esm.js");

function initTooltips(scope = document) {
  const isTouch = window.matchMedia('(hover: none)').matches;
  const elements = scope.querySelectorAll('.tooltip');
  elements.forEach(el => {
    if (el._tippy) return;
    (0,tippy_js__WEBPACK_IMPORTED_MODULE_0__["default"])(el, {
      allowHTML: true,
      maxWidth: 270,
      interactive: true,
      placement: 'bottom',
      animation: 'scale',
      trigger: isTouch ? 'click' : 'mouseenter focus',
      hideOnClick: true
    });
  });
}
document.addEventListener('DOMContentLoaded', () => {
  initTooltips();
});

/***/ }),

/***/ "./source/js/functions/customFunctions.js":
/*!************************************************!*\
  !*** ./source/js/functions/customFunctions.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   addClassInArray: () => (/* binding */ addClassInArray),
/* harmony export */   addCustomClass: () => (/* binding */ addCustomClass),
/* harmony export */   addMultiListener: () => (/* binding */ addMultiListener),
/* harmony export */   animateInit: () => (/* binding */ animateInit),
/* harmony export */   elementHeight: () => (/* binding */ elementHeight),
/* harmony export */   elementWidth: () => (/* binding */ elementWidth),
/* harmony export */   even: () => (/* binding */ even),
/* harmony export */   fadeIn: () => (/* binding */ fadeIn),
/* harmony export */   fadeOut: () => (/* binding */ fadeOut),
/* harmony export */   initParallaxEffect: () => (/* binding */ initParallaxEffect),
/* harmony export */   removeClassInArray: () => (/* binding */ removeClassInArray),
/* harmony export */   removeCustomClass: () => (/* binding */ removeCustomClass),
/* harmony export */   scrollToElement: () => (/* binding */ scrollToElement),
/* harmony export */   scrollToSection: () => (/* binding */ scrollToSection),
/* harmony export */   stickyHeader: () => (/* binding */ stickyHeader),
/* harmony export */   toggleClassInArray: () => (/* binding */ toggleClassInArray),
/* harmony export */   toggleCustomClass: () => (/* binding */ toggleCustomClass)
/* harmony export */ });
const fadeIn = (el, timeout, display) => {
  el.style.opacity = 0;
  el.style.display = display || 'flex';
  el.style.transition = `all ${timeout}ms`;
  setTimeout(() => {
    el.style.opacity = 1;
  }, 10);
};
// ----------------------------------------------------
const fadeOut = (el, timeout) => {
  el.style.opacity = 1;
  el.style.transition = `all ${timeout}ms ease`;
  el.style.opacity = 0;
  setTimeout(() => {
    el.style.display = 'none';
  }, timeout);
};

// ----------------------------------------------------
function addMultiListener(element, eventNames, listener) {
  var events = eventNames.split(' ');
  for (var i = 0, iLen = events.length; i < iLen; i++) {
    element.addEventListener(events[i], listener, false);
  }
}

// ----------------------------------------------------
const even = n => !(n % 2);
// ----------------------------------------------------
const removeCustomClass = (item, customClass = 'active') => {
  const classes = customClass.split(',').map(cls => cls.trim());
  classes.forEach(className => {
    item.classList.remove(className);
  });
};

// ----------------------------------------------------
const toggleCustomClass = (item, customClasses = 'active') => {
  const classes = customClasses.split(',').map(cls => cls.trim());
  classes.forEach(className => {
    item.classList.toggle(className);
  });
};

// ----------------------------------------------------
const addCustomClass = (item, customClass = 'active') => {
  const classes = customClass.split(',').map(cls => cls.trim());
  classes.forEach(className => {
    item.classList.add(className);
  });
};

// ----------------------------------------------------
const removeClassInArray = (arr, customClass = 'active') => {
  const classes = customClass.split(',').map(cls => cls.trim());
  arr.forEach(item => {
    classes.forEach(className => {
      item.classList.remove(className);
    });
  });
};

// ----------------------------------------------------
const addClassInArray = (arr, customClass = 'active') => {
  const classes = customClass.split(',').map(cls => cls.trim());
  arr.forEach(item => {
    classes.forEach(className => {
      item.classList.add(className);
    });
  });
};

// ----------------------------------------------------
const toggleClassInArray = (arr, customClass = 'active') => {
  const classes = customClass.split(',').map(cls => cls.trim());
  arr.forEach(item => {
    classes.forEach(className => {
      item.classList.toggle(className);
    });
  });
};

//-----------------------------------------------------

const elementHeight = (el, variableName) => {
  // el -- сам елемент (но не коллекция)
  // variableName -- строка, имя создаваемой переменной
  if (el) {
    function initListener() {
      const elementHeight = el.offsetHeight;
      document.querySelector(':root').style.setProperty(`--${variableName}`, `${elementHeight}px`);
    }
    window.addEventListener('DOMContentLoaded', initListener);
    window.addEventListener('resize', initListener);
  }
};
const elementWidth = (el, variableName) => {
  // el -- сам элемент (но не коллекция)
  // variableName -- строка, имя создаваемой переменной
  if (el) {
    function initListener() {
      const elementWidth = el.offsetWidth;
      document.querySelector(':root').style.setProperty(`--${variableName}`, `${elementWidth}px`);
    }
    window.addEventListener('DOMContentLoaded', initListener);
    window.addEventListener('resize', initListener);
  }
};

//-----------------------------------------------------

const stickyHeader = (block, duration, delay, type, offset = 0, scrollThreshold = 40) => {
  let lastScrollTop = 0;
  let accumulatedScroll = 0;
  block.style.transition = `all ${duration}ms ${type}`;
  const updateHeaderPosition = () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll > block.offsetHeight + offset) {
      if (currentScroll > lastScrollTop) {
        block.style.top = `-${block.offsetHeight}px`;
        block.style.transitionDelay = '0ms';
        accumulatedScroll = 0;
      } else {
        accumulatedScroll += lastScrollTop - currentScroll;
        if (accumulatedScroll >= scrollThreshold) {
          block.style.top = '0';
          block.style.transitionDelay = `${delay}ms`;
          accumulatedScroll = 0;
        }
      }
    } else {
      block.style.top = '0';
      block.style.transitionDelay = '0ms';
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
  };
  const debounce = (func, wait) => {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  };
  const debouncedUpdateHeader = debounce(updateHeaderPosition, 10);
  window.addEventListener('scroll', debouncedUpdateHeader);
};
const scrollToSection = (sectionSelector, action) => {
  const section = document.querySelector(sectionSelector);
  window.addEventListener('scroll', () => {
    if (!section) return;
    const rect = section.getBoundingClientRect();
    if (rect.top <= window.innerHeight && rect.bottom >= 0) {
      action();
    }
  });
};

// ----------------------------------------------------
const initParallaxEffect = containerSelector => {
  const container = document.querySelector(containerSelector);
  if (!container) {
    return;
  }
  const image = container.querySelector('img');
  if (!image) {
    return;
  }
  document.addEventListener('mousemove', function (e) {
    const x = e.clientX - container.offsetLeft;
    const y = e.clientY - container.offsetTop;
    const width = container.offsetWidth;
    const height = container.offsetHeight;
    const moveY = (x - width / 2) / width * 20;
    const moveX = (y - height / 2) / height * 22;
    image.style.transform = `translate(${moveX}px, ${moveY}px)`;
  });
};
// ----------------------------------------------------
const animateInit = (array, initClass, timing) => {
  let currentIndex = 0;
  document.querySelector(':root').style.setProperty(`--${initClass}`, `${timing}ms`);
  const animateListItem = () => {
    array.forEach(item => item.classList.remove(initClass));
    array[currentIndex].classList.add(initClass);
    currentIndex = (currentIndex + 1) % array.length;
    setTimeout(animateListItem, timing);
  };
  animateListItem();
};
// ----------------------------------------------------
const scrollToElement = (element, direction) => {
  if (element) {
    const position = element.getBoundingClientRect();
    if (direction === 'up') {
      window.scrollTo({
        top: position.top + window.scrollY - element.offsetHeight,
        behavior: 'smooth'
      });
    } else if (direction === 'down') {
      window.scrollTo({
        top: position.bottom + window.scrollY,
        behavior: 'smooth'
      });
    }
  }
};
// ----------------------------------------------------

/***/ }),

/***/ "./source/js/functions/disable-scroll.js":
/*!***********************************************!*\
  !*** ./source/js/functions/disable-scroll.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   disableScroll: () => (/* binding */ disableScroll)
/* harmony export */ });
/* harmony import */ var _vars_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../_vars.js */ "./source/js/_vars.js");

const disableScroll = () => {
  const fixBlocks = document?.querySelectorAll('.fixed-block');
  const pagePosition = window.scrollY;
  const paddingOffset = `${window.innerWidth - _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.offsetWidth}px`;
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].htmlEl.style.scrollBehavior = 'none';
  fixBlocks.forEach(el => {
    el.style.paddingRight = paddingOffset;
  });
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.style.paddingRight = paddingOffset;
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.classList.add('dis-scroll');
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.dataset.position = pagePosition;
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.style.top = `-${pagePosition}px`;
};

/***/ }),

/***/ "./source/js/functions/enable-scroll.js":
/*!**********************************************!*\
  !*** ./source/js/functions/enable-scroll.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   enableScroll: () => (/* binding */ enableScroll)
/* harmony export */ });
/* harmony import */ var _vars_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../_vars.js */ "./source/js/_vars.js");

const enableScroll = () => {
  const fixBlocks = document?.querySelectorAll('.fixed-block');
  const body = document.body;
  const pagePosition = parseInt(_vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.dataset.position, 10);
  fixBlocks.forEach(el => {
    el.style.paddingRight = '0px';
  });
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.style.paddingRight = '0px';
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.style.top = 'auto';
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.classList.remove('dis-scroll');
  if (pagePosition) {
    window.scroll({
      top: pagePosition,
      left: 0
    });
  }
  _vars_js__WEBPACK_IMPORTED_MODULE_0__["default"].bodyEl.removeAttribute('data-position');
};

/***/ }),

/***/ "./source/js/functions/scripts/burger.js":
/*!***********************************************!*\
  !*** ./source/js/functions/scripts/burger.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _disable_scroll_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../disable-scroll.js */ "./source/js/functions/disable-scroll.js");
/* harmony import */ var _enable_scroll__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../enable-scroll */ "./source/js/functions/enable-scroll.js");
/* harmony import */ var _customFunctions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../customFunctions */ "./source/js/functions/customFunctions.js");



class MobileMenu {
  constructor({
    overlay,
    burger,
    mobileMenu,
    header,
    activeClass,
    activeClassMode,
    additionalBlocks = [],
    onToggle = null
  }) {
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
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.toggleCustomClass)(element, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.toggleClassInArray)(trigger, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.toggleCustomClass)(this.overlay, this.activeClass);
    if (element.classList.contains(this.activeClass)) {
      (0,_disable_scroll_js__WEBPACK_IMPORTED_MODULE_0__.disableScroll)();
      (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.addCustomClass)(this.header, "open-menu");
    } else {
      (0,_enable_scroll__WEBPACK_IMPORTED_MODULE_1__.enableScroll)();
      (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeCustomClass)(this.header, "open-menu");
    }
    if (typeof this.onToggle === 'function') {
      this.onToggle(element.classList.contains(this.activeClass));
    }
  }
  hideMenu(element, trigger) {
    (0,_enable_scroll__WEBPACK_IMPORTED_MODULE_1__.enableScroll)();
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeCustomClass)(element, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeClassInArray)(trigger, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeCustomClass)(this.overlay, this.activeClass);
    if (element.classList.contains(this.activeClass)) {
      (0,_disable_scroll_js__WEBPACK_IMPORTED_MODULE_0__.disableScroll)();
      (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.addCustomClass)(this.header, "open-menu");
    } else {
      (0,_enable_scroll__WEBPACK_IMPORTED_MODULE_1__.enableScroll)();
      (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeCustomClass)(this.header, "open-menu");
    }
  }
  init() {
    this.burger.forEach(btn => {
      btn.addEventListener("click", e => {
        e.preventDefault();
        this.toggleMenu(this.mobileMenu, this.burger);
      });
    });
    if (this.overlay) {
      this.overlay.addEventListener("click", e => {
        if (e.target.classList.contains("overlay")) {
          this.hideMenu(this.mobileMenu, this.burger);
        }
      });
    }
    this.mobileMenu.querySelectorAll("a").forEach(item => {
      item.addEventListener("click", () => {
        this.hideMenu(this.mobileMenu, this.burger);
      });
    });
    document.querySelectorAll("[data-modal]").forEach(item => {
      item.addEventListener("click", () => {
        this.hideMenu(this.mobileMenu, this.burger);
        (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.addCustomClass)(this.overlay, 'active-mode');
      });
    });
    this.additionalBlocks.forEach(({
      trigger,
      target
    }) => {
      if (trigger && target) {
        trigger.addEventListener("click", e => {
          e.stopPropagation();
          this.toggleMenu(target, trigger);
        });
        document.addEventListener("click", e => {
          if (!target.contains(e.target) && !trigger.contains(e.target)) {
            trigger.classList.remove(this.activeClass);
            target.classList.remove(this.activeClass);
          }
        });
      }
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (MobileMenu);

/***/ }),

/***/ "./source/js/functions/scripts/loaderInstanse.js":
/*!*******************************************************!*\
  !*** ./source/js/functions/scripts/loaderInstanse.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   loaderInstanse: () => (/* binding */ loaderInstanse)
/* harmony export */ });
const loaderInstanse = (loader, flag = false) => {
  loader.setAttribute('data-loader', flag);
};

/***/ }),

/***/ "./source/js/functions/scripts/modals.js":
/*!***********************************************!*\
  !*** ./source/js/functions/scripts/modals.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _disable_scroll__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../disable-scroll */ "./source/js/functions/disable-scroll.js");
/* harmony import */ var _enable_scroll__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../enable-scroll */ "./source/js/functions/enable-scroll.js");
/* harmony import */ var _customFunctions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../customFunctions */ "./source/js/functions/customFunctions.js");



class ModalManager {
  constructor({
    activeMode = '',
    fadeInTimeout,
    fadeOutTimeout
  }) {
    this.overlay = document.querySelector('[data-overlay]');
    this.modalsButton = document.querySelectorAll("[data-btn-modal], a[href^='/modal_']");
    this.innerButtonModal = document.querySelectorAll("[data-btn-inner]");
    this.modals = document.querySelectorAll('[data-popup]');
    this.activeClass = 'active';
    this.activeMode = activeMode;
    this.mobileMenu = document.querySelector('.mobile');
    this.burger = document.querySelectorAll('.burger');
    this.innerButton = null;
    this.timeIn = fadeInTimeout;
    this.timeOut = fadeOutTimeout;
    if (this.overlay) {
      this.bindEvents();
      this.checkURLModal(); // Проверяем и открываем модалку, если есть в URL
    } else {
      console.error('Overlay element not found!');
    }
  }
  bindEvents() {
    this.overlay.addEventListener("click", e => this.overlayClickHandler(e));
    this.modalsButton.forEach(btn => {
      btn.addEventListener("click", e => {
        e.preventDefault();
        if (btn.tagName === 'A' && btn.getAttribute('href').startsWith('/modal_')) {
          const modalID = this.extractModalIDFromHref(btn.getAttribute('href'));
          if (modalID) {
            this.openModal('modal_' + modalID);
            this.removeModalFromURL(); // Удаляем /modal_... из URL
          }
        } else if (btn.hasAttribute("data-btn-modal")) {
          this.buttonClickHandler(e, "data-btn-modal");
          this.removeModalFromURL();
        }
      });
    });
    this.innerButtonModal.forEach(btn => {
      btn.addEventListener("click", e => this.innerButtonClickHandler(e));
    });
  }
  checkURLModal() {
    const modalID = this.extractModalIDFromHref(window.location.href);
    if (modalID) {
      this.openModal('modal_' + modalID);
      this.removeModalFromURL();
    }
  }
  removeModalFromURL() {
    const url = window.location.origin + window.location.pathname;
    history.replaceState({}, '', url);
  }
  extractModalIDFromHref(href) {
    const match = href.match(/\/?modal_(\d+)/);
    return match ? match[1] : null;
  }
  closeModal() {
    if (!this.overlay) return;
    this.activeMode && (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeCustomClass)(this.overlay, this.activeMode);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeCustomClass)(this.overlay, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeClassInArray)(this.modals, this.activeClass);
    this.modals.forEach(modal => (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.fadeOut)(modal, this.timeOut));
    (0,_enable_scroll__WEBPACK_IMPORTED_MODULE_1__.enableScroll)();
  }
  buttonClickHandler(e, buttonAttribute) {
    e.preventDefault();
    const attributeValue = this.findAttribute(e.target, buttonAttribute);
    if (!attributeValue) return;
    this.openModal(attributeValue);
    this.removeModalFromURL();
  }
  openModal(attributeValue) {
    if (!this.overlay) return;
    const modal = this.overlay.querySelector(`[data-popup="${attributeValue}"]`);
    if (!modal) return;
    this.mobileMenu && (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeCustomClass)(this.mobileMenu, this.activeClass);
    this.burger && (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeClassInArray)(this.burger, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeClassInArray)(this.modals, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.addCustomClass)(this.overlay, this.activeClass);
    this.activeMode && (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.addCustomClass)(this.overlay, this.activeMode);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.addCustomClass)(modal, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.fadeIn)(modal, this.timeIn, 'flex');
    (0,_disable_scroll__WEBPACK_IMPORTED_MODULE_0__.disableScroll)();
    this.innerButton = modal.querySelector('.close');
  }
  overlayClickHandler(e) {
    if (e.target === this.overlay || e.target === this.innerButton) {
      this.closeModal();
    }
  }
  innerButtonClickHandler(e) {
    e.preventDefault();
    (0,_enable_scroll__WEBPACK_IMPORTED_MODULE_1__.enableScroll)();
    const prevId = this.findAttribute(e.target.closest('[data-popup]'), 'data-popup');
    if (!prevId) return;
    const currentModalId = e.target.getAttribute("data-btn-inner");
    const currentModal = this.overlay.querySelector(`[data-popup="${currentModalId}"]`);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.removeClassInArray)(this.modals, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.addCustomClass)(this.overlay, this.activeClass);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.fadeOut)(document.querySelector(`[data-popup="${prevId}"]`), 0);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.fadeIn)(currentModal, this.timeIn);
    (0,_customFunctions__WEBPACK_IMPORTED_MODULE_2__.addCustomClass)(currentModal, this.activeClass);
    (0,_disable_scroll__WEBPACK_IMPORTED_MODULE_0__.disableScroll)();
    this.innerButton = currentModal.querySelector('.close');
    this.removeModalFromURL();
  }
  findAttribute(element, attributeName) {
    let target = element;
    while (target && target !== document) {
      if (target.hasAttribute(attributeName)) {
        return target.getAttribute(attributeName);
      }
      target = target.parentNode;
    }
    return null;
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ModalManager);

/***/ }),

/***/ "./source/js/main.js":
/*!***************************!*\
  !*** ./source/js/main.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_components.js */ "./source/js/_components.js");


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"main": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkgulp_project"] = self["webpackChunkgulp_project"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendors"], () => (__webpack_require__("./source/js/main.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=main.bundle.js.map