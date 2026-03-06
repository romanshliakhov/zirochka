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
});