import { disableScroll } from "../disable-scroll";
import { enableScroll } from "../enable-scroll";
import { addCustomClass, removeCustomClass, removeClassInArray, fadeIn, fadeOut } from "../customFunctions";

class ModalManager {
  constructor({ activeMode = '', fadeInTimeout, fadeOutTimeout }) {
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
    this.overlay.addEventListener("click", (e) => this.overlayClickHandler(e));

    this.modalsButton.forEach(btn => {
      btn.addEventListener("click", (e) => {
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
      btn.addEventListener("click", (e) => this.innerButtonClickHandler(e));
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
    this.activeMode && removeCustomClass(this.overlay, this.activeMode);
    removeCustomClass(this.overlay, this.activeClass);
    removeClassInArray(this.modals, this.activeClass);
    this.modals.forEach(modal => fadeOut(modal, this.timeOut));
    enableScroll();
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

    this.mobileMenu && removeCustomClass(this.mobileMenu, this.activeClass);
    this.burger && removeClassInArray(this.burger, this.activeClass);
    removeClassInArray(this.modals, this.activeClass);
    addCustomClass(this.overlay, this.activeClass);
    this.activeMode && addCustomClass(this.overlay, this.activeMode);
    addCustomClass(modal, this.activeClass);
    fadeIn(modal, this.timeIn, 'flex');
    disableScroll();

    this.innerButton = modal.querySelector('.close');
  }

  overlayClickHandler(e) {
    if (e.target === this.overlay || e.target === this.innerButton) {
      this.closeModal();
    }
  }

  innerButtonClickHandler(e) {
    e.preventDefault();
    enableScroll();
    const prevId = this.findAttribute(e.target.closest('[data-popup]'), 'data-popup');
    if (!prevId) return;

    const currentModalId = e.target.getAttribute("data-btn-inner");
    const currentModal = this.overlay.querySelector(`[data-popup="${currentModalId}"]`);
    removeClassInArray(this.modals, this.activeClass);
    addCustomClass(this.overlay, this.activeClass);
    fadeOut(document.querySelector(`[data-popup="${prevId}"]`), 0);
    fadeIn(currentModal, this.timeIn);
    addCustomClass(currentModal, this.activeClass);
    disableScroll();
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

export default ModalManager;