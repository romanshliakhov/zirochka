import Swiper from 'swiper';
import {Navigation, Pagination, EffectFade, Autoplay } from 'swiper/modules';

document.addEventListener("DOMContentLoaded", function () {
	const headerSlider = document.querySelector('.header__controls-slider');
	const servicesSlider = document.querySelector('.section-our-services__slider');
	const newsSlider = document.querySelector('.section-news__slider');

	// === HEADER SLIDER ===
	if (headerSlider) {
		const swiperContainer = headerSlider.querySelector(".swiper-container");

		const headerSwiper = new Swiper(swiperContainer, {
			modules: [Autoplay, EffectFade],
			slidesPerView: 1,
			direction: 'vertical', // Включаем вертикальный скролл
			speed: 1600,
			autoplay: {
				delay: 2500,
				disableOnInteraction: false,
			},
			effect: 'fade', // эффект затухания
			fadeEffect: {
				crossFade: true // для плавного перехода
			},
			observer: true,
			observeParents: true,
			loop: true,
		});
	}

	// === SERVICES SLIDER ===
	if (servicesSlider) {
		const swiperContainer = servicesSlider.querySelector('.swiper-container');
		
		if (swiperContainer) {
			new Swiper(swiperContainer, {
				modules: [Autoplay],
				slidesPerView: 3,
				spaceBetween: 16,
				speed: 1000,
				loop: true,
				watchOverflow: true,
				autoplay: {
					delay: 2000,
					disableOnInteraction: true,
				},
				breakpoints: {
					320: {
						slidesPerView: 2,
						spaceBetween: 10,
					},
					768: {
						slidesPerView: 3,
						spaceBetween: 16,
					},
				},
			});
		}
	}

	// === MEWS SLIDER ===
	if (newsSlider) {
		const swiperContainer = newsSlider.querySelector('.swiper-container');
		const nextBtn = newsSlider.querySelector('.next');
		const prevBtn = newsSlider.querySelector('.prev');

		if (swiperContainer) {
			new Swiper(swiperContainer, {
				modules: [Navigation, Autoplay],
				slidesPerView: 3,
				spaceBetween: 16,
				speed: 1000,
				loop: true,
				watchOverflow: true,
				// autoplay: {
				// 	delay: 2000,
				// 	disableOnInteraction: true,
				// },
				navigation: {
					nextEl: nextBtn,
					prevEl: prevBtn,
				},
				breakpoints: {
					320: {
						slidesPerView: 2,
						spaceBetween: 10,
					},
					768: {
						slidesPerView: 3,
						spaceBetween: 16,
					},
				},
			});
		}
	}
});