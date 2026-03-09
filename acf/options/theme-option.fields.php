<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page(array(
            'page_title' => __('Глобальні налаштування', THEME_SLUG),
            'menu_title' => __('Global settings', THEME_SLUG),
            'parent_slug' => 'themes.php',
            'menu_slug' => 'settings',
            'post_id' => 'settings'
        ));
    }

    $options = new FieldsBuilder('theme_options');

    $options
        ->addGroup('global_contacts', [
            'label' => '',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => [],
            'wrapper' => [
                'width' => '100',
                'class' => '',
                'id' => '',
            ],
            'layout' => 'block'
        ])
            ->addTab('contact_tab_1', [
                'label' => 'Соціальні мережі',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'placement' => 'left',
            ])
                ->addRepeater( 'social', [
                    'label'        => 'Наші соцмережi',
                    'button_label' => __( 'Додати соцмережу', 'ACF' ),
                    'layout'       => 'block'
                ] )
                ->addImage('social_image', [
                    'label' => 'Лого соцмережi',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ],
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ])
                ->addLink('social_link', [
                    'label' => 'Посилання на соцмережу',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ],
                    'return_format' => 'array',
                ])
            ->endRepeater()
        ->endGroup();

    $options->setLocation('options_page', '==', 'settings');

    acf_add_local_field_group($options->build());
});