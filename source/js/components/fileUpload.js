document.addEventListener('DOMContentLoaded', () => {
    const handleFileChange = (input) => {
        const wrapper = input.closest('.file-upload');
        if (!wrapper) return;

        const fileNameEl = wrapper.querySelector('.file-upload__filename');

        if (input.files?.length) {
            fileNameEl.textContent = input.files[0].name;
            wrapper.classList.add('is-loaded');
        } else {
            fileNameEl.textContent = '';
            wrapper.classList.remove('is-loaded');
        }
    };

    const handleRemove = (btn) => {
        const wrapper = btn.closest('.file-upload');
        if (!wrapper) return;

        const input = wrapper.querySelector('.file-upload__input');
        const fileNameEl = wrapper.querySelector('.file-upload__filename');

        input.value = '';
        fileNameEl.textContent = '';
        wrapper.classList.remove('is-loaded');
    };

    document.addEventListener('change', (e) => {
        const input = e.target.closest('.file-upload__input');
        if (!input) return;

        handleFileChange(input);
    });

    document.addEventListener('click', (e) => {
        const removeBtn = e.target.closest('.file-upload__remove');
        if (!removeBtn) return;

        e.preventDefault();
        e.stopPropagation();

        handleRemove(removeBtn);
    });
});