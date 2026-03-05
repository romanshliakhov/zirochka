import Swiper from 'swiper';
import { EffectFade, Controller, Pagination } from 'swiper/modules';
import {modalManagerObject} from "./modals";
import {removeCustomClass} from "../functions/customFunctions";

const QuizSlider = {
    init() {
        this.initSliders();
        this.bindEvents();
        this.updateButtonState();
        this.preventDefaultFormSubmit(); // <-- обязательно
    },

    initSliders() {
        this.leftSwiper = new Swiper('.section-quiz__coll.swiper-container--left', {
            modules: [EffectFade, Controller],
            effect: 'fade',
            fadeEffect: { crossFade: true },
            allowTouchMove: false,
            autoHeight: true,
        });

        this.rightSwiper = new Swiper('.section-quiz__coll.swiper-container--right', {
            modules: [EffectFade, Controller, Pagination],
            effect: 'fade',
            fadeEffect: { crossFade: true },
            autoHeight: true,
            slidesPerView: 1,
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            allowTouchMove: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            controller: {
                control: this.leftSwiper,
            }
        });
    },

    bindEvents() {
        this.nextButton = document.querySelector('.section-quiz__buttons .next');
        this.prevButton = document.querySelector('.section-quiz__buttons .prev');

        if (this.nextButton) {
            this.nextButton.addEventListener('click', (e) => {
                e.preventDefault();

                if (this.isLastSlide()) {
                    const isValid = this.validateCurrentSlide(true);
                    if (isValid) {
                        this.collectFormData(); // Только тут отправляем
                    }
                } else {
                    const isValid = this.validateCurrentSlide(true);
                    if (isValid) {
                        this.rightSwiper.slideNext();
                    }
                }
            });
        }

        if (this.prevButton) {
            this.prevButton.addEventListener('click', (e) => {
                e.preventDefault();
                this.rightSwiper.slidePrev();
            });
        }

        document.addEventListener('input', (e) => this.onInputChange(e));
        document.addEventListener('change', (e) => this.onInputChange(e));

        this.rightSwiper.on('slideChange', () => {
            this.updateButtonState();
        });
    },

    preventDefaultFormSubmit() {
        const form = document.getElementById('quiz_data')?.closest('form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                console.log('Default form submit blocked.');
            });
        }
    },

    validateCurrentSlide(showErrors = false) {
        const currentSlide = this.rightSwiper.slides[this.rightSwiper.activeIndex];
        const requiredInputs = currentSlide.querySelectorAll('[required]');

        if (requiredInputs.length === 0) {
            return true;
        }

        let isValid = true;

        requiredInputs.forEach((input) => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                const name = input.name;
                const group = currentSlide.querySelectorAll(`[name="${name}"]`);
                const isChecked = Array.from(group).some((el) => el.checked);

                if (!isChecked) {
                    isValid = false;
                    if (showErrors) input.closest('label')?.classList.add('error');
                } else {
                    if (showErrors) input.closest('label')?.classList.remove('error');
                }
            } else {
                if (!input.value.trim()) {
                    isValid = false;
                    if (showErrors) input.classList.add('error');
                } else {
                    if (showErrors) input.classList.remove('error');
                }
            }
        });

        return isValid;
    },

    updateButtonState() {
        if (this.nextButton) {
            this.nextButton.textContent = this.isLastSlide() ? 'Exit' : 'Next';
        }

        if (this.prevButton) {
            this.prevButton.disabled = this.rightSwiper.activeIndex === 0;
        }
    },

    isLastSlide() {
        return this.rightSwiper.activeIndex === this.rightSwiper.slides.length - 1;
    },

    resetQuiz() {
        const form = document.getElementById('quiz_data')?.closest('form');
        const hiddenInput = document.getElementById('quiz_data');

        if (form) {
            form.reset();
        }
        if (hiddenInput) {
            hiddenInput.value = '';
        }

        const slides = this.rightSwiper.slides;
        slides.forEach((slide) => {
            const inputs = slide.querySelectorAll('input, textarea, select');
            inputs.forEach((input) => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = false;
                } else {
                    input.value = '';
                }
            });
        });

        document.querySelectorAll('.error, .done').forEach(el => {
            el.classList.remove('error', 'done');
        });

        this.rightSwiper.slideTo(0);
        this.leftSwiper?.slideTo?.(0);

        this.updateButtonState();
    },

    onInputChange(e) {
        const currentSlide = this.rightSwiper.slides[this.rightSwiper.activeIndex];
        if (!currentSlide.contains(e.target)) return;

        const input = e.target;

        if (input.classList.contains('error')) {
            input.classList.remove('error');
        }
        if (input.closest('label')?.classList.contains('error')) {
            input.closest('label')?.classList.remove('error');
        }

        input.classList.add('done');

        clearTimeout(input._doneTimer);
        input._doneTimer = setTimeout(() => {
            input.classList.remove('done');
        }, 2000);

        this.updateButtonState();
    },

    collectFormData() {
        const slides = this.rightSwiper.slides;
        let formData = {};

        slides.forEach((slide, index) => {
            if (index === slides.length - 1) return;

            const slideName = slide.dataset.slideName?.trim() || `slide_${index + 1}`;
            const inputs = slide.querySelectorAll('input, select, textarea');

            formData[slideName] = formData[slideName] || {};

            inputs.forEach((input) => {
                const name = input.name || `input_${Math.random().toString(36).substr(2, 5)}`;

                if (input.type === 'checkbox') {
                    formData[slideName][name] = input.checked ? input.value : '';
                } else if (input.type === 'radio') {
                    if (!(name in formData[slideName])) {
                        formData[slideName][name] = null;
                    }
                    if (input.checked) {
                        formData[slideName][name] = input.value;
                    }
                } else {
                    formData[slideName][name] = input.value.trim();
                }
            });
        });

        const hiddenInput = document.getElementById('quiz_data');
        const form = hiddenInput?.closest('form');

        if (hiddenInput && form) {
            hiddenInput.value = JSON.stringify(formData);

            const formDataToSend = new FormData(form);

            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: formDataToSend,
            })
                .then(response => response.text())
                .then(responseText => {

                    modalManagerObject.openModal(`modal_226`);

                    setTimeout(function () {
                        modalManagerObject.closeModal()
                    }, 600)
                    this.resetQuiz();
                })
                .catch(error => {
                    console.error('Ошибка отправки формы:', error);
                });
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('.section-quiz')){
       QuizSlider.init();
    }
});
