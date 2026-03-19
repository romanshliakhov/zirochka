import { loaderInstanse } from "../functions/scripts/loaderInstanse";

document.addEventListener('DOMContentLoaded', () => {
    const list = document.querySelector('.blog-list');
    const btns = document.querySelectorAll('.load-more');

    if (!list) return;

    const { ajax_url, once } = ajax_params; // nonce

    function getOffset() {
        return list.querySelectorAll('.blog-list__item').length;
    }

    function loadMore() {
        loaderInstanse(list, true);

        const params = new URLSearchParams();
        params.append('action', 'get_articles');
        params.append('nonce', once);
        params.append('offset', getOffset());

        fetch(ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: params.toString()
        })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    list.insertAdjacentHTML('beforeend', res.data.html);
                } else {
                    console.error('Ошибка AJAX:', res);
                }
                loaderInstanse(list, false);
            })
            .catch(err => {
                console.error('Ошибка соединения:', err);
                loaderInstanse(list, false);
            });
    }

    btns.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            loadMore();
        });
    });
});