window.initGoogleMaps = function () {
	const maps = document.querySelectorAll("[data-map]");

	if (!maps.length || !window.projectLocations?.length) return;

	maps.forEach((mapEl, index) => {
		// Пропускаем, если уже инициализировано
		if (mapEl.dataset.inited) return;
		mapEl.dataset.inited = "true";

		const project = window.projectLocations[index] || window.projectLocations[0];
		const lat = parseFloat(project.lat);
		const lng = parseFloat(project.lng);

		const map = new google.maps.Map(mapEl, {
			zoom: 13,
			center: { lat, lng },
		});

		const marker = new google.maps.Marker({
			position: { lat, lng },
			map,
		});

		const tags = (project.tags || []).map(tag => `
			<li><span class="project-card__tag">${tag}</span></li>
		`).join("");

		const content = `
			<div class="location-card">
				<div class="location-card__thumbnail">
					<img src="${project.image}" alt="${project.title}" />
				</div>
				<ul class="location-card__tags">${tags}</ul>
				<div class="location-card__bottom">
					<span class="location-card__title">${project.title}</span>
				</div>
			</div>`;

		const infoWindow = new google.maps.InfoWindow({
			content: content,
		});

		infoWindow.open(map, marker);

		google.maps.event.addListenerOnce(map, "idle", () => {
			map.panBy(0, -100);
		});
	});
};
