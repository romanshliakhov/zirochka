import { getAjaxData } from "../functions/ajax-get-data";
import Swiper from "swiper";
import { Navigation } from "swiper/modules";
import { loaderInstanse } from "../functions/scripts/loaderInstanse";

Swiper.use([Navigation]);

document.addEventListener("DOMContentLoaded", () => {
	const container = document.querySelector(".section-areas");
	if (!container) return;

	function renderProjects(projects) {
		if (!projects.length) {
			return '<em>No completed projects are available for this city yet.</em>';
		}
		return `<div data-map style="width: 100%; height: 100%;"></div>`;
	}

	let currentInfoWindow = null;

	window.initGoogleMapsForContainer = function (container, projects) {
		if (!container || !projects?.length) return;

		const center = {
			lat: parseFloat(projects[0].coordinates.lat),
			lng: parseFloat(projects[0].coordinates.lng),
		};

		const map = new google.maps.Map(container, {
			zoom: 13,
			center: center,
		});

		projects.forEach((project, index) => {
			const lat = parseFloat(project.coordinates.lat);
			const lng = parseFloat(project.coordinates.lng);
			if (isNaN(lat) || isNaN(lng)) return;

			const marker = new google.maps.Marker({
				position: { lat, lng },
				map,
			});

			// Уникальные ID для слайдера и кнопок
			const swiperId = `swiper-${project.id}`;
			const nextBtnId = `next-${project.id}`;
			const prevBtnId = `prev-${project.id}`;

			const gallerySlides = (project.gallery || [])
				.map(
					(img) => `
					<div class="swiper-slide">
						<div class="location-card__thumbnail">
							<img src="${img.url}" alt="${img.alt || project.title}" />
						</div>
					</div>`
				)
				.join("");

			const tagsRoofing = (project.tags?.roofing_type || [])
				.map((tag) => `<li></li><span class="project-card__tag">${tag}</span></li>`)
				.join("");
			const tagsColor = (project.tags?.roof_color || [])
				.map((tag) => `<li><span class="project-card__tag">${tag}</span></li>`)
				.join("");
			const tagsLocation = (project.tags?.project_location || [])
				.map((tag) => `<li><span class="project-card__tag">${tag}</span></li>`)
				.join("");

			const content = `
				<div class="location-card">
					<div class="location-card__close">
						<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M18.354 17.646C18.549 17.841 18.549 18.158 18.354 18.353C18.256 18.451 18.128 18.499 18 18.499C17.872 18.499 17.744 18.45 17.646 18.353L12 12.707L6.35401 18.353C6.25601 18.451 6.12801 18.499 6.00001 18.499C5.87201 18.499 5.74401 18.45 5.64601 18.353C5.45101 18.158 5.45101 17.841 5.64601 17.646L11.292 12L5.64601 6.35401C5.45101 6.15901 5.45101 5.84198 5.64601 5.64698C5.84101 5.45198 6.15801 5.45198 6.35301 5.64698L11.999 11.293L17.645 5.64698C17.84 5.45198 18.157 5.45198 18.352 5.64698C18.547 5.84198 18.547 6.15901 18.352 6.35401L12.707 12L18.354 17.646Z"/>
						</svg>
					</div>
					<div class="location-card__slider swiper" id="${swiperId}">
						<div class="swiper-wrapper">${gallerySlides}</div>
						<div class="swiper-button-next" id="${nextBtnId}">
                            <svg width="16" height="16" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.2917 6.97647C11.1988 6.88356 11.1251 6.77326 11.0748 6.65187C11.0245 6.53048 10.9987 6.40037 10.9987 6.26897C10.9987 6.13758 11.0245 6.00747 11.0748 5.88608C11.1251 5.76468 11.1988 5.65438 11.2917 5.56147C11.3846 5.46856 11.4949 5.39486 11.6163 5.34458C11.7377 5.2943 11.8678 5.26842 11.9992 5.26842C12.1306 5.26842 12.2607 5.2943 12.3821 5.34458C12.5035 5.39486 12.6138 5.46856 12.7067 5.56147L22.7067 15.5615C22.7997 15.6543 22.8734 15.7646 22.9238 15.886C22.9741 16.0074 23 16.1376 23 16.269C23 16.4004 22.9741 16.5305 22.9238 16.6519C22.8734 16.7733 22.7997 16.8836 22.7067 16.9765L12.7067 26.9765C12.5191 27.1641 12.2646 27.2695 11.9992 27.2695C11.7338 27.2695 11.4794 27.1641 11.2917 26.9765C11.1041 26.7888 10.9987 26.5343 10.9987 26.269C10.9987 26.0036 11.1041 25.7491 11.2917 25.5615L20.5855 16.269L11.2917 6.97647Z" fill="white"/>
                            </svg>
                        </div>
						<div class="swiper-button-prev" id="${prevBtnId}">
                            <svg width="16" height="16" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.7083 25.5626C20.8012 25.6555 20.8749 25.7658 20.9252 25.8872C20.9755 26.0086 21.0013 26.1387 21.0013 26.2701C21.0013 26.4015 20.9755 26.5316 20.9252 26.653C20.8749 26.7744 20.8012 26.8847 20.7083 26.9776C20.6154 27.0705 20.5051 27.1442 20.3837 27.1945C20.2623 27.2448 20.1322 27.2706 20.0008 27.2706C19.8694 27.2706 19.7393 27.2448 19.6179 27.1945C19.4965 27.1442 19.3862 27.0705 19.2933 26.9776L9.29329 16.9776C9.20031 16.8847 9.12655 16.7744 9.07623 16.653C9.0259 16.5316 9 16.4015 9 16.2701C9 16.1387 9.0259 16.0085 9.07623 15.8871C9.12655 15.7657 9.20031 15.6555 9.29329 15.5626L19.2933 5.56259C19.4809 5.37495 19.7354 5.26953 20.0008 5.26953C20.2662 5.26953 20.5206 5.37495 20.7083 5.56259C20.8959 5.75023 21.0013 6.00472 21.0013 6.27009C21.0013 6.53545 20.8959 6.78995 20.7083 6.97759L11.4145 16.2701L20.7083 25.5626Z" fill="white"/>
                            </svg>
                        </div>
					</div>
					<ul class="location-card__tags">
						${tagsRoofing}
						${tagsColor}
						${tagsLocation}
					</ul>
					<div class="location-card__bottom">
						<span class="location-card__title">${project.title}</span>
						<a class="location-card__link" href="${project.permalink}" rel="noopener noreferrer">About project</a>
					</div>
				</div>`;

			const infoWindow = new google.maps.InfoWindow({ content });

			marker.addListener("click", () => {
				if (currentInfoWindow) currentInfoWindow.close();
				infoWindow.open(map, marker);
				currentInfoWindow = infoWindow;

				// Инициализируем Swiper внутри InfoWindow (после открытия)
				setTimeout(() => {
					new Swiper(`#${swiperId}`, {
						slidesPerView: 1,
						loop: true,
						navigation: {
							nextEl: `#${nextBtnId}`,
							prevEl: `#${prevBtnId}`,
						},
					});

					// Добавляем обработчик на кнопку закрытия
					const closeBtn = document.querySelector(".location-card__close");
					
					if (closeBtn) {
						closeBtn.addEventListener("click", () => {
							if (currentInfoWindow) {
								currentInfoWindow.close();
								currentInfoWindow = null;
							}
						});
					}
				}, 100);
			});
		});

		google.maps.event.addListenerOnce(map, "idle", () => {
			map.panBy(0, -100);
		});
	};

	const cityButtons = container.querySelectorAll(".section-areas__list button[data-city-id]");
	
	cityButtons.forEach((btn) => {
		btn.addEventListener("click", (e) => {
			e.preventDefault();

			const list = btn.closest(".section-areas__list");
			if (!list) return;
			list.querySelectorAll("button[data-city-id]").forEach((b) => b.classList.remove("active"));
			btn.classList.add("active");

			const cityId = btn.dataset.cityId;
			const tabContent = btn.closest(".tabs-content__item");
			const projectsContainer = tabContent?.querySelector(".section-areas__location");
			if (!cityId || !projectsContainer) return;

			projectsContainer.innerHTML = "Loading...";
			loaderInstanse(projectsContainer, true);

			getAjaxData(
				ajax_params.ajax_url,
				"get_towns_areas",
				{
					nonce: ajax_params.once,
					post_id: cityId,
				},
				(res) => {
					if (res.success) {
						const html = renderProjects(res.data.projects);
						projectsContainer.innerHTML = html;
						const mapContainer = projectsContainer.querySelector("[data-map]");
						if (mapContainer) {
							window.initGoogleMapsForContainer(mapContainer, res.data.projects);
						}
					} else {
						projectsContainer.innerHTML = "<em>Ошибка загрузки проектов</em>";
					}
					loaderInstanse(projectsContainer, false);
				}
			);
		});
	});

	const activeTab = container.querySelector(".tabs-content__item.active");

	if (activeTab) {
		const firstCityBtn = activeTab.querySelector(".section-areas__list button[data-city-id]");
		if (firstCityBtn) firstCityBtn.click();
	}

	const observer = new MutationObserver((mutations) => {
		mutations.forEach((mutation) => {
			if (
				mutation.target.classList.contains("tabs-content__item") &&
				mutation.target.classList.contains("active")
			) {
				const firstCityBtn = mutation.target.querySelector(".section-areas__list button[data-city-id]");
				if (firstCityBtn) firstCityBtn.click();
			}
		});
	});

	container.querySelectorAll(".tabs-content__item").forEach((tab) => {
		observer.observe(tab, {
			attributes: true,
			attributeFilter: ["class"],
		});
	});
});
