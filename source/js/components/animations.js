import AOS from 'aos';

AOS.init({
    startEvent: 'DOMContentLoaded',
    once: true,
    mirror: false,
    anchorPlacement: 'top-bottom',
    duration: 1200,
    easing: 'ease-in-out-back',
    offset: 150,
});