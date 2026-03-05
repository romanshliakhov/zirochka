import { addCustomClass, removeCustomClass } from "../functions/customFunctions";
import {modalManagerObject} from "./modals";
import {loaderInstanse} from "../functions/scripts/loaderInstanse";

document.addEventListener('DOMContentLoaded', function() {
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

            this.value = matrix.replace(/./g, function(a) {
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
            input.setAttribute('placeholder', pattern)
        });
    };

    mask('input[type="tel"]', '+38 (___) ___ ____');


    const formWrappers = document.querySelectorAll('.wpcf7');

    for (const formWrapper of formWrappers) {
        const formSubmitBtn = formWrapper.querySelector('button[type="submit"]');
        formWrapper.setAttribute('data-loader', false)

        if (formWrapper) {
            if (formSubmitBtn) {
                formSubmitBtn.addEventListener('click', function () {

                    removeCustomClass(formWrapper, 'loaded');
                    addCustomClass(formWrapper, 'loader');
                })
            }

            formWrapper.addEventListener('wpcf7invalid', function (event) {
                setTimeout(function () {
                    addCustomClass(formWrapper, 'loaded');
                }, 500)
            }, false);


            formWrapper.addEventListener( 'wpcf7mailfailed', function( event ) {
                modalManagerObject.closeModal()

                setTimeout(function () {
                    modalManagerObject.openModal(`modal_${errorModalID}`);
                }, 400)
            }, false );


            formWrapper.addEventListener('wpcf7mailsent', function (event) {
                modalManagerObject.closeModal()

                setTimeout(function () {
                    modalManagerObject.openModal(`modal_${thanksModalID}`);
                }, 400)

            }, false);

        }

    }
})
