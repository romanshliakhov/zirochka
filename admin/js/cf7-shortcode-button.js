(function () {
    tinymce.PluginManager.add('cf7_shortcode_button', function (editor) {
        editor.addButton('cf7_shortcode_button', {
            text: 'Form CF7',
            icon: 'books',
            onclick: function () {
                fetch(ajax_params.ajax_url + '?action=get_cf7_forms')
                    .then(response => response.json())
                    .then(forms => {
                        if (!forms.length) {
                            alert("Формы CF7 не найдены!");
                            return;
                        }

                        const options = forms.map(f => ({
                            text: f.title,
                            value: String(f.id) // Исправлено: ID всегда строка
                        }));

                        const modal = editor.windowManager.open({
                            title: 'Вставка формы CF7',
                            body: [
                                {
                                    type: 'listbox',
                                    name: 'cf7_form',
                                    label: 'Choose form',
                                    values: options
                                }
                            ],
                            onsubmit: function (e) {
                                let formId = e.data.cf7_form;
                                if (!formId || isNaN(formId)) {
                                    alert('Ошибка: некорректный ID формы!');
                                    return;
                                }

                                editor.insertContent('[contact-form-7 id="' + formId + '"]');
                            }
                        });
                    })
                    .catch(err => {
                        console.error('Ошибка получения форм:', err);
                        console.log(err)
                    });
            }
        });
    });
})();

