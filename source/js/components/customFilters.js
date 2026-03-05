import CustomSelect from "../functions/scripts/select";
import { initSliders } from "../components/sliders";

document.addEventListener('DOMContentLoaded', () => {
	const isFilterPage = document.querySelector('.custom-select');
	const projectsContainer = document.querySelector('.projects__items-list');
	const button = document.getElementById('load-more-projects');

	if (!isFilterPage || !projectsContainer) return;

	const customFilters = [
		{ selector: '#filter-types .custom-select', name: 'types' },
		{ selector: '#filter-locations .custom-select', name: 'locations' },
		{ selector: '#filter-colors .custom-select', name: 'colors' },
	];

	let currentFetchController = null;
	let offset = 4;
	let totalProjectsCount = 0;

	const fetchProjects = (reset = false) => {
		if (reset) offset = 0;

		const filters = {
			types: document.querySelector('input[name="types"]')?.value || 'all',
			locations: document.querySelector('input[name="locations"]')?.value || 'all',
			colors: document.querySelector('input[name="colors"]')?.value || 'all',
		};

		if (currentFetchController) currentFetchController.abort();
		currentFetchController = new AbortController();

		const formData = new FormData();
		formData.append('action', 'get_filters_projects');
		formData.append('nonce', window.ajax_params.once);
		Object.entries(filters).forEach(([key, val]) => formData.append(key, val));

		fetch(window.ajax_params.ajax_url, {
			method: 'POST',
			body: formData,
			signal: currentFetchController.signal,
		})
			.then(response => {
				if (!response.ok) throw new Error('Network error');
				return response.json();
			})
			.then(data => {
				if (data.success && projectsContainer) {
					projectsContainer.innerHTML = data.data.html;

					const cardCount = projectsContainer.querySelectorAll('.project-card').length;
					offset = cardCount;
					totalProjectsCount = data.data.total_projects_count;

					manageButtonVisibility();
					initSliders(); // ← вызываем после обновления DOM
				}
			})
			.catch(err => {
				if (err.name !== 'AbortError') {
					console.error('[fetchProjects] Error:', err);
				}
			});
	};

	const manageButtonVisibility = () => {
		if (!button) return;

		if (totalProjectsCount <= offset) {
			button.style.display = 'none';
		} else {
			button.style.display = 'inline-block';
			button.disabled = false;
		}
	};

	const loadMoreProjects = () => {
		const filters = {
			types: document.querySelector('input[name="types"]')?.value || 'all',
			locations: document.querySelector('input[name="locations"]')?.value || 'all',
			colors: document.querySelector('input[name="colors"]')?.value || 'all',
		};

		const formData = new FormData();
		formData.append('action', 'get_more_projects');
		formData.append('nonce', window.ajax_params.once);
		formData.append('offset', offset);
		Object.entries(filters).forEach(([key, val]) => formData.append(key, val));

		if (button) button.disabled = true;

		fetch(window.ajax_params.ajax_url, {
			method: 'POST',
			body: formData,
		})
			.then(res => res.json())
			.then(data => {
				if (data.success && projectsContainer) {
					const temp = document.createElement('div');
					temp.innerHTML = data.data.html;
					const newCards = temp.querySelectorAll('.project-card');
					newCards.forEach(card => projectsContainer.appendChild(card));

					offset += newCards.length;

					manageButtonVisibility();
					initSliders(); // ← снова инициализация
				} else if (button) {
					button.style.display = 'none';
				}
			})
			.catch(err => {
				console.error('[LoadMore] Error:', err);
				if (button) button.disabled = false;
			});
	};

	window.customSelectInstance = {};

	document.querySelectorAll('.filters__box [data-name]').forEach(function(box){
		const element = box.querySelector('.custom-select');

		if (element) {
			const select = new CustomSelect(element, {
				mode: 'single',
				placeholder: 'All',
				hideOnSelect: true,
				showRemoveButton: true,
				name: box.getAttribute('data-name'),
				showInfo: false,

				onSelect: (value) => {
					fetchProjects(true)

					// if(box.getAttribute('data-name') === 'types' && value === 'iron-stone-slate'){
					// 	const currentSelect = window.customSelectInstance['select-colors'];

					// 	currentSelect.disableOptions(['brown-color', 'dark-brown']);
					// }
				},


				onRemove: () => {
					const input = element.querySelector(`input[name="${box.getAttribute('data-name')}"]`);
					if (input) input.value = '';
					fetchProjects(true);

					// if(box.getAttribute('data-name') === 'types'){
					// 	const currentSelect = window.customSelectInstance['select-colors'];

					// 	currentSelect.enableAllOptions();
					// }
				}
			});

			const input = element.querySelector(`input[name="${box.getAttribute('data-name')}"]`);

			if (input) input.value = '';

			const instanceKey = `select-${box.getAttribute('data-name')}`;

			window.customSelectInstance[instanceKey] = select;
		}
	});

	if (button) {
		button.addEventListener('click', loadMoreProjects);
	}

	// Первичная загрузка
	const initialFilters = {
		types: document.querySelector('input[name="types"]')?.value || 'all',
		locations: document.querySelector('input[name="locations"]')?.value || 'all',
		colors: document.querySelector('input[name="colors"]')?.value || 'all',
	};

	const formData = new FormData();
	formData.append('action', 'get_filters_projects');
	formData.append('nonce', window.ajax_params.once);
	Object.entries(initialFilters).forEach(([key, val]) => formData.append(key, val));

	fetch(window.ajax_params.ajax_url, {
		method: 'POST',
		body: formData,
	})
		.then(response => response.json())
		.then(data => {
			if (data.success && projectsContainer) {
				projectsContainer.innerHTML = data.data.html;

				const cardCount = projectsContainer.querySelectorAll('.project-card').length;
				offset = cardCount;
				totalProjectsCount = data.data.total_projects_count;

				manageButtonVisibility();
				initSliders(); // ← тоже здесь
			}
		});
});
