(function () {
    tinymce.PluginManager.add('range_selector', function (editor) {

        function openDialog(existingElement) {
            var value = '12345678';
            var min = '0';
            var max = '99999999';
            var symbol = '$';
            var custom_value = '';

            if (existingElement) {
                var input = existingElement.querySelector('input[type="range"]');
                if (input) {
                    value = input.value || value;
                    min = input.min || min;
                    max = input.max || max;
                }
                if (existingElement.hasAttribute('data-symbol')) {
                    symbol = existingElement.getAttribute('data-symbol') || symbol;
                }
                if (existingElement.hasAttribute('data-value')) {
                    custom_value = existingElement.getAttribute('data-value') || '';
                }
            }

            var dialogApi = editor.windowManager.open({
                title: existingElement ? 'Edit Range Slider' : 'Insert Range Slider',
                body: [
                    { type: 'textbox', name: 'value', label: 'Initial value:', value: value },
                    { type: 'textbox', name: 'min', label: 'Min:', value: min },
                    { type: 'textbox', name: 'max', label: 'Max:', value: max },
                    { type: 'textbox', name: 'symbol', label: 'Symbol (e.g. $):', value: symbol },
                    { type: 'textbox', name: 'custom_value', label: 'Custom data-value (optional):', value: custom_value }
                ],
                onsubmit: function (e) {
                    var data = e.data;
                    var customAttr = data.custom_value ? data.custom_value : '';

                    if (existingElement) {
                        existingElement.setAttribute('data-symbol', data.symbol);
                        if (customAttr) {
                            existingElement.setAttribute('data-value', customAttr);
                        } else {
                            existingElement.removeAttribute('data-value');
                        }

                        var input = existingElement.querySelector('input[type="range"]');
                        if (input) {
                            input.setAttribute('min', data.min);
                            input.setAttribute('max', data.max);
                            input.setAttribute('value', data.value);
                        }

                        var thumb = existingElement.querySelector('.range__thumb-label');
                        if (thumb) {
                            thumb.textContent = data.symbol + data.value;
                        }
                    } else {
                        var html = '<label class="range mode" data-symbol="' + data.symbol + '"' +
                            (customAttr ? ' data-value="' + customAttr + '"' : '') + '>' +
                            '<input type="range" step="1" min="' + data.min + '" max="' + data.max + '" value="' + data.value + '">' +
                            '<span class="range__thumb-label">' + data.symbol + data.value + '</span>' +
                            '</label>';
                        editor.execCommand('mceInsertContent', false, html);
                    }
                },
                buttons: [
                    { text: 'Cancel', onclick: 'close' },
                    existingElement ? {
                        text: 'Delete Range',
                        onclick: function () {
                            existingElement.parentNode.removeChild(existingElement);
                            dialogApi.close();
                        }
                    } : null,
                    {
                        text: existingElement ? 'Update' : 'Insert',
                        classes: 'widget btn-primary',
                        onclick: function () {
                            dialogApi.submit();
                        }
                    }
                ].filter(Boolean)
            });
        }

        editor.addButton('range_selector', {
            text: 'Insert Range',
            icon: false,
            onclick: function () {
                var node = editor.selection.getNode();
                if (node && node.nodeName === 'LABEL' && node.classList.contains('range') && node.classList.contains('mode')) {
                    openDialog(node);
                } else {
                    openDialog();
                }
            }
        });

        editor.on('click', function (e) {
            const node = e.target;

            const label = node && node.nodeType === 1
                ? (node.closest ? node.closest('label.range') : null)
                : null;

            if (label && label.nodeType === 1) {
                try {
                    editor.selection.select(label);
                } catch (err) {
                    console.warn('Selection failed:', err);
                }

                openDialog(label);
                e.preventDefault();
            }
        });

    });
})();
