import Swiper from 'swiper';
import {Navigation} from 'swiper/modules';

document.addEventListener("DOMContentLoaded", function () {
	const booksSlider = document.querySelector('.books-section__slider');

	if (booksSlider) {
		const swiperContainer = booksSlider.querySelector('.swiper-container');
		const nextBtn = booksSlider.querySelector('.slider-btn.next');
		const prevBtn = booksSlider.querySelector('.slider-btn.prev');

		if (swiperContainer) {
			new Swiper(swiperContainer, {
				modules: [Navigation],
				slidesPerView: 5,
				spaceBetween: 40,
				speed: 1000,
				watchOverflow: true,
				navigation: {
					nextEl: nextBtn,
					prevEl: prevBtn,
				},
				breakpoints: {
					320: {
						slidesPerView: 2,
						spaceBetween: 16,
					},
					600: {
						slidesPerView: 3,
						spaceBetween: 24,
					},
					750: {
						slidesPerView: 3,
						spaceBetween: 40,
					},
					991: {
						slidesPerView: 5,
						spaceBetween: 40,
					},
					1444: {
						slidesPerView: 5,
						spaceBetween: 40,
					},
				},
			});
		}
	}

	const newsSlider = document.querySelector('.publications-section__slider');

	if (newsSlider) {
		const swiperContainer = newsSlider.querySelector('.swiper-container');
		const nextBtn = newsSlider.querySelector('.slider-btn.next');
		const prevBtn = newsSlider.querySelector('.slider-btn.prev');

		if (swiperContainer) {
			new Swiper(swiperContainer, {
				modules: [Navigation],
				slidesPerView: 4,
				spaceBetween: 40,
				speed: 1000,
				watchOverflow: true,
				navigation: {
					nextEl: nextBtn,
					prevEl: prevBtn,
				},
				breakpoints: {
					320: {
						slidesPerView: 2,
						spaceBetween: 16,
					},
					650: {
						slidesPerView: 3,
						spaceBetween: 24,
					},
					750: {
						slidesPerView: 3,
						spaceBetween: 40,
					},
					1150: {
						slidesPerView: 4,
						spaceBetween: 40,
					},
				},
			});
		}
	}
});