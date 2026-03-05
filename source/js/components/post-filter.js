import {getAjaxData} from "../functions/ajax-get-data";
import {loaderInstanse} from "../functions/scripts/loaderInstanse";
import CustomSelect from "../functions/scripts/select";

document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.blog-posts');
    const categorySelect = document.querySelector('[data-category]');

    if (categorySelect) {
        new CustomSelect(categorySelect, {
            mode: 'single',
            placeholder: 'Categories',
            showRemoveButton: false,
            hideOnSelect: true,
            hideOnClear: true,
            name: 'category',
        });
    }


    if (container) {
        const searchInput = document.querySelector('.blog-search__input');
        const searchButton = document.querySelector('.blog-search__submit');
        let searchTimeout;

        const tags = document.querySelectorAll('.tag');
        const {ajax_url, once} = ajax_params;

        let currentPage = 1;

        const sortingSelect = new CustomSelect(document.querySelector('.custom-select[data-sort]'), {
            mode: 'single',
            showRemoveButton: false,
            hideOnSelect: true,
            hideOnClear: true,
            name: 'sort',
        });

        sortingSelect.onSelect(function () {
            currentPage = 1;
            loadPosts();
        });


        // ==== Инициализация из URL ====
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.get('page')) currentPage = parseInt(urlParams.get('page'));
        // if (sortingSelect) sortingSelect.setValue(urlParams.get('sort') || 'newest')
        if (searchInput) searchInput.value = urlParams.get('search') || '';

        const urlTags = (urlParams.get('tags') || '').split(',');
        tags.forEach(tag => {
            if (urlTags.includes(tag.dataset.slug)) {
                tag.classList.add('active');
            }
        });

        // ==== Helpers ====
        function getActiveTags() {
            const actives = document.querySelectorAll('.tag.active');
            return Array.from(actives).map(tag => tag.dataset.slug);
        }

        function getCurrentCategory() {
            const container = document.querySelector('[data-current-category]');
            return container ? container.dataset.currentCategory : '';
        }

        function getParams() {
            const sort = sortingSelect.getValues()[0];
            const search = searchInput?.value || '';
            const tags = getActiveTags();
            const category = getCurrentCategory();

            let order = 'DESC';
            let orderby = 'date';

            if (sort === 'oldest') order = 'ASC';
            if (sort === 'title_asc') {
                order = 'ASC';
                orderby = 'title';
            }
            if (sort === 'title_desc') {
                order = 'DESC';
                orderby = 'title';
            }

            return {
                nonce: once,
                order,
                orderby,
                search,
                tags,
                category,
                page: currentPage
            };
        }

        function updateURL() {
            const params = getParams();
            const url = new URL(window.location.href);

            url.search = '';

            if (params.tags.length) {
                url.searchParams.set('tags', params.tags.join(','));
            }

            if (params.search) {
                url.searchParams.set('search', params.search);
            }

            if (params.category) {
                url.searchParams.set('category', params.category);
            }

            const sortValue = sortingSelect.getValues()[0];
            if (sortValue && sortValue !== 'newest') {
                url.searchParams.set('sort', sortValue);
            }

            url.searchParams.set('page', params.page);

            history.pushState(null, '', url);
        }


        function loadPosts() {
            const params = getParams();

            loaderInstanse(container, true);

            getAjaxData(ajax_url, 'get_blog_posts', params, (res) => {
                if (res.success) {
                    container.innerHTML = res.data.html;

                    buildPagination(res.data.max, params.page);

                    updateURL();

                    setTimeout(function () {
                        loaderInstanse(container, false);
                    }, 500)
                }
            });
        }

        function buildPagination(total, current) {
            const wrapper = document.querySelector('.pagination-wrapper .pagination');
            if (!wrapper) return;

            let html = '';

            if (current > 1) {
                html += `<button class="pagination__item" data-direction="prev"><span class="icon-prev"></span> Prev</button>`;
            }

            for (let i = 1; i <= total; i++) {
                html += `<button class="pagination__item ${i === current ? 'active' : ''}" data-page="${i}">${i}</button>`;
            }

            if (current < total) {
                html += `<button class="pagination__item" data-direction="next">Next <span class="icon-next"></span></button>`;
            }

            wrapper.innerHTML = html;
        }


        // ==== Слушатель пагинации ====

        document.addEventListener('click', e => {
            if (e.target.matches('[data-page]')) {
                e.preventDefault();
                currentPage = parseInt(e.target.dataset.page);
                loadPosts();
            }
            if (e.target.matches('[data-direction="next"]')) {
                e.preventDefault();
                currentPage += 1;
                loadPosts();
            }
            if (e.target.matches('[data-direction="prev"]')) {
                e.preventDefault();
                currentPage -= 1;
                loadPosts();
            }
        });


        // ==== Обработка тегов/поиска ====

        if (searchInput) {
            searchInput.addEventListener('input', () => {
                currentPage = 1;
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    loadPosts();
                }, 400);
            });

            searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault(); // отмена сабмита формы
                    clearTimeout(searchTimeout);
                    loadPosts();
                }
            });

            // searchInput.addEventListener('change', () => {
            //     currentPage = 1;
            //     loadPosts();
            // });
        }

        if (searchButton) {
            searchButton.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = 1;
                loadPosts();
            });
        }


        tags.forEach(tag => {
            tag.addEventListener('click', (e) => {
                e.preventDefault();
                tag.classList.toggle('active');
                currentPage = 1;
                loadPosts();
            });
        });


        // ==== Первая загрузка ====
        const initialParams = new URLSearchParams(window.location.search);
        const hasFilters =
            initialParams.has('search') ||
            initialParams.has('tags') ||
            initialParams.has('sort') ||
            initialParams.has('page');

        if (hasFilters) {
            loadPosts();
        }

    }
});
