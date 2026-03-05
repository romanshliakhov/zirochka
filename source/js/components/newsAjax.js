import { getAjaxData } from "../functions/ajax-get-data";
import { loaderInstanse } from "../functions/scripts/loaderInstanse";

document.addEventListener('DOMContentLoaded', () => {
	const container = document.querySelector('.section-blog__posts');
	if (!container) return;

	const { ajax_url, once } = ajax_params;
	let currentPage = 1;

	function getParams() {
		return {
			nonce: once,
			page: currentPage
		};
	}

	function updateURL() {
		const url = new URL(window.location.href);
		url.searchParams.set('page', currentPage);
		history.pushState(null, '', url);
	}

    function buildPagination(total, current) {
        const wrapper = document.querySelector('.pagination-wrapper .pagination');
        if (!wrapper) return;

        let html = '';

        // Prev button (always shown, maybe disabled)
        html += `<button class="pagination__item pagination__prev" data-direction="prev" ${current === 1 ? 'disabled' : ''}>
            <span><?php sprite(20, 20, 'ArrowLeft'); ?></span>
        </button>`;

        // Numbered buttons
        for (let i = 1; i <= total; i++) {
            html += `<button class="pagination__item ${i === current ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }

        // Next button (always shown, maybe disabled)
        html += `<button class="pagination__item pagination__next" data-direction="next" ${current === total ? 'disabled' : ''}>
            <span><?php sprite(20, 20, 'ArrowRight'); ?></span>
        </button>`;

        wrapper.innerHTML = html;
    }

	function loadPosts() {
		const params = getParams();
		loaderInstanse(container, true);

		getAjaxData(ajax_url, 'get_news_posts', params, (res) => {
			if (res.success) {
				container.innerHTML = res.data.html;
				buildPagination(res.data.max, currentPage);
				updateURL();

				setTimeout(() => {
					loaderInstanse(container, false);
				}, 100);
			}
		});
	}

    document.addEventListener('click', e => {
        const target = e.target.closest('button');

        if (!target || target.disabled) return;

        if (target.matches('[data-page]')) {
            e.preventDefault();
            currentPage = parseInt(target.dataset.page);
            loadPosts();
        }

        if (target.matches('[data-direction="next"]')) {
            e.preventDefault();
            currentPage += 1;
            loadPosts();
        }

        if (target.matches('[data-direction="prev"]')) {
            e.preventDefault();
            currentPage -= 1;
            loadPosts();
        }
    });

	// Инициализация с ?page=
	const urlParams = new URLSearchParams(window.location.search);
	if (urlParams.get('page')) {
		currentPage = parseInt(urlParams.get('page'));
		loadPosts();
	}
});
