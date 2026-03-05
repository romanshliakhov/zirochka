(function () {
    tinymce.PluginManager.add('link_style_selector', function (editor) {

        editor.on('init', function() {
            const iframeBody = editor.getBody();

            if (iframeBody) {
                iframeBody.style.background = '#e5e5e5';

                iframeBody.addEventListener('click', () => {
                    console.log('Click on the editor');
                });
            } else {
                console.warn('iframeBody is not available');
            }
        });


        editor.addButton('link_style_selector', {
            type: 'menubutton',
            text: 'BTN Style',
            icon: 'settings',
            tooltip: 'Accept class',
            menu: [
                {
                    text: 'Default Link',
                    onclick: function () {
                        updateLinkClass('');
                    }
                },
                {
                    text: 'Red Button',
                    onclick: function () {
                        updateLinkClass('main-button main-button--red');
                    }
                },
                {
                    text: 'Blue Button',
                    onclick: function () {
                        updateLinkClass('main-button main-button--blue');
                    }
                },
                {
                    text: 'Bordered Button',
                    onclick: function () {
                        updateLinkClass('main-button main-button--bordered');
                    }
                },
                // {
                //     text: 'Border Button',
                //     onclick: function () {
                //         updateLinkClass('main-button main-button--transparent');
                //     }
                // },

                // {
                //     text: 'Phone',
                //     onclick: function () {
                //         updateLinkClass('custom-link phone');
                //     }
                // },
                // {
                //     text: 'Mail',
                //     onclick: function () {
                //         updateLinkClass('custom-link mail');
                //     }
                // }
            ]
        });

        function updateLinkClass(className) {
            const node = editor.selection.getNode();
            if (node.nodeName !== 'A') {
                alert('Select the link to apply the class.');
                return;
            }
            node.setAttribute('class', className);
        }
    });
})();
